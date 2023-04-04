<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    date_default_timezone_set('America/Guayaquil');
    $date = date('Y-m-d');
    $dateTime = date('Y-m-d H:i:s');
    include('model/library/numero.php');
    include('model/library/producto_compra.php');
    $producto_rs = $productoDao->select();
    $producto_compra_rs = getProductoCompra_array($producto_compraDao, $producto_entradaDao);
    $producto_compra = null;
    foreach ($producto_compra_rs as $index => $producto_compra_r) {
        if ($producto_compra_id == $producto_compra_r['producto_compra_id']) {
            $producto_compra = $producto_compra_r;
        }
    }

    $src_logo = "view/src/img/logo.png";
    if ($informacion_r['informacion_logo'] != null) {
        $src_logo = "view/src/file/informacion_logo/" . $informacion_r['informacion_logo'] . "?date=" . $dateTime;
    }
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    $tittle = 'Factura de compra #' . $producto_compra_id;
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
        
        <br><br>
        <table style="width: 100%; font-family: sans-serif;" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2"><h3>PROVEEDOR</h3><br><br></td>
            </tr>
            <tr>
                <td style="vertical-align:top;" >
                    <b>Nombre: </b>
                    <span>' . $producto_compra['proveedor_nombre'] . '</span>
                    <br>
                    <b>Dirección: </b>
                    <span>' . $producto_compra['proveedor_direccion'] . '</span>
                </td>
                <td style="vertical-align:top;" >
                    <b>Ruc: </b>
                    <span>' . $producto_compra['proveedor_ruc'] . '</span>
                    <br>
                    <b>Contacto: </b>
                    <span>' . $producto_compra['proveedor_telefono'] . (($producto_compra['proveedor_celular'] != "" and $producto_compra['proveedor_celular'] != null) ? (" / " . $producto_compra['proveedor_celular'] != "") : ('')) . '</span>
                </td>
            </tr>
        </table>
        <br><br>

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
    $producto_entrada_array = $producto_compra['producto_entrada_array'];
    foreach ($producto_entrada_array as $index => $producto) {
        $src_producto_foto = "view/src/img/product.png";
        if ($producto['producto_foto'] != "" and $producto['producto_foto'] != null) {
            $src_producto_foto = "view/src/file/producto_foto/" . $producto['producto_foto'];
        }
        $precio_row = $producto['producto_entrada_precio'];
        $cantidad_row = $producto['producto_entrada_cantidad'];
        $total_row = (($producto['producto_entrada_precio']) * $producto['producto_entrada_cantidad']);
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
