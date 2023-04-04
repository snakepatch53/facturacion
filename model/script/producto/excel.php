<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Productos - ' . $fecha;
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
    $producto_rs = $productoDao->select();
    echo "NOMBRE".$separator;
    echo "CODIGO".$separator;
    echo "PROVEEDOR".$separator;
    echo "BODEGA\n";
    while ($r = mysqli_fetch_assoc($producto_rs)) {
        echo $r['producto_nombre'] . $separator;
        echo $r['producto_codigo'] . $separator;
        echo $r['proveedor_nombre'] . $separator;
        echo $r['bodega_nombre'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
