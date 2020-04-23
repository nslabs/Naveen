<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';
  
// instantiate database and student object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$student = new student($db);
  
// read students will be here


// query students
$stmt = $student->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // student array
    $student_arr=array();
    $student_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        // extract row
        extract($row);
  
        $student_item=array(
            "id" => $id,
            "name" => $name,
            "fname" => $fname,
            
        );
  
        array_push($student_arr["records"], $student_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show student data in json format
    echo json_encode($student_arr);
}
  
// no students found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no students found
    echo json_encode(
        array("message" => "No students found.")
    );
}