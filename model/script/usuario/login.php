<?php
/*
_____________________________________________________________________________________________
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/script/usuario/login.php
*/
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/UsuarioDao.php';
$_entity = new UsuarioDao();
if (isset($_POST['usuario_user']) and isset($_POST['usuario_pass'])) {
    $usuario_user = $_POST['usuario_user'];
    $usuario_pass = md5($_POST['usuario_pass']);
    $usuario_rs = $_entity->login($usuario_user, $usuario_pass);
    if (mysqli_num_rows($usuario_rs)) {
        $usuario_r = mysqli_fetch_assoc($usuario_rs);
        if ($usuario_r['usuario_user'] == $usuario_user and $usuario_r['usuario_pass'] == $usuario_pass) {
            $_SESSION['usuario_id'] = $usuario_r['usuario_id'];
            $_SESSION['usuario_nombre'] = $usuario_r['usuario_nombre'];
            $_SESSION['usuario_user'] = $usuario_r['usuario_user'];
            $_SESSION['usuario_foto'] = $usuario_r['usuario_foto'];

            $_SESSION['privilegio_id'] = $usuario_r['privilegio_id'];
            $_SESSION['privilegio_nombre'] = $usuario_r['privilegio_nombre'];
            $_SESSION['privilegio_informacion'] = $usuario_r['privilegio_informacion'];
            $_SESSION['privilegio_privilegio'] = $usuario_r['privilegio_privilegio'];
            $_SESSION['privilegio_usuario'] = $usuario_r['privilegio_usuario'];
            $_SESSION['privilegio_bodega'] = $usuario_r['privilegio_bodega'];
            $_SESSION['privilegio_proveedor'] = $usuario_r['privilegio_proveedor'];
            $_SESSION['privilegio_cliente'] = $usuario_r['privilegio_cliente'];
            $_SESSION['privilegio_producto'] = $usuario_r['privilegio_producto'];
            $_SESSION['privilegio_compra'] = $usuario_r['privilegio_compra'];
            $_SESSION['privilegio_venta'] = $usuario_r['privilegio_venta'];

            echo json_encode($_SESSION);
        } else {
            echo json_encode(false);
        }
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}
