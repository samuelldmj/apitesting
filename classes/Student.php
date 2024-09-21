<?php

class Student
{

    public $student_names;
    public $email;
    public $mobile;


    private $conn;
    private $table_name;

    //constructor
    public function __construct($db)
    {

        $this->conn = $db;
        $this->table_name = "tbl_students";
    }

    public function create_data()
    {
        $query = "INSERT INTO " . $this->table_name . "SET student_names = ?, email = ?
        mobile = ? ";

        $obj = $this->conn->prepare($query);

        //sanitizing input variable
        $this->student_names = htmlspecialchars(strip_tags($this->student_names));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));

        //binding parameter
        $obj->bind_param("sss", $this->student_names, $this->email, $this->mobile);

        if ($obj->execute()) {
            return true;
        }
        return false;
    }
}
