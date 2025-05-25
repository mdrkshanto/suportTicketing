<?php
require_once "../helpers/Database.php";

try {
    $db = Database::getInstance();
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Database connection error: " . $e->getMessage();
}