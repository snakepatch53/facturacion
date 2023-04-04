<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProductoDao.php';
include './../../dao/Producto_entradaDao.php';
include './../../dao/Producto_salidaDao.php';
include './../../library/numero.php';
include './../../library/producto.php';
$productoDao = new ProductoDao();
$producto_entradaDao = new Producto_entradaDao();
$producto_salidaDao = new Producto_salidaDao();
$producto_rs = $productoDao->select();
$producto_entrada_rs = $producto_entradaDao->select();
$producto_salida_rs = $producto_salidaDao->select();

// echo json_encode($producto_rs);
echo json_encode(getProducto_array($producto_rs, $producto_entrada_rs, $producto_salida_rs));
