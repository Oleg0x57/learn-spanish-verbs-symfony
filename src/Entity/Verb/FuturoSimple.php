<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class FuturoSimple extends AbstractTimeForm
{
    public static function getTimeType(): string
    {
        return TimeTypes::FUTURO_SIMPLE;
    }

    public static function getTimeTypeTitle(): string
    {
        return TimeTypes::MAP_TITLES[self::getTimeType()];
    }
}
