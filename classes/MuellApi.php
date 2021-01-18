<?php
namespace Muellbot;

use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;

class MuellApi extends BasicObject
{
    
    function help(Request $request, Response $response, array $args)
    {
        return $this->returnJSON($response, [], 200, BasicObject::HTTP_200);
    }
    
    function getByOrt(Request $request, Response $response, array $args)
    {
        $iOrt = $args['id_ort'];
        
        #if (!is_numeric($iOrt)) {
        #    return $this->returnJSON($response, ['msg' => 'id_ort have to be numeric'], 400, BasicObject::HTTP_400);
        #}
        
        $aTermine = [];
        $aWhere   = ['ort' => $iOrt];
        
        if (isset($args['typ'])) {
            $aWhere['typ'] = $args['typ'];
        }
        
        if (isset($args['min_timestamp']) && is_numeric($args['min_timestamp'])) {
            $aWhere['termin[>=]'] = intval($args['min_timestamp']);
        }
        
        $aData = $this->oDB->select('termine', '*', $aWhere);
        
        foreach ($aData as $e) {
            $aTermine[$e['typ']][] = ['timestamp' => $e['termin'], 'date' => date('d.m.Y', $e['termin']), 'day' => date('l', $e['termin'])];
        }
        
        return $this->returnJSON($response, $aTermine);
    }
    
    
    function tommorow(Request $request, Response $response, array $args)
    {
        $iOrt = $args['id_ort'];
        
        #if (!is_numeric($iOrt)) {
        #    return $this->returnJSON($response, ['msg' => 'id_ort have to be numeric'], 400, BasicObject::HTTP_400);
        #}
        
        $sDatum = date('d.m.Y', time() + (60 * 60 * 24));
        
        
        $aTermine = [];
        $aWhere   = ['ort'        => $iOrt,
                     'termin[>=]' => strtotime($sDatum . ' 00:01'),
                     'termin[<=]' => strtotime($sDatum . ' 23:59'),
                     'ORDER' => [
                         'termin' => 'ASC'
                     ]
        ];
        
        $aData = $this->oDB->select('termine', '*', $aWhere);
        
        foreach ($aData as $e) {
            $aTermine[$e['typ']][] = ['timestamp' => $e['termin'], 'date' => date('d.m.Y', $e['termin']), 'day' => date('l', $e['termin'])];
        }
        
        return $this->returnJSON($response, $aTermine);
    }
    
    function nextweek(Request $request, Response $response, array $args)
    {
        $iOrt    = $args['id_ort'];
        $oMonday = new \DateTime();
        $oMonday->modify('next monday');
        
        $oSunday = clone $oMonday;
        $oSunday->modify('+7 days');
        
        $aTermine = [];
        $aWhere   = ['ort'        => $iOrt,
                     'termin[>=]' => $oMonday->getTimestamp(),
                     'termin[<=]' => $oSunday->getTimestamp(),

                     'ORDER' => [
                         'termin' => 'ASC'
                     ]
        ];
        
        $aData = $this->oDB->select('termine', '*', $aWhere);
        
        foreach ($aData as $e) {
            $aTermine[$e['typ']][] = ['timestamp' => $e['termin'], 'date' => date('d.m.Y', $e['termin']), 'day' => date('l', $e['termin'])];
        }
        
        return $this->returnJSON($response, $aTermine);
        
    }
    
    function getOrte(Request $request, Response $response, array $args) {
        $this->returnJSON($response, json_decode(file_get_contents('orte.json'), true));
    }
}