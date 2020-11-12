<?php

namespace RPG\Model;

use RPG\Database;
use RPG\Exception\RecordNotFoundException;

class Enum extends Model
{
    const TABLE = 'enum';

    /**
     * @SQLType integer
     * @var integer
     */
    protected $parent_id;

    /**
     * @SQLType text
     * @var string
     */
    protected $slug;

    /**
     * @SQLType text
     * @var string
     */
    protected $label;

    /**
     * @param string $slug
     * @return static
     * @throws RecordNotFoundException
     */
    public static function fromSlug(string $slug)
    {
        return static::fromField('slug', $slug);
    }

    /**
     * @param $parentSlug
     * @return bool
     * @throws RecordNotFoundException
     */
    public function childOf($parentSlug) : bool
    {
        $parent = static::fromSlug($parentSlug);
        return $this->parent_id === $parent->id;
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    public function getChildren()
    {
        return static::fromFields('parent_id', $this->id);
    }
}