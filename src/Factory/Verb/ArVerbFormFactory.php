<?php

namespace App\Factory\Verb;

use App\Entity\Verb as EntityVerb;

class ArVerbFormFactory extends VerbFormFactory
{
    public function createModoIndicativo(): EntityVerb\ModoIndicativo
    {
        $verb = new EntityVerb\ModoIndicativo();

        $verb->setYo($this->verbRoot . 'o')
        ->setTu($this->verbRoot . 'as')
        ->setEl($this->verbRoot . 'a')
        ->setElla($this->verbRoot . 'a')
        ->setUsted($this->verbRoot . 'a')
        ->setNosotros($this->verbRoot . 'amos')
        ->setVosotros($this->verbRoot . 'ais')
        ->setEllos($this->verbRoot . 'an');

        return $verb;
    }

    public function createPreterioSimple(): EntityVerb\PreterioSimple
    {
        $verb = new EntityVerb\PreterioSimple();

        $verb->setYo($this->verbRoot . 'e')
        ->setTu($this->verbRoot . 'aste')
        ->setEl($this->verbRoot . 'o')
        ->setElla($this->verbRoot . 'o')
        ->setUsted($this->verbRoot . 'o')
        ->setNosotros($this->verbRoot . 'amos')
        ->setVosotros($this->verbRoot . 'asteis')
        ->setEllos($this->verbRoot . 'aron');

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
