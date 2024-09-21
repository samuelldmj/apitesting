<?php

class Student
{
    public $student_names;
    public $email;
    public $mobile;

    private $conn;
    private $table_name;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "tbl_student";
    }

    public function create_data()
    {
        // Correct SQL query (added spaces and commas)
        $query = "INSERT INTO " . $this->table_name . " (student_names, email, mobile) VALUES (?, ?, ?)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->student_names = htmlspecialchars(strip_tags($this->student_names));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));

        // Bind parameters using bindValue (or bindParam)
        $stmt->bindValue(1, $this->student_names);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->mobile);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
