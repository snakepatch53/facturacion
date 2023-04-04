<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include './../../dao/Mysql.php';
include './../../dao/InformacionDao.php';
$informacionDao = new InformacionDao();
if (isset(
    $_POST['informacion_nombre'],
    $_POST['informacion_sigla'],
    $_POST['informacion_ciudad'],
    $_POST['informacion_direccion'],
    $_POST['informacion_telefono'],
    $_POST['informacion_celular'],
    $_POST['informacion_email'],
    $_POST['informacion_iva'],
    $_POST['informacion_primary_background'],
    $_POST['informacion_primary_background_hover'],
    $_POST['informacion_primary_color'],
    $_POST['informacion_primary_color_hover'],
    $_POST['informacion_secondary_background'],
    $_POST['informacion_secondary_background_hover'],
    $_POST['informacion_secondary_color'],
    $_POST['informacion_secondary_color_hover'],
    $_POST['informacion_tertiary_background'],
    $_POST['informacion_tertiary_background_hover'],
    $_POST['informacion_tertiary_color'],
    $_POST['informacion_tertiary_color_hover'],
    $_POST['informacion_success'],
    $_POST['informacion_info'],
    $_POST['informacion_warnning'],
    $_POST['informacion_error'],
    $_POST['informacion_id']
)) {
    $informacion_nombre = $_POST['informacion_nombre'];
    $informacion_sigla = $_POST['informacion_sigla'];
    $informacion_ciudad = $_POST['informacion_ciudad'];
    $informacion_direccion = $_POST['informacion_direccion'];
    $informacion_telefono = $_POST['informacion_telefono'];
    $informacion_celular = $_POST['informacion_celular'];
    $informacion_email = $_POST['informacion_email'];
    $informacion_iva = $_POST['informacion_iva'];
    $informacion_primary_background = $_POST['informacion_primary_background'];
    $informacion_primary_background_hover = $_POST['informacion_primary_background_hover'];
    $informacion_primary_color = $_POST['informacion_primary_color'];
    $informacion_primary_color_hover = $_POST['informacion_primary_color_hover'];
    $informacion_secondary_background = $_POST['informacion_secondary_background'];
    $informacion_secondary_background_hover = $_POST['informacion_secondary_background_hover'];
    $informacion_secondary_color = $_POST['informacion_secondary_color'];
    $informacion_secondary_color_hover = $_POST['informacion_secondary_color_hover'];
    $informacion_tertiary_background = $_POST['informacion_tertiary_background'];
    $informacion_tertiary_background_hover = $_POST['informacion_tertiary_background_hover'];
    $informacion_tertiary_color = $_POST['informacion_tertiary_color'];
    $informacion_tertiary_color_hover = $_POST['informacion_tertiary_color_hover'];
    $informacion_success = $_POST['informacion_success'];
    $informacion_info = $_POST['informacion_info'];
    $informacion_warnning = $_POST['informacion_warnning'];
    $informacion_error = $_POST['informacion_error'];
    $informacion_id = $_POST['informacion_id'];
    $res = $informacionDao->update(
        $informacion_nombre,
        $informacion_sigla,
        $informacion_ciudad,
        $informacion_direccion,
        $informacion_telefono,
        $informacion_celular,
        $informacion_email,
        $informacion_iva,
        $informacion_primary_background,
        $informacion_primary_background_hover,
        $informacion_primary_color,
        $informacion_primary_color_hover,
        $informacion_secondary_background,
        $informacion_secondary_background_hover,
        $informacion_secondary_color,
        $informacion_secondary_color_hover,
        $informacion_tertiary_background,
        $informacion_tertiary_background_hover,
        $informacion_tertiary_color,
        $informacion_tertiary_color_hover,
        $informacion_success,
        $informacion_info,
        $informacion_warnning,
        $informacion_error,
        $informacion_id
    );
    if (isset($_FILES['informacion_logo'])) {
        $informacion_logo = $_FILES['informacion_logo'];
        if ($informacion_logo['tmp_name'] != "" or $informacion_logo['tmp_name'] != null) {
            if (!file_exists('../../../view/src/file/informacion_logo')) {
                mkdir("../../../view/src/file/informacion_logo", 0700);
            }
            $desde = $informacion_logo['tmp_name'];
            $hasta = "../../../view/src/file/informacion_logo/" . $informacion_id . ".png";
            copy($desde, $hasta);
            $informacionDao->updateInformacion_logo($informacion_id . ".png", $informacion_id);
        }
    }
    if (isset($_FILES['informacion_icon'])) {
        $informacion_icon = $_FILES['informacion_icon'];
        if ($informacion_icon['tmp_name'] != "" or $informacion_icon['tmp_name'] != null) {
            if (!file_exists('../../../view/src/file/informacion_icon')) {
                mkdir("../../../view/src/file/informacion_icon", 0700);
            }
            $desde = $informacion_icon['tmp_name'];
            $hasta = "../../../view/src/file/informacion_icon/" . $informacion_id . ".png";
            copy($desde, $hasta);
            $informacionDao->updateInformacion_icon($informacion_id . ".png", $informacion_id);
        }
    }
    echo json_encode(true);
} else {
    echo json_encode(false);
}
