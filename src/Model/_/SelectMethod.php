<?php

namespace RPG\Model\_;

use RPG\Database;
use RPG\Exception\AttributeInvalidDocNotFoundException;
use RPG\Exception\RecordNotFoundException;

/**
 * Trait SelectMethod
 * @package RPG\Model\_
 */
Trait SelectMethod
{
    /**
     * @param int $id
     * @return static
     */
    public static function fromId(int $id)
    {
        return static::fromField('id', $id);
    }

    /**
     * @param array $rows
     * @return static[]
     * @throws AttributeInvalidDocNotFoundException
     */
    public static function fromRows(array $rows)
    {
        $items = [];
        foreach ($rows as $row) {
            $item = new static();
            $item->loadFromRow($row);
            $items[$item->id] = $item;
        }
        return $items;
    }

    /**
     * @param array $options
     * @return SelectMethod[]
     * @throws AttributeInvalidDocNotFoundException
     */
    public static function get(array $options = [])
    {
        $database = Database::getInstance();
        $rows = $database->select(
            sprintf('SELECT * FROM %s ', static::TABLE)
        );

        return static::fromRows($rows);
    }

    /**
     * @param string $field
     * @param $value
     * @return static
     * @throws RecordNotFoundException
     */
    protected static function fromField(string $field, $value)
    {
        $database = Database::getInstance();
        $row = $database->selectSingle(
            sprintf('SELECT * FROM %s WHERE %s = :value ', static::TABLE, $field),
            [
                ':value' => $value
            ]
        );
        if (!$row) {
            throw new RecordNotFoundException(
                sprintf('Record not found [%s] for %s = %s', static::TABLE, $field, $value)
            );
        }

        $item = new static();
        $item->loadFromRow($row);
        return $item;
    }

    /**
     * @param string $field
     * @param $value
     * @return static[]
     */
    protected static function fromFields(string $field, $value)
    {
        $database = Database::getInstance();
        $rows = $database->select(
            sprintf('SELECT * FROM %s WHERE %s = :value ', static::TABLE, $field),
            [
                ':value' => $value
            ]
        );

        return static::fromRows($rows);
    }

    /**
     * @param array $row
     */
    protected function loadFromRow(array $row): void
    {
        $reflection = new \ReflectionClass($this);
        $attributes = $reflection->getProperties();
        foreach ($attributes as $attribute) {
            $attributeName = $attribute->getName();
            $attributeSqlType = $this->getAttributeDocName($attribute, 'SQLType');
            switch ($attributeSqlType) {
                case 'integer':
                    $this->$attributeName = (int)$row[$attributeName];
                    break;
                case 'text':
                    $this->$attributeName = (string)$row[$attributeName];
                    break;
                case 'float':
                    $this->$attributeName = (float)$row[$attributeName];
                    break;
                default:
                    throw new AttributeInvalidDocNotFoundException(
                        sprintf(
                            'Not found case for SQLType %s',
                            $attributeSqlType
                        )
                    );
                    break;
            }
        }
    }
}