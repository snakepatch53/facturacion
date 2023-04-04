
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_venta/selectById.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_ventaDao.php';
$_entity = new Producto_ventaDao();
if (isset($_POST['producto_venta_id'])) {
$producto_venta_id = $_POST['producto_venta_id'];
$rs = $_entity->selectById($producto_venta_id);
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
} else {
echo json_encode([null]);
}
?>