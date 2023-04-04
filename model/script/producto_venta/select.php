
<?php
// Mapeo de cliente
$cliente_campos = [
    "cliente_nombre1",
    "cliente_nombre2",
    "cliente_apellido1",
    "cliente_apellido2",
    "cliente_cedula",
    "cliente_ruc",
    "cliente_ciudad",
    "cliente_direccion",
    "cliente_telefono",
    "cliente_celular",
    "cliente_email"
];

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_ventaDao.php';
include './../../dao/Producto_salidaDao.php';
include './../../dao/ClienteDao.php';
include './../../library/producto_venta.php';
include './../../library/numero.php';
$producto_ventaDao = new Producto_ventaDao();
$producto_salidaDao = new Producto_salidaDao();
$clienteDao = new ClienteDao();
$producto_venta_rs = $producto_ventaDao->select();
$producto_salida_rs = $producto_salidaDao->select();
$cliente_rs = $clienteDao->select();
$producto_venta_array = array();
while ($producto_venta_r = mysqli_fetch_assoc($producto_venta_rs)) {
    if ($producto_venta_r['cliente_id'] != 0) {
        $cliente = getCliente($producto_venta_r['cliente_id'], $cliente_rs);
        foreach ($cliente_campos as $index => $cliente_campos_r) {
            $producto_venta_r[$cliente_campos_r] = $cliente[$cliente_campos_r];
        }
    } else {
        foreach ($cliente_campos as $index => $cliente_campos_r) {
            $producto_venta_r[$cliente_campos_r] = false;
        }
    }
    $producto_venta_r = getProducto_salida_array($producto_venta_r['producto_venta_id'], $producto_salida_rs, $producto_venta_r);
    $producto_venta_array[] = $producto_venta_r;
}
echo json_encode($producto_venta_array);
?>