<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_ventaDao.php';
include './../../dao/Producto_salidaDao.php';
$producto_ventaDao = new Producto_ventaDao();
$producto_salidaDao = new Producto_salidaDao();
if (isset(
    $_POST['producto_array'],
    $_POST['producto_venta_fecha'],
    $_POST['producto_venta_iva'],
    $_POST['cliente_id'],
    $_POST['usuario_id']
)) {
    // INSERT VENTA
    $producto_venta_fecha = $_POST['producto_venta_fecha'];
    $producto_venta_iva = $_POST['producto_venta_iva'];
    $cliente_id = $_POST['cliente_id'];
    $usuario_id = $_POST['usuario_id'];
    $producto_ventaDao->insert(
        $producto_venta_fecha,
        $producto_venta_iva,
        $cliente_id,
        $usuario_id
    );

    // INSERT SALIDA
    $producto_venta_id = $producto_ventaDao->getLastId();
    $decodedText = html_entity_decode($_POST['producto_array']);
    $prodcuto_array = json_decode($decodedText, true);
    $tmp = array();
    foreach ($prodcuto_array as $index => $producto_r) {
        $producto_salidaDao->insert(
            $producto_venta_fecha,
            $producto_r['producto_cantidad'],
            $producto_r['producto_precio'],
            $producto_r['producto_comision'],
            $producto_r['producto_id'],
            $producto_venta_id
        );
    }
    echo json_encode($producto_venta_id);
} else {
    echo json_encode(false);
}
