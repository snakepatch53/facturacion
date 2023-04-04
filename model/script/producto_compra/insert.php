<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_compraDao.php';
include './../../dao/Producto_entradaDao.php';
$producto_compraDao = new Producto_compraDao();
$producto_entradaDao = new Producto_entradaDao();
if (isset(
    $_POST['producto_array'],
    $_POST['producto_venta_fecha'],
    $_POST['producto_venta_iva'],
    $_POST['proveedor_id'],
    $_POST['usuario_id']
)) {
    // INSERT COMPRA
    $producto_compra_fecha = $_POST['producto_venta_fecha'];
    $producto_compra_iva = $_POST['producto_venta_iva'];
    $proveedor_id = $_POST['proveedor_id'];
    $usuario_id = $_POST['usuario_id'];
    $producto_compraDao->insert(
        $producto_compra_fecha,
        $producto_compra_iva,
        $proveedor_id,
        $usuario_id
    );

    // INSERT ENTRADA
    $producto_compra_id = $producto_compraDao->getLastId();
    $decodedText = html_entity_decode($_POST['producto_array']);
    $prodcuto_array = json_decode($decodedText, true);
    $tmp = array();
    foreach ($prodcuto_array as $index => $producto_r) {
        $producto_entradaDao->insert(
            $producto_compra_fecha,
            $producto_r['producto_cantidad'],
            $producto_r['producto_precio'],
            $producto_r['producto_comision'],
            $producto_r['producto_id'],
            $producto_compra_id
        );
    }
    echo json_encode($producto_compra_id);
} else {
    echo json_encode(false);
}
