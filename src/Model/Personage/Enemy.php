<?php

namespace RPG\Model\Personage;

use RPG\Model\__\Personage\ActionAttack;
use RPG\Model\__\Personage\ActionDefend;
use RPG\Model\Personage;

/**
 * Class Enemy
 */
class Enemy extends Personage implements ActionAttack, ActionDefend
{
    const MAX_HEALTH = 200;

    /**
     * @param ActionDefend $personage
     */
    public function attack(ActionDefend $personage)
    {
        // TODO: Implement attack() method.
    }

    /**
     * @param ActionDefend $personage
     */
    public function fastAttach(ActionDefend $personage)
    {

    }

    /**
     * @param Personage $personage
     */
    public function defend(Personage $personage)
    {
        // TODO: Implement defend() method.
    }
}