<?php
class Student
{
    public $student_names;
    public $email;
    public $mobile;
    public $id;
    public $records = array();

    private $conn;
    private $table_name;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "tbl_student";
    }

    // Method to create data
    public function create_data()
    {
        $query = "INSERT INTO " . $this->table_name . " (student_names, email, mobile) VALUES (?, ?, ?)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->student_names = htmlspecialchars(strip_tags($this->student_names));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));

        // Bind parameters
        $stmt->bindValue(1, $this->student_names);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->mobile);

        // Execute and check if successful
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method to get all data
    public function get_all_data()
    {
        $sql_query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get single data by id
    public function get_single_data()
    {
        // Add a space before WHERE clause
        $sql_query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql_query);

        // Sanitize and bind the id
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch single row as an associative array
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update_data()
    {

        //update query
        $sql_query = "UPDATE {$this->table_name} SET student_names = ?, email = ?, mobile = ? WHERE id = ? ";

        //prepare sql
        $stmt = $this->conn->prepare($sql_query);

        //sanitize sql 
        $this->student_names = htmlspecialchars(strip_tags($this->student_names));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindValue(1, $this->student_names);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->mobile);
        $stmt->bindValue(4, $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}