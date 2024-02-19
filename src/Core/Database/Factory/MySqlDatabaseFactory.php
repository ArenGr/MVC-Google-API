<?php
namespace App\Core\Database\Factory;

use App\Core\Database\Connections\DbConnection;
use App\Core\Database\Connections\MySqlDatabase;

class MySqlDatabaseFactory implements DatabaseFactory
{
    /**
     * @return MySqlDatabase
     */
    public function createDatabaseConnection(): DbConnection
    {
        return new MySqlDatabase();
    }
}
