<?php

namespace RPG\Model\Personage;

use RPG\Model\_\StatusField;
use RPG\Model\__\Personage\ActionAttack;
use RPG\Model\__\Personage\ActionDefend;
use RPG\Model\Personage;

/**
 * Class Hero
 */
class Hero extends Personage implements ActionAttack, ActionDefend
{
    use StatusField;

    /**
     * @param ActionDefend $personage
     */
    public function attack(ActionDefend $personage)
    {

    }

    /**
     * @param ActionDefend $personage
     */
    public function fastAttach(ActionDefend $personage)
    {

    }

    public function defend(Personage $personage)
    {
        // TODO: Implement defend() method.
    }
}
