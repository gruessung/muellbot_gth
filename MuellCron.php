<?php
require_once('./vendor/autoload.php');
require_once('config.php');
require_once('./Tools.php');

use ICal\ICal;


/**
 * Class MuellCron
 */
class MuellCron
{
    private $oDB = null;
    private $bDebug = false;
    private $sTable = 'termine';

    private $aDataToInsert = [];


    public function __construct($bDebug = false)
    {
        $this->bDebug = $bDebug;

        if ($this->bDebug) {
            $this->sTable = 'debug';
        }

        if (!is_dir('./cache')) {
            mkdir('./cache');
        }


        //Connection to database...
           $this->oDB = new \Medoo\Medoo([
               'database_type' => DB_TYPE,
               'database_name' => DB_DATABASE,
               'server'        => DB_HOST,
               'username'      => DB_USER,
               'password'      => DB_PASS,
           ]);


        //Lade Orte
        $jsonOrte = file_get_contents('https://awido.cubefour.de/WebServices/Awido.Service.svc/getPlaces/client=gotha');
        $aJsonOrte = json_decode($jsonOrte, true);

        $aOrte = [];

        //Ortsteile laden
        Tools::log('Lade Orte');
        foreach ($aJsonOrte as $aOrt) {
            $jsonOrtEinzeln = file_get_contents('https://awido.cubefour.de/WebServices/Awido.Service.svc/getGroupedStreets/'.$aOrt['key'].'?selectedOTId=' . $aOrt['key'] . '&client=gotha');
            $aOrtsteileTmp = json_decode($jsonOrtEinzeln, true);
            Tools::log('https://awido.cubefour.de/WebServices/Awido.Service.svc/getGroupedStreets/7377394d-2fcf-43db-8f9f-2749de88fdce?selectedOTId=' . $aOrt['key'] . '&client=gotha');
            foreach ($aOrtsteileTmp as $aOrtsteil) {
                $aOrte[$aOrt['value']][$aOrtsteil['key']] = $aOrtsteil['value'];
            }
        }

        file_put_contents('orte.json', json_encode($aOrte));


        //Hole ics Dateien
        foreach ($aOrte as $i => $aOrt) {
            Tools::log(PHP_EOL.'Bearbeite: '. $i);
            foreach ($aOrt as $sKey => $sOrtsteilStrasse) {
                Tools::log('Bearbeite Ortsteil: '. $sOrtsteilStrasse);
                Tools::log('Lade ICS Datei herunter');
                $filename = $this->downloadIcs($sKey);
                try {
                    $events = $this->loadIcs($filename, $sKey);
                    Tools::log('Habe '.count($events).' Events gefunden');
                    foreach($events as $i => $event) {
                        $this->aDataToInsert[] = [
                            'termin' => $event->timestamp,
                            'ort' => $event->streetKey,
                            'typ' => $event->type,
                            'jahr' => JAHR
                        ];
                    }

                } catch (Exception $ex) {
                    Tools::log($ex->getMessage(), Tools::ERROR);
                }
            }
        }

        Tools::log('Daten speichern...');
        $this->oDB->delete($this->sTable, ['jahr' => JAHR]);
        $this->saveDateInDatabase();
    }

    private function downloadIcs($sKey)
    {
        $filename = './cache/' . $sKey . '.ics';
        if (!file_exists($filename) || !USE_CACHE) {
            file_put_contents($filename, file_get_contents('https://awido.cubefour.de/Customer/gotha/KalenderICS.aspx?oid=' . $sKey . '&jahr='.JAHR.'&fraktionen=1,2,3,4&reminder=-1.17:00'));
        }
        return $filename;
    }

    private function loadIcs($filename, $sKey) {
        /** @var $ical \ICal\ICal */
        $ical = new ICal($filename, array(
            'defaultSpan'                 => 2,     // Default value
            'defaultTimeZone'             => 'UTC',
            'defaultWeekStart'            => 'MO',  // Default value
            'disableCharacterReplacement' => false, // Default value
            'filterDaysAfter'             => null,  // Default value
            'filterDaysBefore'            => null,  // Default value
            'skipRecurrence'              => false, // Default value
        ));

        $events = [];

        foreach($ical->events() as $event) {
            $events[] = $this->getEventData($event, $sKey);
        }

        return $events;
    }

    private function getEventData($aEvent, $sKey) {
        $event = new stdClass();


        $title = $aEvent->summary;
        foreach(Tools::$aTonnentyp as $i => $type) {
            if (strpos($title, $type) !== false) {
                $event->type = $i;
                $event->typeText = $type;
            }
        }

        $event->timestamp = $aEvent->dtstart_array[2];
        $event->streetKey = $sKey;

        return $event;
    }

