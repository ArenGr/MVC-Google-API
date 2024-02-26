<?php
require_once 'migration.php';

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$queries = [
    "CREATE TABLE IF NOT EXISTS requests_history (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        street_number VARCHAR(60) DEFAULT NULL,
        route VARCHAR(60) DEFAULT NULL,
        sublocality_level_1 VARCHAR(60) DEFAULT NULL,
        locality VARCHAR(60) DEFAULT NULL,
        administrative_area_level_1 VARCHAR(60) DEFAULT NULL,
        country VARCHAR(60) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
];

try {
    foreach ($queries as $query) {
        $pdo->exec($query);
        echo "Migration query executed successfully:\n";
    }
    echo "Migration completed successfully.\n";
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}