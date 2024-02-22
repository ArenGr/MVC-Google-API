<?php

namespace App\Core\Model;

use App\Contracts\GoogleMapsAPI;
use App\Core\Database\PDO\PDODatabaseExtension;
use App\Core\HTTPClient\HTTPClient;

class Model
{
    use GoogleMapsAPI;

    public function __construct(public HTTPClient $HTTPClient, public PDODatabaseExtension $PDODatabaseExtension)
    {
    }

}