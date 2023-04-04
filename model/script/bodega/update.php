
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/BodegaDao.php';
$bodegaDao = new BodegaDao();
if (isset(
    $_POST['bodega_nombre'],
    $_POST['bodega_descripcion'],
    $_POST['bodega_id']
)) {
    $bodega_nombre = $_POST['bodega_nombre'];
    $bodega_descripcion = $_POST['bodega_descripcion'];
    $bodega_id = $_POST['bodega_id'];
    $bodegaDao->update(
        $bodega_nombre,
        $bodega_descripcion,
        $bodega_id
    );
    echo json_encode(true);
} else {
    echo json_encode(false);
}
