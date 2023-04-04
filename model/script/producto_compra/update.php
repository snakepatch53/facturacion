
<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_compraDao.php';
$_entity = new Producto_compraDao();
if (isset($_POST['producto_compra_fecha']) and isset($_POST['producto_compra_html']) and isset($_POST['producto_compra_iva']) and isset($_POST['proveedor_id']) and isset($_POST['usuario_id']) and  isset($_POST['producto_compra_id'])) {
$producto_compra_fecha = $_POST['producto_compra_fecha']; 
$producto_compra_html = $_POST['producto_compra_html']; 
$producto_compra_iva = $_POST['producto_compra_iva']; 
$proveedor_id = $_POST['proveedor_id']; 
$usuario_id = $_POST['usuario_id'];
$producto_compra_id = $_POST['producto_compra_id'];
$_entity->update($producto_compra_fecha, $producto_compra_html, $producto_compra_iva, $proveedor_id, $usuario_id, $producto_compra_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>   