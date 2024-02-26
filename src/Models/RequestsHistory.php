<?php

namespace App\Models;

use App\Core\Model\Model;

class RequestsHistory extends Model
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->PDOExtension->prepare("SELECT * FROM requests_history ORDER BY `id` DESC");

        $this->PDOExtension->execute();

        return $this->PDOExtension->fetchAll();
    }

    public function store($data): void
    {
        $sql = "INSERT INTO requests_history (
                      street_number,
                      route,
                      sublocality_level_1,
                      locality,
                      administrative_area_level_1,
                      country) VALUES (
                      :street_number,
                      :route,
                      :sublocality_level_1,
                      :locality,
                      :administrative_area_level_1,
                      :country)";

        $this->PDOExtension->prepare($sql);

        $this->PDOExtension->bind($data);

        $this->PDOExtension->execute();
    }
}