<?php

namespace RPG\Model;

use RPG\Exception\AttributeDocNotFoundException;
use RPG\Model\_\AttributeMethod;
use RPG\Model\_\DeleteMethod;
use RPG\Model\_\InsertMethod;
use RPG\Model\_\SelectMethod;
use RPG\Model\_\UpdateMethod;

/**
 * Class Model
 * @package RPG\Model
 */
abstract class Model
{
    const TABLE = '';
    const PRIMARY_KEY = 'id';

    use AttributeMethod;
    use SelectMethod;
    use InsertMethod;
    use UpdateMethod;
    use DeleteMethod;

    /**
     * @SQLType integer
     * @var int
     */
    protected $id;

    /**
     * @param array $fields
     * @return array
     */
    protected function getParamsForSql(array $fields)
    {
        $params = [];
        foreach ($fields as $fieldKey => $fieldType) {
            $params[':' . $fieldKey] = $this->$fieldKey;
        }
        return $params;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray()
    {
        $item = [];
        $fields = $this->getFieldsForTable();
        foreach ($fields as $fieldKey => $fieldType) {
            $item[$fieldKey] = $this->$fieldKey;
        }
        return $item;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        if ($this->id) {
            $this->update();
            return;
        }
        $this->insert();
    }
}