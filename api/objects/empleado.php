<?php
class asistencia{
 
 
    private $conn;
    private $table_name = "empleado";
 

    public $emp_numdocumento;
    public $emp_tipodocumento;
    public $emp_nombre;
    public $emp_apellido;
    public $emp_email;
    public $emp_telefono;
    public $emp_direccion;
    public $emp_estado;
    public $emp_fhcreacion;
    public $emp_fhmodificacion;
    public $emp_createdby;
    public $emp_updateby;


 

    public function __construct($db){
        $this->conn = $db;
    }
  
   
   
    function create(){
 
     
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    emp_numdocumento=:emp_numdocumento,
                    emp_tipodocumento=:emp_tipodocumento, 
                    emp_nombre=:emp_nombre,
                    emp_apellido=:emp_apellido,
                    emp_email=:emp_email,
                    emp_telefono=:emp_telefono,
                    emp_direccion=:emp_direccion,
                    emp_estado=:emp_estado,
                    emp_fhcreacion=:emp_fhcreacion,
                    emp_fhmodificacion=:emp_fhmodificacion,
                    emp_createdby=:emp_createdby,
                    emp_updateby=:emp_updateby ";
    
     
        $stmt = $this->conn->prepare($query);
    
      
        $this->emp_numdocumento=htmlspecialchars(strip_tags($this->emp_numdocumento));
        $this->emp_tipodocumento=htmlspecialchars(strip_tags($this->emp_tipodocumento));
        $this->emp_nombre=htmlspecialchars(strip_tags($this->emp_nombre));
        $this->emp_apellido=htmlspecialchars(strip_tags($this->emp_apellido));
        $this->emp_email=htmlspecialchars(strip_tags($this->emp_email));
        $this->emp_telefono=htmlspecialchars(strip_tags($this->emp_telefono));
        $this->emp_direccion=htmlspecialchars(strip_tags($this->emp_direccion));
        $this->emp_estado=htmlspecialchars(strip_tags($this->emp_estado));
        $this->emp_fhcreacion=htmlspecialchars(strip_tags($this->emp_fhcreacion));
        $this->emp_fhmodificacion=htmlspecialchars(strip_tags($this->emp_fhmodificacion));
        $this->emp_createdby=htmlspecialchars(strip_tags($this->emp_createdby));
        $this->emp_updateby=htmlspecialchars(strip_tags($this->emp_updateby));

    
       
        $stmt->bindParam(":emp_numdocumento", $this->emp_numdocumento);
        $stmt->bindParam(":emp_tipodocumento", $this->emp_tipodocumento);
        $stmt->bindParam(":emp_nombre", $this->emp_nombre);
        $stmt->bindParam(":emp_apellido", $this->emp_apellido);
        $stmt->bindParam(":emp_email", $this->emp_email);
        $stmt->bindParam(":emp_telefono", $this->emp_telefono);
        $stmt->bindParam(":emp_direccion", $this->emp_direccion);
        $stmt->bindParam(":emp_estado", $this->emp_estado);
        $stmt->bindParam(":emp_fhcreacion", $this->emp_fhcreacion);
        $stmt->bindParam(":emp_fhmodificacion", $this->emp_fhmodificacion);
        $stmt->bindParam(":emp_createdby", $this->emp_createdby);
        $stmt->bindParam(":emp_updateby", $this->emp_updateby);     
    
       
        if($stmt->execute()){
            return true;
        }
    
        return false;
     
    }
}
