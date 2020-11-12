<?php

namespace RPG\Model;

/**
 * Class Personage
 */
abstract class Personage extends Model
{
    const TABLE = 'personage';
    const MAX_HEALTH = 100;

    /**
     * @SQLType text
     * @var string
     */
    protected $name;

    /**
     * @SQLType integer
     * @var integer
     */

    protected $health;

    /**
     * @SQLType integer
     * @var integer
     */
    protected $attack;

    /**
     * @return float
     */
    public function getHealthPercent() : float
    {
        return (float)round(
            $this->health / static::MAX_HEALTH * 100
        );
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health)
    {
        if ($health >= self::MAX_HEALTH) {
            $health = self::MAX_HEALTH;
        }
        $this->health = $health;
    }

    /**
     * @param string $message
     * @return string
     */
    public function say(string $message) : string
    {
        return sprintf('%s : %s', $this->name, $message);
    }
}
