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

    public function createFuturoProximo(): EntityVerb\FuturoProximo
    {
        $verb = new EntityVerb\FuturoProximo();

        $verb->setYo('voy a ' . $this->verb)
            ->setTu('vas a ' . $this->verb)
            ->setEl('va a ' . $this->verb)
            ->setElla('va a ' . $this->verb)
            ->setUsted('va a ' . $this->verb)
            ->setNosotros('vamos a ' . $this->verb)
            ->setVosotros('vais a ' . $this->verb)
            ->setEllos('van a ' . $this->verb);

        return $verb;
    }
}
