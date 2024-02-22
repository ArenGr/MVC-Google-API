<?php

namespace App\Core\Database\PDO;

use App\Core\Config\ConfigHandler as Config;
use App\Core\Database\Factory\MySqlDatabaseFactory;
use App\Core\Database\Factory\PostgreSqlDatabaseFactory;
use Exception;
use PDO;

class PDODatabaseConnection
{
    private static ?PDODatabaseConnection $instance = null;
    private ?PDO $pdo;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        switch (Config::get('database.default')) {
            case 'mysql':
                $factory = new MySqlDatabaseFactory();
                $mysqlConnection = $factory->createDatabaseConnection();
                $this->pdo = $mysqlConnection->connect();
                break;
            case 'postgresql':
                $factory = new PostgreSqlDatabaseFactory();
                $postgresqlConnaction = $factory->createDatabaseConnection();
                $this->pdo = $postgresqlConnaction->connect();
                break;
            default:
                throw new Exception("Invalid database type.");
        }
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * @return PDODatabaseConnection|null
     */
    public static function getInstance(): ?PDODatabaseConnection
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->pdo;
    }
}