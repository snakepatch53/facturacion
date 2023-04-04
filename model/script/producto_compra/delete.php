
<?php

include './../../dao/Mysql.php';
include './../../dao/Producto_compraDao.php';
$_entity = new Producto_compraDao();
if(isset($_POST['producto_compra_id'])){
$producto_compra_id = $_POST['producto_compra_id'];
$_entity->delete($producto_compra_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>