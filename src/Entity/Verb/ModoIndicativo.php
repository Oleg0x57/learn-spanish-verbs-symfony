<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ModoIndicativo extends AbstractTimeForm
{
    public static function getTimeType(): string
    {
        return TimeTypes::MODO_INDICATIVO;
    }

    public static function getTimeTypeTitle(): string
    {
        return TimeTypes::MAP_TITLES[self::getTimeType()];
    }
}
