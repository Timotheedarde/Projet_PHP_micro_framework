<?php

namespace RPG\Model\_;

use RPG\Model\Store;

/**
 * Trait StoreField
 * @package RPG\Model\_
 */
Trait StoreField
{
    /**
     * @SQLType integer
     * @var integer
     */
    protected $store_id;

    /**
     * @param Store $store
     */
    public function setStore(Store $store)
    {
        $this->store_id = $store->id;
    }

    /**
     * @return Store
     */
    public function getStore(): Store
    {
        return Store::fromId($this->store_id);
    }
}