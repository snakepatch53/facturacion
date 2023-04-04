            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/proveedor/insert.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProveedorDao.php';
$_entity = new ProveedorDao();
if (isset($_POST['proveedor_nombre']) and isset($_POST['proveedor_provicia']) and isset($_POST['proveedor_ciudad']) and isset($_POST['proveedor_direccion']) and isset($_POST['proveedor_telefono']) and isset($_POST['proveedor_celular']) and isset($_POST['proveedor_email']) and isset($_POST['proveedor_ruc'])) {
$proveedor_nombre = $_POST['proveedor_nombre']; 
$proveedor_provicia = $_POST['proveedor_provicia']; 
$proveedor_ciudad = $_POST['proveedor_ciudad']; 
$proveedor_direccion = $_POST['proveedor_direccion']; 
$proveedor_telefono = $_POST['proveedor_telefono']; 
$proveedor_celular = $_POST['proveedor_celular']; 
$proveedor_email = $_POST['proveedor_email']; 
$proveedor_ruc = $_POST['proveedor_ruc'];
$_entity->insert($proveedor_nombre, $proveedor_provicia, $proveedor_ciudad, $proveedor_direccion, $proveedor_telefono, $proveedor_celular, $proveedor_email, $proveedor_ruc);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>