<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    include('model/library/numero.php');
    include('model/library/producto_venta.php');
    $producto_rs = $productoDao->select();
    $producto_venta_rs = getProductoVenta_array($producto_ventaDao, $producto_salidaDao, $clienteDao);

    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Ventas - ' . $fecha;
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
    echo "FECHA".$separator;
    echo "VENDEDOR".$separator;
    echo "CLIENTE".$separator;
    echo "TOTAL\n";
    foreach ($producto_venta_rs as $index => $producto_venta_r) {
        echo $producto_venta_r['producto_venta_fecha'] . $separator;
        echo $producto_venta_r['usuario_nombre'] . $separator;
        echo (($producto_venta_r['cliente_id'] == 0) ? ('Consumidor Final') : ($producto_venta_r['cliente_nombre1'] . ' ' . $producto_venta_r['cliente_apellido1'])) . $separator;
        echo $producto_venta_r['producto_venta_total'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
