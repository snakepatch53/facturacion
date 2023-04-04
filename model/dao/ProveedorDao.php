                            
<?php

class ProveedorDao{
private $conn;
public function __construct(){
$this->conn = new Mysql();
}
public function select(){
return $this->conn->query("SELECT * FROM proveedor");
}
public function selectById($proveedor_id){
return $this->conn->query("SELECT * FROM proveedor WHERE proveedor_id = $proveedor_id");
}
public function insert($proveedor_nombre, $proveedor_provicia, $proveedor_ciudad, $proveedor_direccion, $proveedor_telefono, $proveedor_celular, $proveedor_email, $proveedor_ruc){
return $this->conn->query("INSERT INTO proveedor SET proveedor_nombre='$proveedor_nombre', proveedor_provicia='$proveedor_provicia', proveedor_ciudad='$proveedor_ciudad', proveedor_direccion='$proveedor_direccion', proveedor_telefono='$proveedor_telefono', proveedor_celular='$proveedor_celular', proveedor_email='$proveedor_email', proveedor_ruc='$proveedor_ruc' ");
}
public function update($proveedor_nombre, $proveedor_provicia, $proveedor_ciudad, $proveedor_direccion, $proveedor_telefono, $proveedor_celular, $proveedor_email, $proveedor_ruc, $proveedor_id){
return $this->conn->query("UPDATE proveedor SET proveedor_nombre='$proveedor_nombre', proveedor_provicia='$proveedor_provicia', proveedor_ciudad='$proveedor_ciudad', proveedor_direccion='$proveedor_direccion', proveedor_telefono='$proveedor_telefono', proveedor_celular='$proveedor_celular', proveedor_email='$proveedor_email', proveedor_ruc='$proveedor_ruc' WHERE proveedor_id = $proveedor_id ");
}
public function delete($proveedor_id){
return $this->conn->query("DELETE FROM proveedor WHERE proveedor_id = $proveedor_id ");
}


}
?>
            
                        
