<?php

namespace App\Models;

use App\Core\Model\Model;

class RequestHistory extends Model
{
    public function getHistory()
    {
        $this->getQuery('select * from re');
    }
}