<?php
/**
 * Astashenkov
**/

namespace app\entities\enum;

/**
 * YesNo
 */
class YesNo
{
    const YES  = 'Y';
    const NO   = 'N';

    public static function equalYes($string):bool
    {
        return (bool) $string == self::YES;
    }

    public static function equalNo($string):bool
    {
        return (bool) $string == self::NO;
    }
}