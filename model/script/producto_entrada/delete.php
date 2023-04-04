       
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_entrada/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/Producto_entradaDao.php';
$_entity = new Producto_entradaDao();
if(isset($_POST['producto_entrada_id'])){
$producto_entrada_id = $_POST['producto_entrada_id'];
$_entity->delete($producto_entrada_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>