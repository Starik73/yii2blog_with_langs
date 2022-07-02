<?php
/**
 * Astashenkov
**/

namespace app\entities\enum;

/**
 * ObjectStatuses
 */
class ObjectStatuses
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

    public static function getStatusesList()
    {
        return [
            self::ACTIVE   => 'ACTIVE',
            self::PENDING  => 'PENDING',
            self::DISABLED => 'DISABLED'
        ];
    }

    public static function getSimpleStatusesList()
    {
        return [
            self::ACTIVE   => 'ACTIVE',
            self::DISABLED => 'DISABLED'
        ];
    }
}