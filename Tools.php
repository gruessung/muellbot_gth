<?php

class Tools
{

    static $aTonnentyp = [
        0 => 'Hausmüll',
        1 => 'Biomüll',
        2 => 'Gelbe Tonne',
        3 => 'Papiertonne'
    ];

    const INFO = 'INFO';
    const ERROR = 'ERROR';
    const WARNING = 'WARNING';

    public static function getOrtText($iOrt)
    {
        return self::$aOrte[$iOrt];
    }

    public static function getTonnentypText($sIndex)
    {
        return self::$aTonnentyp[$sIndex];
    }

    public static function log($sMessage, $sType = 'INFO')
    {
        echo sprintf('[%s] %s', $sType, $sMessage).PHP_EOL;
    }
}