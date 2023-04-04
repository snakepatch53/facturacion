
<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/proveedor/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/ProveedorDao.php';
$_entity = new ProveedorDao();
if(isset($_POST['proveedor_id'])){
$proveedor_id = $_POST['proveedor_id'];
$_entity->delete($proveedor_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>