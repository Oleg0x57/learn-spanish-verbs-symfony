<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ModoIndicativo extends AbstractTimeForm
{
    public static function getTimeType()
    {
        return TimeTypes::MODO_INDICATIVO;
    }
}
