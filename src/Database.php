<?php

namespace RPG;

use RPG\Exception\SQLRequestException;

/**
 * Class Database
 * @package RPG
 */
class Database
{
    /**
     * @var Database
     */
    protected static $instance;

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * Database constructor.
     * @param string $connectionString
     * @param $username
     * @param $password
     */
    protected function __construct(string $connectionString, $username, $password)
    {
        $this->pdo = new \PDO($connectionString, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $sql
     * @param array $params
     */
    public function select(string $sql, array $params = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->setFetchMode(\PDO::FETCH_ASSOC);
        $request->execute($params);
        return $request->fetchAll();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return string
     */
    public function insert(string $sql, array $params = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($params);
        return $this->pdo->lastInsertId();
    }

    /**
     * @param string $sql
     * @param array $params
     */
    public function execute(string $sql, array $params = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($params);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function selectSingle(string $sql, array $params = [])
    {
        $request = $this->pdo->prepare($sql);
        $request->setFetchMode(\PDO::FETCH_ASSOC);
        $request->execute($params);
        return $request->fetch();
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance) {
            return static::$instance;
        }
        static::$instance = new static(
            MYSQL_CONNECTION_STRING,
            MYSQL_CONNECTION_USERNAME,
            MYSQL_CONNECTION_PASSWORD
        );
        return static::$instance;
    }
}