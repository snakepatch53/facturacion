<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/proveedor/selectById.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProveedorDao.php';
$_entity = new ProveedorDao();
if (isset($_POST['proveedor_id'])) {
$proveedor_id = $_POST['proveedor_id'];
$rs = $_entity->selectById($proveedor_id);
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
} else {
echo json_encode([null]);
}
?>
