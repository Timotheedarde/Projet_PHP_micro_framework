<?php

namespace RPG\Model\__\Personage;

use RPG\Model\Personage;

/**
 * Interface ActionAttack
 * @package RPG\__\Personage
 */
Interface ActionAttack
{
    public function attack(ActionDefend $personage);

    public function fastAttach(ActionDefend $personage);
}