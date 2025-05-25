<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ticket_system_raw_php", "root", "");
    echo "Database connected successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}