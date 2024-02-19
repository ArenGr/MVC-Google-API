<?php

namespace App\Repository;

use App\Models\RequestHistory;

class RequestHistoryRepository extends RequestHistory
{
//    public function getUserById($id)
//    {
//        $query = sprintf("SELECT * FROM %s WHERE id = %d", $this->table, $id);
//        return $this->getQuery($query);
//    }

    public function getAllRequestHistory()
    {
        $query = sprintf("SELECT * FROM %s", 'MyGuests');
        return $this->getQuery($query);
    }
}