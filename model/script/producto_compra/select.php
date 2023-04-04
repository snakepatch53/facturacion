<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_compraDao.php';
include './../../dao/Producto_entradaDao.php';
include './../../dao/proveedorDao.php';
include './../../library/producto_compra.php';
include './../../library/numero.php';
$producto_compraDao = new Producto_compraDao();
$producto_entradaDao = new Producto_entradaDao();
$producto_compra_rs = $producto_compraDao->select();
$producto_entrada_rs = $producto_entradaDao->select();
$producto_compra_array = array();
while ($producto_compra_r = mysqli_fetch_assoc($producto_compra_rs)) {
    $producto_compra_r = getProducto_entrada_array($producto_compra_r['producto_compra_id'], $producto_entrada_rs, $producto_compra_r);
    $producto_compra_array[] = $producto_compra_r;
}
echo json_encode($producto_compra_array);