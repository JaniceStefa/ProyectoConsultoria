<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/asistencia.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new asistencia($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->asiste_emp_numdocumento) &&
    !empty($data->asiste_fecha) &&
    !empty($data->asiste_hentrada) &&
    !empty($data->asiste_turno)
){
 
    // set product property values
    $product->asiste_emp_numdocumento = $data->asiste_emp_numdocumento;
    $product->asiste_fecha = $data->asiste_fecha;
    $product->asiste_hentrada = $data->asiste_hentrada;
    $product->asiste_turno = $data->asiste_turno;
    $product->asiste_fhcreacion = date('Y-m-d H:i:s');
 
    // create the product
    if($product->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pude Crear ."));
    }
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Falta datos."));
}
?>