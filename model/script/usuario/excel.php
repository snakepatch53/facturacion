<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Usuarios - ' . $fecha;
    $separator = "";
    if ($type == "csv") {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=" . $tittle . ".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $separator = ",";
    } else {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $tittle . ".xls");
        $separator = "\t";
    }
    $usuario_rs = $usuarioDao->select();
    echo "NOMBRE".$separator;
    echo "USUARIO\t".$separator;
    echo "PRIVILEGIO\n";
    while ($r = mysqli_fetch_assoc($usuario_rs)) {
        echo $r['usuario_nombre'] . $separator;
        echo $r['usuario_user'] . $separator;
        echo $r['privilegio_nombre'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
