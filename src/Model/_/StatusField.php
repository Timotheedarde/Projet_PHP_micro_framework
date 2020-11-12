<?php

namespace RPG\Model\_;

use RPG\Model\Enum;

/**
 * Trait StatusField
 * @package RPG\_
 */
Trait StatusField
{
    /**
     * @var integer
     */
    protected $status;

    /**
     * @param string $key
     * @throws \RPG\Exception\RecordNotFoundException
     */
    public function setType(string $key) : void
    {
        $this->status = Enum::fromSlug(
            sprintf("%s_STATUS.%s", static::BASE_ENUM, $key)
        )->id;
    }
}