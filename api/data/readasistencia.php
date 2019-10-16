<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/asistencia.php';
 
// instantiate database and asistencia object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new ASISTENCIA_HORARIO($db);
 
// read products will be here
// query products
$stmt = $product->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
        
    // asistencia array
    $asistencia_arr=array();
    $asistencia_arr["Asistencias"]=array();
 
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $asistencia_item=array(
            'asiste_emp_numdocumento' => $asiste_emp_numdocumento,
            'asiste_fecha'  => $asiste_fecha,
            'asiste_entrada_programada'=> $asiste_entrada_programada,
            'asiste_salida_programada'=> $asiste_salida_programada,
            'asiste_entrada_registrada'=> $asiste_entrada_registrada,
            'asiste_salida_registrada'=> $asiste_salida_registrada,
            'asiste_turno'=> $asiste_turno,
            'asiste_tipo'=> $asiste_tipo,
            'asiste_fhcreacion'=> $asiste_fhcreacion,
            'asiste_fhmodificacion'=> $asiste_fhmodificacion,
            'asiste_createdby'=> $asiste_createdby,
            'asiste_updateby'=> $asiste_updateby,
            'asiste_control'=> $asiste_control
        );
 
        array_push($asistencia_arr["Asistencias"], $asistencia_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($asistencia_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontro asistencia.")
    );
}
// no products found will be here
