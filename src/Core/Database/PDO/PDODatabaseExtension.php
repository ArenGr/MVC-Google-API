<?php

namespace App\Core\Database\PDO;

use \PDO;

class PDODatabaseExtension
{

    private $pdo;

    private $stmt;

    public function __construct()
    {
        $this->pdo = PDODatabaseConnection::getInstance()->getConnection();
    }

    /**
     * @param string $statement
     * @return $this
     */
    public function prepare(string $statement): static
    {
        $this->stmt = $this->pdo->prepare($statement);

        return $this;
    }

    /**
     * @param $params
     * @return $this
     */
    public function bind(array $params): static
    {
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $this->stmt->bindValue(`:{$param}`, $value);
            }
        }

        return $this;
    }

    /**
     * @param $data
     * @return void
     */
    public function execute($data): void
    {
        $this->stmt->execute($data);
    }


    /**
     * @param $statement
     * @return mixed
     */
    public function fetchAll($statement)
    {
        $this->prepare($statement);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);;
    }
}
