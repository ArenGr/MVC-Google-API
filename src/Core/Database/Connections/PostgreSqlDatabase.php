<?php

namespace App\Core\Database\Connections;

use \PDO;
use \PDOException;

class PostgreSqlDatabase implements DbConnection
{
    private string $host;
    private string $port;
    private string $db;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $this->host = Config::get('databases.postgresql.host');
        $this->port = Config::get('databases.postgresql.port');
        $this->db = Config::get('databases.postgresql.db');
        $this->user = Config::get('databases.postgresql.user');
        $this->pass = Config::get('databases.postgresql.pass');
    }

    /**
     * @return PDO|void
     */
    public function connect(): ?PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db}",
                $this->user,
                $this->pass,
                $options
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}