<?php

namespace App\Core\Database\Connections;

use App\Core\Config\ConfigHandler as Config;
use App\Core\Helpers\Dev;
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
        $this->host = Config::get('databases.mysql.host');
        $this->port = Config::get('databases.mysql.port');
        $this->db = Config::get('databases.mysql.db');
        $this->user = Config::get('databases.mysql.user');
        $this->pass = Config::get('databases.mysql.pass');
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
//            Dev::dd($this->host,false);
//            Dev::dd($this->port, false);
//            Dev::dd($this->db, false);
//            Dev::dd($this->user, false);
//            Dev::dd($this->pass);
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