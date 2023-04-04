<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/proveedor/select.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProveedorDao.php';
$_entity = new ProveedorDao();
$rs = $_entity->select();
$array = array();
while ($r = mysqli_fetch_assoc($rs)) {
    $array[] = $r;
}
echo json_encode($array);
