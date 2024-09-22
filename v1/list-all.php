<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-METHOD: GET");


include_once "../config/database.php";
include_once "../classes/Student.php";


$obj = new Database();

$connectingToDB = $obj->connect();

$student = new Student($connectingToDB);

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $student->records = array();  // Initialize an empty array

    // Assuming $data contains the result set from get_all_data()
    $data = $student->get_all_data();
    $length = count($data);

    if ($length > 0) {
        foreach ($data as $row) {
            // Push each row into the 'records' array
            $student->records[] = $row;
        }

        // // Print the records for debugging
        // echo "<pre>";
        // print_r($student->records);  // This will print the array with all the rows
        // echo "</pre>";

        http_response_code(200);
        echo json_encode([
            "status" => 1,
            "data" => $student->records
        ]);
    } else {
        echo "No data found.";
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => "0",
        'message' =>  "Access Denied"
    ]);
}
