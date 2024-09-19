<?php

class Database
{
    // Variable or property declarations
    private $hostname;
    private $dbname;
    private $username;
    private $conn;
    private $password;

    // Function to establish database connection
    public function connect()
    {
        // Initialize properties
        $this->hostname = "localhost"; // Corrected 'localhot' to 'localhost'
        $this->dbname = "rest_php_api";
        $this->username = 'root';
        $this->password = '';

        try {
            // Correct PDO connection string (DSN)
            $this->conn = new PDO("mysql:host={$this->hostname};dbname={$this->dbname}", $this->username, $this->password);
            // Set error mode to exception for easier error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            // Print error message
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
