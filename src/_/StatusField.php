<?php

namespace RPG\_;

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
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}