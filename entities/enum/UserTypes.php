<?php
/**
 * Astashenkov
**/

namespace app\entities\enum;

/**
 * UserTypes
 */
class UserTypes
{
    const ADMIN     = 'A';
    const AUTHOR    = 'C';
    const MODERATOR = 'M';
    const USER      = 'U';

    public static function getAll()
    {
        return [
            self::ADMIN,
            self::AUTHOR,
            self::MODERATOR,
            self::USER
        ];
    }
}