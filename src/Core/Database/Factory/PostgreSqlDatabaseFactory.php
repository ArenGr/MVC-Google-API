<?php

namespace App\Core\Database\Factory;

use App\Core\Database\Connections\DbConnection;
use Core\Database\Databases\Database;
use Core\Database\Databases\PostgreSqlDatabase;

class PostgreSqlDatabaseFactory implements DatabaseFactory
{
    /**
     * @return PostgreSqlDatabase
     */
    public function createDatabaseConnection(): DbConnection
    {
        return new PostgreSqlDatabase();
    }
}
