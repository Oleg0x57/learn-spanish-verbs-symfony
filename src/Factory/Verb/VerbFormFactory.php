<?php

namespace App\Factory\Verb;

use App\Entity\Verb as EntityVerb;

abstract class VerbFormFactory
{
    /** string */
    protected $verb;

    /** string */
    protected $verbRoot;

    public function __construct(string $verb, string $verbRoot)
    {
        $this->verb = $verb;
        $this->verbRoot = $verbRoot;
    }
    
    abstract public function createModoIndicativo(): EntityVerb\ModoIndicativo;

    abstract public function createPreterioSimple(): EntityVerb\PreterioSimple;

    abstract public function createFuturoSimple(): EntityVerb\FuturoSimple;
}
