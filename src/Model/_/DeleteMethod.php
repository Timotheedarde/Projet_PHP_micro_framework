<?php

namespace RPG\Model\_;

use RPG\Database;

Trait DeleteMethod
{
    public function delete()
    {
        if (!$this->{static::PRIMARY_KEY}) {
            throw new \LogicException('Invalid process for update');
        }

        $sql = sprintf(
            "DELETE FROM %s WHERE %s = :primary_key",
            static::TABLE,
            static::PRIMARY_KEY
        );
        Database::getInstance()->execute($sql, [
            ':primary_key' => $this->{static::PRIMARY_KEY},
        ]);
        $this->id = 0;
    }
}