    private function saveDateInDatabase() {
        $this->oDB->insert($this->sTable, $this->aDataToInsert);
    }

    private function ladeRegionen()
    {
        $aOrte = [];
        foreach ($this->aRegionen as $iRegion) {
            echo "Lade Regionen: " . $iRegion . PHP_EOL;
            $oDOM = new DOMDocument();
            libxml_use_internal_errors(true);
            $oDOM->loadHTML(file_get_contents('http://awig.mediaonline.org/_2019/region_2019_lkgth.asp?region=' . $iRegion));
            libxml_clear_errors();

            $oSelect = $oDOM->getElementsByTagName('select')[1];
            $oOptions = $oSelect->getElementsByTagName('option');
            foreach ($oOptions as $oOption) {
                $iId = str_replace('uebersicht_' . date('Y') . '.asp?id=', '',
                    $oOption->getAttribute('value'));
                $aOrte[$iRegion][$iId] = $oOption->textContent;
            }
        }

        foreach ($aOrte as $iRegion => $aOT) {
            foreach ($aOT as $iOrt => $sOrt) {
                if ($sOrt == 'bitte wählen') {
                    continue;
                }
                if (!is_numeric($iOrt)) {
                    continue;
                }
                echo $iOrt . " => array('ort' => '$sOrt', 'region' => $iRegion)," . PHP_EOL;
            }
        }
    }

    private function ladeOrt($iOrt)
    {
        $oDOM = new DOMDocument();
        libxml_use_internal_errors(true);
        $oDOM->loadHTML(file_get_contents(self::BASE_URL . $iOrt));
        libxml_clear_errors();


        $aTables = $oDOM->getElementsByTagName('table');
        $oTable = $aTables->item(2);

        $aZeilen = $oTable->getElementsByTagName('tr');
        $aTermine = [];
        $sAktuellerTyp = '';
        /** @var int $iAktuelleStyleClassNumber */
        $iAktuelleStyleClassNumber = 0; //wird gebraucht um falschen HTML Syntax auszutricksen
        foreach ($aZeilen as $oZeile) {
            $aTDs = $oZeile->getElementsByTagName('td');

            //Typ ermitteln
            $sContentTyp = trim(str_replace('&nbsp;', '', $aTDs[0]->textContent));
            #echo $sContentTyp . PHP_EOL;
            foreach (Tools::$aTonnentyp as $sIndex => $sTyp) {
                if (strpos($sContentTyp, $sTyp) !== false) {
                    #echo "Neuer Typ: ".$sIndex.' - '.$sTyp.PHP_EOL;
                    $sAktuellerTyp = $sIndex;
                }
            }

            /** @var DOMNode $oTD */
            foreach ($aTDs as $oTD) {

                /**
                 * Das HTML der Quellseite ist kaputt (es fehlen tr's). Daher prüfe ich auf die Styleclass ab, da sich diese
                 * mit jedem Typ erhöht (ep_1, ep_2, ...). Der Typ mit dem fehlenden TR hat eine niedrige ep_ Nummer und
                 * ist somit invalide.
                 */
                $iStyleClassNumber = str_replace('ep_', '', $oTD->attributes->getNamedItem('class')->nodeValue);
                if ($iStyleClassNumber < $iAktuelleStyleClassNumber) {
                    continue;
                }
                $iAktuelleStyleClassNumber = $iStyleClassNumber;

                $sDatum = $oTD->textContent . date('Y');
                $iTimestamp = strtotime($sDatum);
                if ($iTimestamp < strtotime('01.01.' . date('Y')) || $sDatum == date('Y')) {
                    continue;
                }

                if (isset($aTermine[$sAktuellerTyp]) && count($aTermine[$sAktuellerTyp]) > 2 && $iTimestamp < $aTermine[$sAktuellerTyp][count($aTermine[$sAktuellerTyp]) - 1]) {
                    continue;
                }

                #echo $sDatum.PHP_EOL;
                $aTermine[$sAktuellerTyp][] = $iTimestamp;
            }
        }

        //Daten löschen
        $this->oDB->delete($this->sTable, ['ort' => $iOrt]);

        foreach ($aTermine as $sTyp => $aTimestamps) {
            foreach ($aTimestamps as $iTimestamp) {
                $this->oDB->insert($this->sTable, [
                    'termin' => $iTimestamp,
                    'ort' => $iOrt,
                    'typ' => $sTyp
                ]);
            }
        }


    }


}

new MuellCron(DEBUG);