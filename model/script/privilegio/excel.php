<?php
// session_start();
if (isset($_SESSION['usuario_id']) and isset($type)) {
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Privilegios - ' . $fecha;
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
    $privilegio_rs = $privilegioDao->select();
    echo "NOMBRE" . $separator;
    echo "INFORMACION" . $separator;
    echo "PRIVILEGIOS" . $separator;
    echo "USUARIOS" . $separator;
    echo "BODEGAS" . $separator;
    echo "PROVEEDORES" . $separator;
    echo "CLIENTES" . $separator;
    echo "PRODUCTOS" . $separator;
    echo "COMPRAS" . $separator;
    echo "VENTAS\n";
    while ($privilegio_r = mysqli_fetch_assoc($privilegio_rs)) {
        echo $privilegio_r['privilegio_nombre'] . $separator;
        echo (($privilegio_r['privilegio_informacion'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_privilegio'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_usuario'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_bodega'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_proveedor'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_cliente'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_producto'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_compra'] == 0) ? ('NO') : ('SI')) . $separator;
        echo (($privilegio_r['privilegio_venta'] == 0) ? ('NO') : ('SI')) . "\n";
    }
} else {
    header("location: ../../../login.php");
}
