<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['MYSQL_HOST'];
$dbname = $_ENV['MYSQL_DB'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASS'];