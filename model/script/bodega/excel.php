<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Estanterias - ' . $fecha;
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
    $bodega_rs = $bodegaDao->select();
    echo "NOMBRE".$separator;
    echo "DESCRIPCION\n";
    while ($r = mysqli_fetch_assoc($bodega_rs)) {
        echo $r['bodega_nombre'] . $separator;
        echo $r['bodega_descripcion'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
