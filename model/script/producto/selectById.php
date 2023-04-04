
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto/selectById.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProductoDao.php';
$_entity = new ProductoDao();
if (isset($_POST['producto_id'])) {
$producto_id = $_POST['producto_id'];
$rs = $_entity->selectById($producto_id);
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
} else {
echo json_encode([null]);
}
?>