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
        $this->PDOExtension->prepare("SELECT * FROM requests_history ORDER BY `id` DESC");

        $this->PDOExtension->execute();

        return $this->PDOExtension->fetchAll();
    }

    public function store($data): void
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
                $data[$key] = '';
            }
        }

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

        foreach ($data as $key => $value) {
            $this->PDOExtension->bind([$key => $value]);
        }
        $this->PDOExtension->execute();
    }
}