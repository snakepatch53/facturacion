<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Proveedores - ' . $fecha;
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
    $proveedor_rs = $proveedorDao->select();
    echo "NOMBRE" . $separator;
    echo "CIUDAD" . $separator;
    echo "DIRECCION" . $separator;
    echo "CONTACTO" . $separator;
    echo "RUC\n";
    while ($r = mysqli_fetch_assoc($proveedor_rs)) {
        echo $r['proveedor_nombre'] . $separator;
        echo $r['proveedor_ciudad'] . $separator;
        echo $r['proveedor_direccion'] . $separator;
        echo $r['proveedor_telefono'] . (($r['proveedor_celular']) != "" ? " / " . $r['proveedor_celular'] : "") . $separator;
        echo $r['proveedor_ruc'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
