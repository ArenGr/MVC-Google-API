<?php

return array(
    'database' => array(
        'databases' => array(
            'mysql' => array(
                'host' => $_ENV['MYSQL_HOST'],
                'port' => $_ENV['MYSQL_PORT'],
                'db' => $_ENV['MYSQL_DB'],
                'user' => $_ENV['MYSQL_USER'],
                'pass' => $_ENV['MYSQL_PASS'],
            ),
            'postgresql' => array(
                'host' => $_ENV['POSTGRESQL_HOST'],
                'port' => $_ENV['POSTGRESQL_PORT'],
                'db' => $_ENV['POSTGRESQL_DB'],
                'user' => $_ENV['POSTGRESQL_USER'],
                'pass' => $_ENV['POSTGRESQL_PASS'],
            )
        ),
        'default' => $_ENV['DEFAULT_DB']
    ),
);
