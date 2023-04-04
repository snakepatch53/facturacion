
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/PrivilegioDao.php';
$privilegioDao = new PrivilegioDao();
if (isset(
    $_POST['privilegio_nombre'],
    $_POST['privilegio_informacion'],
    $_POST['privilegio_privilegio'],
    $_POST['privilegio_usuario'],
    $_POST['privilegio_bodega'],
    $_POST['privilegio_proveedor'],
    $_POST['privilegio_cliente'],
    $_POST['privilegio_producto'],
    $_POST['privilegio_compra'],
    $_POST['privilegio_venta'],
    $_POST['privilegio_id']
)) {
    $privilegio_nombre = $_POST['privilegio_nombre'];
    $privilegio_informacion = $_POST['privilegio_informacion'];
    $privilegio_privilegio = $_POST['privilegio_privilegio'];
    $privilegio_usuario = $_POST['privilegio_usuario'];
    $privilegio_bodega = $_POST['privilegio_bodega'];
    $privilegio_proveedor = $_POST['privilegio_proveedor'];
    $privilegio_cliente = $_POST['privilegio_cliente'];
    $privilegio_producto = $_POST['privilegio_producto'];
    $privilegio_compra = $_POST['privilegio_compra'];
    $privilegio_venta = $_POST['privilegio_venta'];
    $privilegio_id = $_POST['privilegio_id'];
    $privilegioDao->update(
        $privilegio_nombre,
        $privilegio_informacion,
        $privilegio_privilegio,
        $privilegio_usuario,
        $privilegio_bodega,
        $privilegio_proveedor,
        $privilegio_cliente,
        $privilegio_producto,
        $privilegio_compra,
        $privilegio_venta,
        $privilegio_id
    );
    echo json_encode(true);
} else {
    echo json_encode(false);
}
