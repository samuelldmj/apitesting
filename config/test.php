<?php

// Include or require the Database class file
require 'Database.php'; // Adjust the path as needed

try {
    // Instantiate the Database class
    $db = new Database();

    // Attempt to establish a connection
    $connection = $db->connect();

    if ($connection instanceof PDO) {
        echo "<b>--Database connection successful--</b>!";
    }
} catch (Exception $e) {
    // Print error message if connection fails
    echo "Error: " . $e->getMessage();
}
