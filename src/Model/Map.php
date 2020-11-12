<?php

namespace RPG\Model;

use RPG\Model\_\StoreField;
use RPG\Model\_\TypeField;

/**
 * Class Map
 * @package RPG\Model
 */
class Map extends Model
{
    const TABLE = 'map';
    const BASE_ENUM = 'MAP';

    use TypeField;
    use StoreField;

    /**
     * @SQLType integer
     * @var integer
     */
    protected $position_x;

    /**
     * @SQLType integer
     * @var integer
     */
    protected $position_y;

    /**
     * @SQLType integer
     * @var integer
     */
    protected $enemy_id;

    /**
     * @param int $x
     * @param int $y
     */
    public function setPosition(int $x, int $y) : void
    {
        $this->position_x = $x;
        $this->position_y = $y;
    }

    public function setStoreId(int $storeId) : void
    {
        $this->store_id = $storeId;
    }

    public function setEnemy(int $enemyId) : void
    {
        $this->enemy_id = $enemyId;
    }
}