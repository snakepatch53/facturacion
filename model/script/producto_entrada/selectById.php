
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_entrada/selectById.php
*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/Producto_entradaDao.php';
$_entity = new Producto_entradaDao();
if (isset($_POST['producto_entrada_id'])) {
$producto_entrada_id = $_POST['producto_entrada_id'];
$rs = $_entity->selectById($producto_entrada_id);
$array = array();
while($r = mysqli_fetch_assoc($rs)) {
$array[] = $r;
}
echo json_encode($array);
} else {
echo json_encode([null]);
}
?>