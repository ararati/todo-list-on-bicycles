<?php

namespace App\Core\Database;

class Database
{
    private static $instance;
    private $connection;
    private static $config;

    private function __construct($host, $dbname, $user, $pass)
    {
        $this->connection = $this->createConnection($host, $dbname, $user, $pass);
    }

    private function createConnection($host, $dbname, $user, $password)
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $host, $dbname);

        try {
            $dbh = new \PDO($dsn, $user, $password);
            $dbh->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

            return $dbh;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }

    public static function getInstance()
    {
        if(self::$instance != null) {
            return self::$instance;
        }

        return new self(
            self::$config['host'],
            self::$config['database'],
            self::$config['username'],
            self::$config['password']
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }
}