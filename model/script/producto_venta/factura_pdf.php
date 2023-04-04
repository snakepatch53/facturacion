<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    date_default_timezone_set('America/Guayaquil');
    $date = date('Y-m-d');
    $dateTime = date('Y-m-d H:i:s');
    include('model/library/numero.php');
    include('model/library/producto_venta.php');
    $producto_rs = $productoDao->select();
    $producto_venta_rs = getProductoVenta_array($producto_ventaDao, $producto_salidaDao, $clienteDao);
    $producto_venta = null;
    foreach ($producto_venta_rs as $index => $producto_venta_r) {
        if ($producto_venta_id == $producto_venta_r['producto_venta_id']) {
            $producto_venta = $producto_venta_r;
        }
    }

    $cabecera_html = '<h3 style="font-family: sans-serif; width: 100%; text-align: center;">CONSUMIDOR FINAL</h3>';
    if ($producto_venta['cliente_id'] != 0) {
        $cabecera_html = '
            <br><br>
            <table style="width: 100%; font-family: sans-serif;" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2"><h3>CLIENTE</h3><br><br></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;" >
                        <b>Nombres: </b>
                        <span>' . $producto_venta['cliente_nombre1'] . ' ' . $producto_venta['cliente_nombre2'] . '</span>
                        <br>
                        <b>Apellidos: </b>
                        <span>' . $producto_venta['cliente_apellido1'] . ' ' . $producto_venta['cliente_apellido2'] . '</span>
                        <br>
                        <b>Dirección: </b>
                        <span>' . $producto_venta['cliente_direccion'] . '</span>
                    </td>
                    <td style="vertical-align:top;" >
                        <b>Cédula: </b>
                        <span>' . $producto_venta['cliente_cedula'] . '</span>
                        
                        ' . (($producto_venta['cliente_ruc'] == "" or $producto_venta['cliente_ruc'] == null) ? ("") : ('
                            <br>
                            <b>Ruc: </b>
                            <span>' . $producto_venta['cliente_ruc'] . '</span>')) . '
                        <br>
                        <b>Celular: </b>
                        <span>' . $producto_venta['cliente_celular'] . '</span>
                        ' . (($producto_venta['cliente_telefono'] == "" or $producto_venta['cliente_telefono'] == null) ? ("") : ('
                            <br>
                            <b>Teléfono: </b>
                            <span>' . $producto_venta['cliente_telefono'] . '</span>')) . '
                    </td>
                </tr>
            </table>
            <br><br>
        ';
    }

    $src_logo = "view/src/img/logo.png";
    if ($informacion_r['informacion_logo'] != null) {
        $src_logo = "view/src/file/informacion_logo/" . $informacion_r['informacion_logo'] . "?date=" . $dateTime;
    }
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    $tittle = 'Factura de venta #' . $producto_venta_id;
    $html = '
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <title>' . $tittle . '</title>  
        </head>
        <body>
        <table style="
            width: 100%;
            border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
            padding: 0 0 10px 0;
        ">
            <tr>
                <td style="
                    width: 100px;
                    text-align: center;
                ">
                    <img src="' . $src_logo . '" style="
                        width: 50px;
                        height: 50px;
                        object-fit: contain;
                    " />
                </td>
                <td>
                    <span style="
                        font-family: sans-serif;
                        font-size: 20px;
                        font-weight: bold;
                    ">' . strtoupper($informacion_r['informacion_nombre']) . '</span>
                    <br>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $informacion_r['informacion_ciudad'] . ' - ' . $informacion_r['informacion_direccion'] . '</span>
                </td>
                <td style="
                    width: 250px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Cel: </span>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $informacion_r['informacion_celular'] . '</span>
                    <br>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Tel: </span>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $informacion_r['informacion_telefono'] . '</span>
                    <br>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Email: </span>
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . strtolower($informacion_r['informacion_email']) . '</span>
                </td>
            </tr>
        </table>
        <br>

        <span style="
            font-size: 20px;
            font-family: sans-serif;
            font-weight: bold;
            color: ' . $informacion_r['informacion_primary_background'] . ';
        ">
            ' . strtoupper($tittle) . '
        </span>
        ' . $cabecera_html . '
        <table style="
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        ">
            <tr>
                <td style="
                    border-left: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Foto</span>
                </td>
                <td style="
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Código</span>
                </td>
                <td style="
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Nombre</span>
                </td>
                <td style="
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Cantidad</span>
                </td>
                <td style="
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Precio</span>
                </td>
                <td style="
                    border-top: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    border-right: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                    color: ' . $informacion_r['informacion_primary_background'] . ';
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                    ">Total</span>
                </td>
            </tr>
            ';
    $subtotal = 0;
    $IVA = $informacion_r['informacion_iva'];
    $producto_salida_array = $producto_venta['producto_salida_array'];
    foreach ($producto_salida_array as $index => $producto_r) {
        $producto = getProducto($producto_rs, $producto_r['producto_id']);
        $src_producto_foto = "view/src/img/product.png";
        if ($producto['producto_foto'] != "" and $producto['producto_foto'] != null) {
            $src_producto_foto = "view/src/file/producto_foto/" . $producto['producto_foto'];
        }
        $precio_row = $producto_r['producto_salida_precio'];
        $cantidad_row = $producto_r['producto_salida_cantidad'];
        $total_row = (($producto_r['producto_salida_precio']) * $producto_r['producto_salida_cantidad']);
        $subtotal += $total_row;
        $html .= '
            <tr style="
                border-bottom: solid 1px #000;
            ">
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    "><img src="' . $src_producto_foto . '"  style="height: 40px; object-fit: contain;" ></span>
                </td>
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $producto['producto_codigo'] . '</span>
                </td>
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $producto['producto_nombre'] . '</span>
                </td>
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">' . $cantidad_row . '</span>
                </td>
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">$' . $precio_row . '</span>
                </td>
                <td style="
                    border-bottom: 1px solid ' . $informacion_r['informacion_primary_background'] . ';
                    padding: 15px;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">$' . $total_row . '</span>
                </td>
            </tr>
            ';
    }


    $html .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="
                    text-align: right;
                    padding: 10px 5px 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                        color: ' . $informacion_r['informacion_primary_background'] . ';
                    ">Subtotal: </span>
                </td>
                <td style="
                    padding: 10px 0 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">$' . $subtotal . '</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="
                    text-align: right;
                    padding: 10px 5px 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                        color: ' . $informacion_r['informacion_primary_background'] . ';
                    ">IVA (' . $IVA . '%): </span>
                </td>
                <td style="
                    padding: 10px 0 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">$' . (($subtotal / 100) * $IVA) . '</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="
                    text-align: right;
                    padding: 10px 5px 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                        font-weight: bold;
                        color: ' . $informacion_r['informacion_primary_background'] . ';
                    ">Total: </span>
                </td>
                <td style="
                    padding: 10px 0 0 0;
                ">
                    <span style="
                        font-family: sans-serif;
                        font-size: 15px;
                    ">$' . ((($subtotal / 100) * $IVA) + $subtotal) . '</span>
                </td>
            </tr>
        </table>
        </body>
        </html>
        ';
    // $html = utf8_encode($html);
    $html =  mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    //   $mpdf->AddPage('L'); // Con esta propiedad puedo voltear la pagina
    $mpdf->WriteHTML($html);
    $mpdf->Output($tittle . '.pdf', 'I');
} else {
    header("location: ../../../login.php");
}
