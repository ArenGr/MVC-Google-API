<?php

namespace App\Core\Config;

class ConfigHandler
{
    private static array $config = array();

    private static function handle($key)
    {
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $key) {
            if (array_key_exists($key, $value)) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }

    public static function get($key, $type='paths')
    {
        if (empty(self::$config)) {
            self::$config = require_once(dirname($_SERVER['DOCUMENT_ROOT']) . sprintf("/config/%s.php", $type));
        }
        return self::handle($key);
    }
}
