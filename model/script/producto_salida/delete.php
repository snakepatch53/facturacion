        
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/producto_salida/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/Producto_salidaDao.php';
$_entity = new Producto_salidaDao();
if(isset($_POST['producto_salida_id'])){
$producto_salida_id = $_POST['producto_salida_id'];
$_entity->delete($producto_salida_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>
            
