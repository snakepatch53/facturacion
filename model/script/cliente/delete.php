          
            

<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/cliente/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/ClienteDao.php';
$_entity = new ClienteDao();
if(isset($_POST['cliente_id'])){
$cliente_id = $_POST['cliente_id'];
$_entity->delete($cliente_id);

echo json_encode(["Success"]);
} else {
echo json_encode([null]);
}
?>