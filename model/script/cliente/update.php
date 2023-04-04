
<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/cliente/update.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ClienteDao.php';
$_entity = new ClienteDao();
if (isset($_POST['cliente_nombre1']) and isset($_POST['cliente_nombre2']) and isset($_POST['cliente_apellido1']) and isset($_POST['cliente_apellido2']) and isset($_POST['cliente_cedula']) and isset($_POST['cliente_ruc']) and isset($_POST['cliente_ciudad']) and isset($_POST['cliente_direccion']) and isset($_POST['cliente_telefono']) and isset($_POST['cliente_celular']) and isset($_POST['cliente_email']) and  isset($_POST['cliente_id'])) {
$cliente_nombre1 = $_POST['cliente_nombre1']; 
$cliente_nombre2 = $_POST['cliente_nombre2']; 
$cliente_apellido1 = $_POST['cliente_apellido1']; 
$cliente_apellido2 = $_POST['cliente_apellido2']; 
$cliente_cedula = $_POST['cliente_cedula']; 
$cliente_ruc = $_POST['cliente_ruc']; 
$cliente_ciudad = $_POST['cliente_ciudad']; 
$cliente_direccion = $_POST['cliente_direccion']; 
$cliente_telefono = $_POST['cliente_telefono']; 
$cliente_celular = $_POST['cliente_celular']; 
$cliente_email = $_POST['cliente_email'];
$cliente_id = $_POST['cliente_id'];
$_entity->update($cliente_nombre1, $cliente_nombre2, $cliente_apellido1, $cliente_apellido2, $cliente_cedula, $cliente_ruc, $cliente_ciudad, $cliente_direccion, $cliente_telefono, $cliente_celular, $cliente_email, $cliente_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>  