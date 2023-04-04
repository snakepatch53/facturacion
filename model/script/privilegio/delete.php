
<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/usuario/delete.php
*/
include './../../dao/Mysql.php';
include './../../dao/PrivilegioDao.php';
$privilegioDao = new PrivilegioDao();
if (isset($_POST['privilegio_id'])) {
    $privilegio_id = $_POST['privilegio_id'];
    $privilegioDao->delete($privilegio_id);
    echo json_encode(true);
} else {
    echo json_encode(false);
}
