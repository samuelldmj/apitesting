<?php
// Set headers to allow access and return JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/database.php";
include_once "../classes/Student.php";

// Instantiate Database and connect
$obj = new Database();
$connectingToDB = $obj->connect();

// Instantiate the Student object
$student = new Student($connectingToDB);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));


    // print_r($data);
    if (!empty($data->student_names) && !empty($data->email) && !empty($data->mobile) && !empty($data->id)) {

        $student->student_names = $data->student_names;
        $student->email = $data->email;
        $student->mobile = $data->mobile;
        $student->id = $data->id;


        if ($student->update_data()) {
            http_response_code(200);
            echo json_encode([
                "status" => 1,
                'message' => "---Student Data Created Successfully---"
            ]);
        } else {

            http_response_code(500);
            echo json_encode([
                "status" => 0,
                'message' =>  "---Student Data failed to be inserted---"
            ]);
        }
    } else {
        // Send 503 Service Unavailable if wrong method
        http_response_code(404);
        echo json_encode([
            "status" => 0,
            "message" => "All data needed!"
        ]);
    }
} else {
    // Send 503 Service Unavailable if wrong method
    http_response_code(503);
    echo json_encode([
        "status" => 0,
        "message" => "Access Denied"
    ]);
}
