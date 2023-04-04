
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/UsuarioDao.php';
$usuarioDao = new UsuarioDao();
if (isset(
    $_POST['usuario_nombre'],
    $_POST['usuario_user'],
    $_POST['usuario_pass'],
    $_POST['privilegio_id'],
    $_POST['usuario_id']
)) {
    $usuario_nombre = $_POST['usuario_nombre'];
    $usuario_user = $_POST['usuario_user'];
    $usuario_pass = $_POST['usuario_pass'];
    $privilegio_id = $_POST['privilegio_id'];
    $usuario_id = $_POST['usuario_id'];
    $usuarioDao->update(
        $usuario_nombre,
        $usuario_user,
        $privilegio_id,
        $usuario_id
    );
    if ($usuario_pass != "" or $usuario_pass != null) {
        $usuarioDao->updatePassword(
            md5($usuario_pass),
            $usuario_id
        );
    }
    if (isset($_FILES['usuario_foto'])) {
        $usuario_foto = $_FILES['usuario_foto'];
        if ($usuario_foto['tmp_name'] != "" or $usuario_foto['tmp_name'] != null) {
            if (!file_exists('../../../view/src/file/usuario_foto')) {
                mkdir("../../../view/src/file/usuario_foto", 0700);
            }
            $desde = $usuario_foto['tmp_name'];
            $hasta = "../../../view/src/file/usuario_foto/" . $usuario_id . ".png";
            copy($desde, $hasta);
            $usuarioDao->updateUsuario_foto($usuario_id . ".png", $usuario_id);
        }
    }
    echo json_encode(true);
} else {
    echo json_encode(false);
}
