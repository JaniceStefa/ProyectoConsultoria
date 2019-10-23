<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
 

include_once '../objects/empleado.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new asistencia($db);

$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->emp_numdocumento) &&
    !empty($data->emp_tipodocumento) &&
    !empty($data->emp_nombre) &&
    !empty($data->emp_apellido)
){
 
  
    $product->emp_numdocumento = $data->emp_numdocumento;
    $product->emp_tipodocumento = $data->emp_tipodocumento;
    $product->emp_nombre = $data->emp_nombre;
    $product->emp_apellido = $data->emp_apellido;
    $product->emp_email = $data->emp_email;
    $product->emp_telefono = $data->emp_telefono;
    $product->emp_direccion = $data->emp_direccion;
    $product->emp_estado = $data->emp_estado;
    $product->emp_fhcreacion = $data->emp_fhcreacion;
    $product->emp_fhmodificacion = $data->emp_fhmodificacion;
    $product->emp_createdby = $data->emp_createdby;
    $product->emp_updateby = $data->emp_updateby;

 

    if($product->create()){
 
       
        http_response_code(201);
 

        echo json_encode(array("message" => "Was created."));
    }

    else{

        http_response_code(503);

        echo json_encode(array("message" => "No se pude Crear ."));
    }
}

else{
 

    http_response_code(400);

    echo json_encode(array("message" => "Falta datos."));
}
?>