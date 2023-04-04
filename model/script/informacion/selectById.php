<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/InformacionDao.php';
$_entity = new InformacionDao();
if (isset($_POST['informacion_id'])) {
    $informacion_id = $_POST['informacion_id'];
    $rs = $_entity->selectById($informacion_id);
    $array = array();
    while ($r = mysqli_fetch_assoc($rs)) {
        $array[] = $r;
    }
    echo json_encode($array);
} else {
    echo json_encode([null]);
}
