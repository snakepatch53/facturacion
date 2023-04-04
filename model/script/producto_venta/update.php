
<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_venta/update.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_ventaDao.php';
$_entity = new Producto_ventaDao();
if (isset($_POST['producto_venta_fecha']) and isset($_POST['producto_venta_html']) and isset($_POST['cliente_id']) and isset($_POST['usuario_id']) and  isset($_POST['producto_venta_id'])) {
$producto_venta_fecha = $_POST['producto_venta_fecha']; 
$producto_venta_html = $_POST['producto_venta_html']; 
$cliente_id = $_POST['cliente_id']; 
$usuario_id = $_POST['usuario_id'];
$producto_venta_id = $_POST['producto_venta_id'];
$_entity->update($producto_venta_fecha, $producto_venta_html, $cliente_id, $usuario_id, $producto_venta_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>    