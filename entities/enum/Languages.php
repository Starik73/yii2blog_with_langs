<?php
/**
 * Astashenkov
**/

namespace app\entities\enum;

/**
 * Languages
 */
class Languages
{
    const RU  = 'ru';
    const EN  = 'en';

    public static function getAllLanguages()
    {
        return [
            self::RU,
            self::EN
        ];
    }
}