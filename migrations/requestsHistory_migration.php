<?php
require_once 'migration.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$queries = [
    "CREATE TABLE IF NOT EXISTS requests_history (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        street_number VARCHAR(60) NULL,
        route VARCHAR(60) NULL,
        sublocality_level_1 VARCHAR(60) NULL,
        locality VARCHAR(60) NULL,
        administrative_area_level_1 VARCHAR(60) NULL,
        country VARCHAR(60) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )ENGINE=InnoDB"
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