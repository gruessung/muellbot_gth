<?php
require_once('./vendor/autoload.php');
require_once('config.php');
require_once('./Tools.php');

class MuellCron
{
    const BASE_URL = 'http://awig.mediaonline.org/_2019/uebersicht_2019.asp?id=';
    private $oDB    = null;
    private $bDebug = false;
    private $sTable = 'termine';
    
    private $aRegionen = [
        1,
        14,
        2,
        4,
        13,
        5,
        7,
        8,
        9,
        10,
        11,
        12,
        15,
        16
    ];
    
    public function __construct($bDebug = false)
    {
        $this->bDebug = $bDebug;
        
        if ($this->bDebug) {
            $this->sTable = 'debug';
        }
        
        
        //Connection to database...
        $this->oDB = new \Medoo\Medoo([
            'database_type' => DB_TYPE,
            'database_name' => DB_DATABASE,
            'server'        => DB_HOST,
            'username'      => DB_USER,
            'password'      => DB_PASS,
        ]);
        
        //[94 => array('ort' => 'OT Neudietendorf', 'region' => 10)]
        //Start crawling...
        foreach (Tools::$aOrte as $iOrt => $aOrt) {
            echo 'Lade Ort: ' . $aOrt['ort'] . ' #' . $iOrt . PHP_EOL;
            $this->ladeOrt($iOrt);
        }
        # $this->ladeRegionen();
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
            
            $oSelect  = $oDOM->getElementsByTagName('select')[1];
            $oOptions = $oSelect->getElementsByTagName('option');
            foreach ($oOptions as $oOption) {
                $iId                   = str_replace('uebersicht_' . date('Y') . '.asp?id=', '',
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
        $oTable  = $aTables->item(2);
        
        $aZeilen       = $oTable->getElementsByTagName('tr');
        $aTermine      = [];
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
                
                $sDatum     = $oTD->textContent . date('Y');
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
                    'ort'    => $iOrt,
                    'typ'    => $sTyp
                ]);
            }
        }
        
        
    }
    
    
}

new MuellCron(DEBUG);