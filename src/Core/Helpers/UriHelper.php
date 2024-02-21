<?php

namespace App\Core\Helpers;

class UriHelper
{
    public static function sanitizeUri(string $str): mixed
    {
        return filter_var($str, FILTER_SANITIZE_URL);
    }

    public static function queryToArr(string $query)
    {
        parse_str($query, $arr);
        return $arr;
    }

    public static function getPath(string $uri): string
    {
        $uri = explode('?', $uri);

        list($path, $query) = $uri;

        return $path;
    }

    public static function getQuery(string $uri): ?array
    {
        $uri = explode('?', $uri);

        list($path, $query) = $uri;

        if (!empty($query)) {
            return self::queryToArr($query);
        }
        return null;
    }
}