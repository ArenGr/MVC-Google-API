<?php

namespace App\Core\Database\Factory;

use App\Core\Database\Connections\DbConnection;

interface DatabaseFactory
{
    public function createDatabaseConnection(): DbConnection;
}
