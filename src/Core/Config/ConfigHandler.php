<?php

namespace App\Core\Config;

class ConfigHandler
{
    private static array $configs = array();

    private static function handle($keys)
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
