
<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_entrada/select.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_entradaDao.php';
$_entity = new Producto_entradaDao();
$rs = $_entity->select();
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
?>