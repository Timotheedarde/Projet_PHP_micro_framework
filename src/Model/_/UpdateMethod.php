<?php

namespace RPG\Model\_;

use RPG\Database;

Trait UpdateMethod
{
    public function update()
    {
        if (!$this->{static::PRIMARY_KEY}) {
            throw new \LogicException('Invalid process for update');
        }

        $fields = $this->getFieldsForTable();
        unset($fields[static::PRIMARY_KEY]); // No need 'id' for inset

        $fieldsForUpdate = [];
        foreach ($fields as $fieldKey => $fieldType) {
            $fieldsForUpdate[] = sprintf('%1$s = :%1$s', $fieldKey);
        }

        $params = $this->getParamsForSql($fields);
        $params[':primary_key'] = $this->{static::PRIMARY_KEY};

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = :primary_key",
            static::TABLE,
            implode(', ', $fieldsForUpdate),
            static::PRIMARY_KEY
        );
        Database::getInstance()->execute($sql, $params);
    }
}