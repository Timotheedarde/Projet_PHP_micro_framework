<?php

namespace RPG\Model\_;

use RPG\Model\Personage;

Trait PersonageOfStory
{
    /**
     * @var integer
     */
    protected $health;

    /**
     * @param Personage $personage
     */
    public function defend(Personage $personage)
    {
        $this->health -= $personage->attack;
    }
}