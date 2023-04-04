                            
<?php

class ClienteDao{
private $conn;
public function __construct(){
$this->conn = new Mysql();
}
public function select(){
return $this->conn->query("SELECT * FROM cliente");
}
public function selectById($cliente_id){
return $this->conn->query("SELECT * FROM cliente WHERE cliente_id = $cliente_id");
}
public function insert($cliente_nombre1, $cliente_nombre2, $cliente_apellido1, $cliente_apellido2, $cliente_cedula, $cliente_ruc, $cliente_ciudad, $cliente_direccion, $cliente_telefono, $cliente_celular, $cliente_email){
return $this->conn->query("INSERT INTO cliente SET cliente_nombre1='$cliente_nombre1', cliente_nombre2='$cliente_nombre2', cliente_apellido1='$cliente_apellido1', cliente_apellido2='$cliente_apellido2', cliente_cedula='$cliente_cedula', cliente_ruc='$cliente_ruc', cliente_ciudad='$cliente_ciudad', cliente_direccion='$cliente_direccion', cliente_telefono='$cliente_telefono', cliente_celular='$cliente_celular', cliente_email='$cliente_email' ");
}
public function update($cliente_nombre1, $cliente_nombre2, $cliente_apellido1, $cliente_apellido2, $cliente_cedula, $cliente_ruc, $cliente_ciudad, $cliente_direccion, $cliente_telefono, $cliente_celular, $cliente_email, $cliente_id){
return $this->conn->query("UPDATE cliente SET cliente_nombre1='$cliente_nombre1', cliente_nombre2='$cliente_nombre2', cliente_apellido1='$cliente_apellido1', cliente_apellido2='$cliente_apellido2', cliente_cedula='$cliente_cedula', cliente_ruc='$cliente_ruc', cliente_ciudad='$cliente_ciudad', cliente_direccion='$cliente_direccion', cliente_telefono='$cliente_telefono', cliente_celular='$cliente_celular', cliente_email='$cliente_email' WHERE cliente_id = $cliente_id ");
}
public function delete($cliente_id){
return $this->conn->query("DELETE FROM cliente WHERE cliente_id = $cliente_id ");
}


}
?>
            
                        