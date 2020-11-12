<?php

namespace RPG\Model\_;

use RPG\Database;

Trait InsertMethod
{
    public function insert()
    {
        if ($this->{static::PRIMARY_KEY}) {
            throw new \LogicException('Not valid process for insert');
        }

        $fields = $this->getFieldsForTable();
        unset($fields[static::PRIMARY_KEY]); // No need 'id' for inset
        $fieldsKeys = array_keys($fields);

        $params = $this->getParamsForSql($fields);
        $paramKeys = array_keys($params);
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::TABLE,
            implode(', ', $fieldsKeys),
            implode(', ', $paramKeys)
        );
        $insertId = Database::getInstance()->insert($sql, $params);
        $this->id = (int)$insertId;
    }
}