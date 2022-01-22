<?php

namespace App\Factory\Verb;

use App\Entity\Verb as EntityVerb;

class ErVerbFormFactory extends VerbFormFactory
{
    public function createModoIndicativo(): EntityVerb\ModoIndicativo
    {
        $verb = new EntityVerb\ModoIndicativo();

        $verb->setYo($this->verbRoot . 'o')
        ->setTu($this->verbRoot . 'es')
        ->setEl($this->verbRoot . 'e')
        ->setElla($this->verbRoot . 'e')
        ->setUsted($this->verbRoot . 'e')
        ->setNosotros($this->verbRoot . 'emos')
        ->setVosotros($this->verbRoot . 'eis')
        ->setEllos($this->verbRoot . 'en');

        return $verb;
    }

    public function createPreterioSimple(): EntityVerb\PreterioSimple
    {
        $verb = new EntityVerb\PreterioSimple();

        $verb->setYo($this->verbRoot . 'i')
        ->setTu($this->verbRoot . 'iste')
        ->setEl($this->verbRoot . 'io')
        ->setElla($this->verbRoot . 'io')
        ->setUsted($this->verbRoot . 'io')
        ->setNosotros($this->verbRoot . 'imos')
        ->setVosotros($this->verbRoot . 'isteis')
        ->setEllos($this->verbRoot . 'ieron');

        return $verb;
    }

    public function createFuturoSimple(): EntityVerb\FuturoSimple
    {
        $verb = new EntityVerb\FuturoSimple();

        $verb->setYo($this->verb . 'e')
        ->setTu($this->verb . 'as')
        ->setEl($this->verb . 'a')
        ->setElla($this->verb . 'a')
        ->setUsted($this->verb . 'a')
        ->setNosotros($this->verb . 'emos')
        ->setVosotros($this->verb . 'eis')
        ->setEllos($this->verb . 'an');

        return $verb;
    }
}
