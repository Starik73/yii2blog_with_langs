<?php
/**
 * Astashenkov
**/

namespace app\entities\enum;

/**
 * UserStatuses
 */
class UserStatuses
{
    const ACTIVE     = 'A';
    const PENDING    = 'P';
    const DISABLED   = 'D';

    public static function getAll()
    {
        return [
            self::ACTIVE,
            self::PENDING,
            self::DISABLED
        ];
    }
}