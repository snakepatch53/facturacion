
            

<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_compraDao.php';
$_entity = new Producto_compraDao();
if (isset($_POST['producto_compra_id'])) {
$producto_compra_id = $_POST['producto_compra_id'];
$rs = $_entity->selectById($producto_compra_id);
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
} else {
echo json_encode([null]);
}
?>