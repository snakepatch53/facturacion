<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    include('model/library/numero.php');
    include('model/library/producto_compra.php');
    $producto_rs = $productoDao->select();
    $producto_compra_rs = getProductoCompra_array($producto_compraDao, $producto_entradaDao);

    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Compras - ' . $fecha;
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
    echo "PROVEEDOR".$separator;
    echo "TOTAL\n";
    foreach ($producto_compra_rs as $index => $producto_compra_r) {
        echo $producto_compra_r['producto_compra_fecha'] . $separator;
        echo $producto_compra_r['usuario_nombre'] . $separator;
        echo $producto_compra_r['proveedor_nombre'] . $separator;
        echo $producto_compra_r['producto_compra_total'] . "\n";
    }
} else {
    header("location: ../../../login.php");
}
