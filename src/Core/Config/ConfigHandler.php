<?php

namespace App\Core\Config;

class ConfigHandler
{
    /**
     * @var array
     */
    private static array $configs = array();

    /**
     * @param array $keys
     * @return string|null
     */
    private static function handle(array $keys): string|array|null
    {
        $values = self::$configs;

        foreach ($keys as $key) {
            if (array_key_exists($key, $values)) {
                $values = $values[$key];
            } else {
                return null;
            }
        }

        return $values;
    }

    /**
     * @param $key
     * @return string|void|null
     */
    public static function get($key)
    {
        if (!empty($key)) {
            $keys = explode('.', $key);
            if (empty(self::$configs[$keys[0]])) {
                self::$configs = require_once(sprintf("%s/config/%s.php", APP_ROOT, $keys[0]));
            }
            return self::handle($keys);
        }
    }
}
