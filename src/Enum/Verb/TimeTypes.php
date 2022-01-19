<?php
namespace App\Enum\Verb;

class TimeTypes
{
    const MODO_INDICATIVO = 'modo_indicativo';
    const PRETERIO_SIMPLE = 'preterito_simple';

    const MAP_TITLES = [
        self::MODO_INDICATIVO => 'Настоящее',
        self::PRETERIO_SIMPLE => 'Прошедшее',
    ];
}