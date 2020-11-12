<?php

namespace RPG\Model\Personage;

use RPG\Model\_\PersonageOfStory;
use RPG\Model\__\Personage\ActionDefend;
use RPG\Model\Personage;

/**
 * Class PNJ
 */
class Farmer extends Personage implements ActionDefend
{
    const MAX_HEALTH = 50;

    use PersonageOfStory;
}
