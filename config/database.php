<?php

class Database
{
    // Variable or property declarations
    private $hostname;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    // Constructor to initialize properties
    public function __construct($hostname = 'localhost', $dbname = 'rest_php_api', $username = 'root', $password = '')
    {
        $this->hostname = $hostname;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    // Function to establish database connection
    public function connect()
    {
        // Check if connection already exists
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            // Correct PDO connection string (DSN)
            $this->conn = new PDO("mysql:host={$this->hostname};dbname={$this->dbname}", $this->username, $this->password);
            // Set error mode to exception for easier error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Optionally, you can return a success message
            // echo "---SUCCESSFUL CONNECTION---";
            return $this->conn;
        } catch (PDOException $e) {
            // Handle error appropriately
            // You might want to log the error or handle it differently in production
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    // Optionally, add a method to get the PDO connection object
    public function getConnection()
    {
        return $this->conn;
    }
}
