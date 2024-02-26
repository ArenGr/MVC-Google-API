<?php

namespace App\Core\Model;

use App\Core\Database\PDO\PDODatabaseExtension as PDOExtension;
use App\Core\HTTPClient\HTTPClient;

class Model
{
    public function __construct(
        protected HTTPClient   $HTTPClient,
        protected PDOExtension $PDOExtension
    )
    {
    }
}