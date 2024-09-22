<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json: charset=UTF-8");
header("Access-Control-Allow-METHOD: POST");


include_once "../config/database.php";
include_once "../classes/Student.php";


$obj = new Database();

$connectingToDB = $obj->connect();

$student = new Student($connectingToDB);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //getting data from  the body of our request parameter;
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->student_names) && !empty($data->email) && !empty($data->mobile)) {

        //submitting to test in thunder api
        $student->student_names = $data->student_names;
        $student->email = $data->email;
        $student->mobile = $data->mobile;

        if ($student->create_data()) {
            http_response_code(200);
            echo json_encode([
                "status" => "1",
                'message' => "---Student Data Created Successfully---"
            ]);
        } else {

            http_response_code(500);
            echo json_encode([
                "status" => "0",
                'message' =>  "---Student Data failed to be inserted---"
            ]);
        }
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => "0",
        'message' =>  "Access Denied"
    ]);
}
