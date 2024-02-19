<?php
namespace App\Core\Database\Connections;

use \PDO;

interface DbConnection
{
    /**
     * @return PDO|void
     */
    public function connect(): ?PDO;
}