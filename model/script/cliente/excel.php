<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Clientes - ' . $fecha;
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
    $cliente_rs = $clienteDao->select();
    echo "NOMBRE" . $separator;
    echo "CEDULA" . $separator;
    echo "CIUDAD" . $separator;
    echo "DIRECCION" . $separator;
    echo "CONTACTO\n";
    while ($r = mysqli_fetch_assoc($cliente_rs)) {
        echo $r['cliente_nombre1'] . " " . $r['cliente_apellido1'] . $separator;
        echo $r['cliente_cedula'] . $separator;
        echo $r['cliente_ciudad'] . $separator;
        echo $r['cliente_direccion'] . $separator;
        echo $r['cliente_celular'] . (($r['cliente_telefono']) != "" ? " / " . $r['cliente_telefono'] : "") . "\n";
    }
} else {
    header("location: ../../../login.php");
}
