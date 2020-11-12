<?php

namespace RPG\Model;

use RPG\Model\_\StatusField;

/**
 * Class Store
 * @package RPG\Model
 */
class Store extends Model
{
    const TABLE = 'store';
    const BASE_ENUM = 'STORE';

    use StatusField;

    /**
     * @SQLType text
     * @var string
     */
    protected $title;
}