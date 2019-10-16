<?php
class ASISTENCIA_HORARIO{
 
 
    private $conn;
    private $table_name = "asistencia";
 

    public $asiste_emp_numdocumento;
    public $asiste_fecha;
    public $asiste_entrada_programada;
    public $asiste_salida_programada;
    public $asiste_entrada_registrada;
    public $asiste_salida_registrada;
    public $asiste_turno;
    public $asiste_tipo;
    public $asiste_fhcreacion;
    public $asiste_fhmodificacion;
    public $asiste_createdby;
    public $asiste_updateby;
    public $asiste_control;



    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
 
     
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    asiste_emp_numdocumento=:asiste_emp_numdocumento,
                    asiste_fecha=:asiste_fecha,
                    asiste_entrada_programada=:asiste_entrada_programada,
                    asiste_salida_programada=:asiste_salida_programada,
                    asiste_entrada_registrada=:asiste_entrada_registrada,
                    asiste_salida_registrada=:asiste_salida_registrada,
                    asiste_turno=:asiste_turno,
                    asiste_tipo=:asiste_tipo,
                    asiste_fhcreacion=:asiste_fhcreacion,
                    asiste_fhmodificacion=:asiste_fhmodificacion,
                    asiste_createdby=:asiste_createdby,
                    asiste_updateby=:asiste_updateby,
                    asiste_control=:asiste_control";


        $stmt = $this->conn->prepare($query);
    
      
        $this->asiste_emp_numdocumento=htmlspecialchars(strip_tags($this->asiste_emp_numdocumento));
        $this->asiste_fecha=htmlspecialchars(strip_tags($this->asiste_fecha));
        $this->asiste_entrada_programada=htmlspecialchars(strip_tags($this->asiste_entrada_programada));
        $this->asiste_salida_programada=htmlspecialchars(strip_tags($this->asiste_salida_programada));
        $this->asiste_entrada_registrada=htmlspecialchars(strip_tags($this->asiste_entrada_registrada));
        $this->asiste_salida_registrada=htmlspecialchars(strip_tags($this->asiste_salida_registrada));
        $this->asiste_turno=htmlspecialchars(strip_tags($this->asiste_turno));
        $this->asiste_tipo=htmlspecialchars(strip_tags($this->asiste_tipo));
        $this->asiste_fhcreacion=htmlspecialchars(strip_tags($this->asiste_fhcreacion));
        $this->asiste_fhmodificacion=htmlspecialchars(strip_tags($this->asiste_fhmodificacion));
        $this->asiste_createdby=htmlspecialchars(strip_tags($this->asiste_createdby));
        $this->asiste_updateby=htmlspecialchars(strip_tags($this->asiste_updateby));
        $this->asiste_control=htmlspecialchars(strip_tags($this->asiste_control));

    
       
        $stmt->bindParam(":asiste_emp_numdocumento", $this->asiste_emp_numdocumento);
        $stmt->bindParam(":asiste_fecha", $this->asiste_fecha);
        $stmt->bindParam(":asiste_entrada_programada", $this->asiste_entrada_programada);   
        $stmt->bindParam(":asiste_salida_programada", $this->asiste_salida_programada);
        $stmt->bindParam(":asiste_entrada_registrada", $this->asiste_entrada_registrada);
        $stmt->bindParam(":asiste_salida_registrada", $this->asiste_salida_registrada);
        $stmt->bindParam(":asiste_turno", $this->asiste_turno);
        $stmt->bindParam(":asiste_tipo", $this->asiste_tipo);
        $stmt->bindParam(":asiste_fhcreacion", $this->asiste_fhcreacion);
        $stmt->bindParam(":asiste_fhmodificacion", $this->asiste_fhmodificacion);
        $stmt->bindParam(":asiste_createdby", $this->asiste_createdby);
        $stmt->bindParam(":asiste_updateby", $this->asiste_updateby);
        $stmt->bindParam(":asiste_control", $this->asiste_control);

       
        if($stmt->execute()){
            return true;
        }
    
        return false;
     
    }
}
