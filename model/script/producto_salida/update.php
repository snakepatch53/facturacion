
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_salida/update.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_salidaDao.php';
$_entity = new Producto_salidaDao();
if (isset($_POST['producto_salida_fecha']) and isset($_POST['producto_salida_cantidad']) and isset($_POST['producto_salida_precio']) and isset($_POST['producto_salida_comision']) and isset($_POST['producto_id']) and isset($_POST['venta_id']) and  isset($_POST['producto_salida_id'])) {
$producto_salida_fecha = $_POST['producto_salida_fecha']; 
$producto_salida_cantidad = $_POST['producto_salida_cantidad']; 
$producto_salida_precio = $_POST['producto_salida_precio']; 
$producto_salida_comision = $_POST['producto_salida_comision']; 
$producto_id = $_POST['producto_id']; 
$venta_id = $_POST['venta_id'];
$producto_salida_id = $_POST['producto_salida_id'];
$_entity->update($producto_salida_fecha, $producto_salida_cantidad, $producto_salida_precio, $producto_salida_comision, $producto_id, $venta_id, $producto_salida_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>    