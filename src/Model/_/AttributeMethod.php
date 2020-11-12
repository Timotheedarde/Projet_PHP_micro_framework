<?php

namespace RPG\Model\_;

use RPG\Exception\AttributeDocNotFoundException;

/**
 * Trait AttributeMethod
 * @package RPG\Model\_
 */
Trait AttributeMethod
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function getFieldsForTable() : array
    {
        $fields = [];
        $reflection = new \ReflectionClass($this);
        $attributes = $reflection->getProperties();
        foreach ($attributes as $attribute) {
            if (!$this->hasAttributeDocName($attribute, 'SQLType')) {
                continue;
            }
            $attributeSqlType = $this->getAttributeDocName($attribute, 'SQLType');
            $fields[$attribute->getName()] = $attributeSqlType;
        }
        return $fields;
    }

    /**
     * @param \ReflectionProperty $property
     * @param $key
     * @return bool
     */
    private function hasAttributeDocName(\ReflectionProperty $property, $key): bool
    {
        $doc = $property->getDocComment();
        preg_match_all('#@([a-zA-Z]+) (.*?)\n#s', $doc, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            if ($match[1] === $key) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param \ReflectionProperty $property
     * @param $key
     * @return string
     * @throws AttributeDocNotFoundException
     */
    private function getAttributeDocName(\ReflectionProperty $property, $key)
    {
        $doc = $property->getDocComment();
        preg_match_all('#@([a-zA-Z]+) (.*?)\n#s', $doc, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            if ($match[1] === $key) {
                return (string)$match[2];
            }
        }

        throw new AttributeDocNotFoundException(
            sprintf('Not found doc %s for attribute %s', $key, $property->getName())
        );
    }
}