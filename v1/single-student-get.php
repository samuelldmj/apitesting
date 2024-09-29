<!-- Now the PHP script to get the single student data -->

<?php
// Set headers to allow access and return JSON
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET");

include_once "../config/database.php";
include_once "../classes/Student.php";

// Instantiate Database and connect
$obj = new Database();
$connectingToDB = $obj->connect();

// Instantiate the Student object
$student = new Student($connectingToDB);

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    // Get the input data from the request body (JSON)
    $student_id = isset($_GET['id']) ? intval($_GET['id']) : " ";

    // Check if id is provided
    if (!empty($student_id)) {

        // Set the student id
        $student->id = $student_id;

        // Get student data by id
        $student_data = $student->get_single_data();

        // Check if data exists
        if ($student_data) {
            // Send 200 OK response
            http_response_code(200);
            // Return the data in JSON format
            echo json_encode([
                "status" => "1",
                "data" => $student_data,
            ]);
        } else {
            // Send 404 not found if no data
            http_response_code(404);
            echo json_encode([
                "status" => "0",
                "message" => "No student found with the given id"
            ]);
        }
    } else {
        // Send 400 Bad Request if id is missing
        http_response_code(400);
        echo json_encode([
            "status" => "0",
            "message" => "Student id is required"
        ]);
    }
} else {
    // Send 503 Service Unavailable if wrong method
    http_response_code(503);
    echo json_encode([
        "status" => "0",
        "message" => "Access Denied"
    ]);
}
