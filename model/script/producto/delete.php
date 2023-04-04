<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/ProductoDao.php';
$_entity = new ProductoDao();
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $_entity->delete($producto_id);
    if (file_exists("../../../view/src/file/producto_foto/" . $producto_id . ".png")) {
        unlink("../../../view/src/file/producto_foto/" . $producto_id . ".png");
    }
    echo json_encode(true);
} else {
    echo json_encode(false);
}
?>
