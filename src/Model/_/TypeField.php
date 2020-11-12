<?php

namespace RPG\Model\_;

use RPG\Model\Enum;

/**
 * Trait TypeField
 * @package RPG\Model\_
 */
Trait TypeField
{
    /**
     * @SQLType integer
     * @var integer
     */
    protected $type;

    /**
     * @param string|integer $value
     * @throws \RPG\Exception\RecordNotFoundException
     */
    public function setType($value) : void
    {
        if (is_numeric($value)) {
            $enum = Enum::fromId($value);
            if (!$enum->childOf(static::getPrimaryTypeEnum())) {
                throw new \LogicException('Invalid value for type');
            }
            $this->type = $enum->id;
            return;
        }

        $this->type = Enum::fromSlug(
            sprintf("%s.%s", static::getPrimaryTypeEnum(), $value)
        )->id;
    }

    /**
     * @return string
     */
    public function getTypeLabel() : string
    {
        return Enum::fromId($this->type)->getLabel();
    }

    /**
     * @return string
     */
    protected static function getPrimaryTypeEnum() : string
    {
        return sprintf("%s_TYPE", static::BASE_ENUM);
    }

    /**
     * @return array
     * @throws \RPG\Exception\RecordNotFoundException
     */
    public static function getTypeLabels()
    {
        $items = [];
        $primary = Enum::fromSlug(static::getPrimaryTypeEnum());
        $children = $primary->getChildren();
        foreach ($children as $child) {
            $items[$child->id] = $child->getLabel();
        }
        return $items;
    }
}