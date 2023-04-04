      

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_entrada/update.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_entradaDao.php';
$_entity = new Producto_entradaDao();
if (isset($_POST['producto_entrada_fecha']) and isset($_POST['producto_entrada_cantidad']) and isset($_POST['producto_entrada_precio']) and isset($_POST['producto_entrada_comision']) and isset($_POST['producto_id']) and  isset($_POST['producto_entrada_id'])) {
$producto_entrada_fecha = $_POST['producto_entrada_fecha']; 
$producto_entrada_cantidad = $_POST['producto_entrada_cantidad']; 
$producto_entrada_precio = $_POST['producto_entrada_precio']; 
$producto_entrada_comision = $_POST['producto_entrada_comision']; 
$producto_id = $_POST['producto_id'];
$producto_entrada_id = $_POST['producto_entrada_id'];
$_entity->update($producto_entrada_fecha, $producto_entrada_cantidad, $producto_entrada_precio, $producto_entrada_comision, $producto_id, $producto_entrada_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>     