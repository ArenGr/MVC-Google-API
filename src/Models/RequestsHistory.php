<?php

namespace App\Models;

use App\Core\Model\Model;

class RequestsHistory extends Model
{
    /**
     * @var string
     */
    private string $table = 'requests_history';

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->PDODatabaseExtension->fetchAll("SELECT * FROM $this->table LIMIT 10 OFFSET 0");
    }

    /**
     * @param $data
     * @return void
     */
    public function store($data)
    {
        $template = [
            'street_number',
            'route',
            'sublocality_level_1',
            'locality',
            'administrative_area_level_1',
            'country'
        ];

        foreach ($template as $key) {
            if (!array_key_exists($key, $data)) {
                $data[$key] = null;
            }
        }

        $sql = "INSERT INTO $this->table (
                              street_number,
                              route,
                              sublocality_level_1,
                              locality,
                              administrative_area_level_1,
                              country) VALUES
                            (
                             :street_number,
                             :route,
                             :sublocality_level_1,
                             :locality,
                             :administrative_area_level_1,
                             :country)";
        $this->PDODatabaseExtension->prepare($sql)->execute($data);
    }
}