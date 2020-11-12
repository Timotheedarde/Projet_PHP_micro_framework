<?php

namespace RPG\Model\Personage;

use RPG\Model\_\PersonageOfStory;
use RPG\Model\__\Personage\ActionDefend;
use RPG\Exception\LanguageException;
use RPG\Model\Personage;

/**
 * Class PNJ
 */
class Merchant extends Personage implements ActionDefend
{
    const MAX_HEALTH = 75;

    use PersonageOfStory;

    public function say(string $message): string
    {
        throw new LanguageException('Farmer dont speak in french');
    }
}
