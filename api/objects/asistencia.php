<?php
class asistencia{
 
 
    private $conn;
    private $table_name = "asistencia";
 

    public $emp_numdocumento;
    public $emp_nombre;
    public $emp_apellido;
    public $emp_email;
    public $emp_telefono;

 

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
 

    $query = "SELECT * from asistencia";
 

    $stmt = $this->conn->prepare($query);
 
    
    $stmt->execute();
 
    return $stmt;
    }

   
    function readOne() {
    
        
        $query = "SELECT * from asistencia 
                WHERE  asistencia.asiste_emp_numdocumento = ? 
                ORDER BY asiste_fhmodificacion  DESC ";

    
        $stmt = $this->conn->prepare( $query );    
    
        $stmt->bindParam(1, $this->asiste_emp_numdocumento);
        
      
        $stmt->execute();
    
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        
        $this->asiste_emp_numdocumento = $row['asiste_emp_numdocumento'];
        $this->asiste_fecha = $row['asiste_fecha'];
        $this->asiste_hentrada = $row['asiste_hentrada'];
        $this->asiste_id = $row['asiste_id'];
        $this->asiste_fhmodificacion = $row['asiste_fhmodificacion'];
    }

    function create(){
 
     
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    asiste_emp_numdocumento=:asiste_emp_numdocumento,
                    asiste_fecha=:asiste_fecha, 
                    asiste_hentrada=:asiste_hentrada,
                    asiste_turno=:asiste_turno,
                    asiste_fhcreacion=:asiste_fhcreacion";
    
     
        $stmt = $this->conn->prepare($query);
    
      
        $this->name=htmlspecialchars(strip_tags($this->asiste_emp_numdocumento));
        $this->price=htmlspecialchars(strip_tags($this->asiste_fecha));
        $this->description=htmlspecialchars(strip_tags($this->asiste_hentrada));
        $this->category_id=htmlspecialchars(strip_tags($this->asiste_turno));
        $this->created=htmlspecialchars(strip_tags($this->asiste_fhcreacion));
    
       
        $stmt->bindParam(":asiste_emp_numdocumento", $this->asiste_emp_numdocumento);
        $stmt->bindParam(":asiste_fecha", $this->asiste_fecha);
        $stmt->bindParam(":asiste_hentrada", $this->asiste_hentrada);
        $stmt->bindParam(":asiste_turno", $this->asiste_turno);
        $stmt->bindParam(":asiste_fhcreacion", $this->asiste_fhcreacion);
    
       
        if($stmt->execute()){
            return true;
        }
    
        return false;
     
    }
}
