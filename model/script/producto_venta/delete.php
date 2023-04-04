        
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_venta/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/Producto_ventaDao.php';
$_entity = new Producto_ventaDao();
if(isset($_POST['producto_venta_id'])){
$producto_venta_id = $_POST['producto_venta_id'];
$_entity->delete($producto_venta_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>
            