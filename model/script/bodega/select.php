<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/BodegaDao.php';
$bodegaDao = new BodegaDao();
$rs = $bodegaDao->select();
$array = array();
while ($r = mysqli_fetch_assoc($rs)) {
    $array[] = $r;
}
echo json_encode($array);
