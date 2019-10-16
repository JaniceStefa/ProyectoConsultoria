<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
 

include_once '../objects/asistencia.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new ASISTENCIA_HORARIO($db);

$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->asiste_emp_numdocumento) &&
    !empty($data->asiste_fecha) &&
    !empty($data->asiste_entrada_programada) &&
    !empty($data->asiste_salida_programada)
){
 

    $product->asiste_emp_numdocumento = $data->asiste_emp_numdocumento;
    $product->asiste_fecha = $data->asiste_fecha;
    $product->asiste_entrada_programada = $data->asiste_entrada_programada;
    $product->asiste_salida_programada = $data->asiste_salida_programada;
    $product->asiste_entrada_registrada = $data->asiste_entrada_registrada;
    $product->asiste_salida_registrada = $data->asiste_salida_registrada;
    $product->asiste_turno = $data->asiste_turno;
    $product->asiste_tipo = $data->asiste_tipo;
    $product->asiste_fhcreacion = $data->asiste_fhcreacion;
    $product->asiste_fhmodificacion = $data->asiste_fhmodificacion;
    $product->asiste_createdby = $data->asiste_createdby;
    $product->asiste_updateby = $data->asiste_updateby;
    $product->asiste_control = $data->asiste_control;

 

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