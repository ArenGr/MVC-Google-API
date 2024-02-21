<?php

namespace App\Core\Model;

use App\Contract\GoogleMapsAPI;
use App\Core\Database\PDO\PDODatabaseExtension;
use App\Core\HTTPClient\HTTPClient;

class Model extends PDODatabaseExtension
{
    use GoogleMapsAPI;

    public function __construct(public HTTPClient $HTTPClient)
    {

    }

}