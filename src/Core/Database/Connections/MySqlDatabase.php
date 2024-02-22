<?php

namespace App\Core\Database\Connections;

use App\Core\Config\ConfigHandler as Config;
use \PDO;
use \PDOException;

class MySqlDatabase implements DbConnection
{
    private string $host;
    private string $port;
    private string $db;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $this->host = Config::get('database.databases.mysql.host');
        $this->port = Config::get('database.databases.mysql.port');
        $this->db = Config::get('database.databases.mysql.db');
        $this->user = Config::get('database.databases.mysql.user');
        $this->pass = Config::get('database.databases.mysql.pass');
    }

    /**
     * @return PDO|void
     */
    public function connect(): ?\PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
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
            print $e->getCode();
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}