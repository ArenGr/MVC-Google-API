<?php

namespace App\Core\Model;

use App\Core\Database\PDO\PDODatabaseExtension as PDOExtension;
use App\Core\HTTPClient\HTTPClient;

class Model
{
    public function __construct(
        public HTTPClient   $HTTPClient,
        public PDOExtension $PDOExtension
    )
    {
    }
}