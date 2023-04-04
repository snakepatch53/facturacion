<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/usuario/select.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/PrivilegioDao.php';
$privilegioDao = new PrivilegioDao();
$rs = $privilegioDao->select();
$array = array();
while ($r = mysqli_fetch_assoc($rs)) {
    $array[] = $r;
}
echo json_encode($array);
