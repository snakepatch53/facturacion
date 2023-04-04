<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto/insert.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/ProductoDao.php';
$productoDao = new ProductoDao();
if (
    isset($_POST['producto_nombre']) and
    isset($_POST['producto_codigo']) and
    isset($_POST['producto_marca']) and
    isset($_POST['producto_modelo']) and
    isset($_POST['producto_elaboracion']) and
    isset($_POST['producto_vencimiento']) and
    isset($_POST['producto_descripcion']) and
    isset($_POST['bodega_id'])
) {
    $producto_nombre = $_POST['producto_nombre'];
    $producto_codigo = $_POST['producto_codigo'];
    $producto_marca = $_POST['producto_marca'];
    $producto_modelo = $_POST['producto_modelo'];
    $producto_elaboracion = $_POST['producto_elaboracion'];
    $producto_vencimiento = $_POST['producto_vencimiento'];
    $producto_descripcion = $_POST['producto_descripcion'];
    $bodega_id = $_POST['bodega_id'];
    $productoDao->insert(
        $producto_nombre,
        $producto_codigo,
        $producto_marca,
        $producto_modelo,
        $producto_elaboracion,
        $producto_vencimiento,
        $producto_descripcion,
        $bodega_id
    );

    if (isset($_FILES['producto_foto'])) {
        $producto_foto = $_FILES['producto_foto'];
        if ($producto_foto['tmp_name'] != "" or $producto_foto['tmp_name'] != null) {
            if (!file_exists('../../../view/src/file/producto_foto')) {
                mkdir("../../../view/src/file/producto_foto", 0700);
            }
            $producto_id = $productoDao->getLastId();
            $desde = $producto_foto['tmp_name'];
            $hasta = "../../../view/src/file/producto_foto/" . $producto_id . ".png";
            copy($desde, $hasta);
            $productoDao->updateProducto_foto($producto_id . ".png", $producto_id);
        }
    }

    echo json_encode(true);
} else {
    echo json_encode(false);
}
