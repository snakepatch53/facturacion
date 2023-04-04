
<?php
include './../../dao/Mysql.php';
include './../../dao/BodegaDao.php';
$bodegaDao = new BodegaDao();
if (isset($_POST['bodega_id'])) {
    $bodega_id = $_POST['bodega_id'];
    $bodegaDao->delete($bodega_id);
    echo json_encode(true);
} else {
    echo json_encode(false);
}
