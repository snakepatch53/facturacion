<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    $producto_rs = $productoDao->select();
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Productos - ' . $fecha;
    $html = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>' . $tittle . '</title>
            </head>
            <body>
                <style>
                    h3 {
                        text-align: center;
                        font-family: sans-serif;
                    }
                    table {
                        width: 100%;
                        text-align: left;
                        border-collapse: collapse;
                        font-family: sans-serif;
                    }
                    table th {
                        padding: 10px;
                        background: rgba(0, 0, 0, 0.1);
                    }
                    img {
                        width: 40px;
                    }
                </style>
                    <h3>'. $tittle .'</h3>
                    <table border="1">
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Barra</th>
                            <th>Bodega</th>
                        </tr>
    ';
    while ($r = mysqli_fetch_assoc($producto_rs)) {
        $barcodeText = $r['producto_codigo'];
        $barcodeType = 'code128';
        $barcodeDisplay = 'horizontal';
        $barcodeSize = '40';
        $printText = 'true';
        $src_foto = "view/src/img/product.png";
        if ($r['producto_foto'] != null) {
            $src_foto = "view/src/file/producto_foto/" . $r['producto_foto'];
        }
        $html .= '
            <tr>
                <td style="text-align:center;"><img src="' . $src_foto . '" /></td>
                <td style="text-align:center;">' . $r['producto_nombre'] . '</td>
                <td style="text-align:center;">' . $r['producto_codigo'] . '</td>
                <td style="text-align:center; padding:5px 0 0 0;"><img style="width: 200px; height: 45px;" src="model/library/barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'" /></td>
                <td style="text-align:center;">' . $r['bodega_nombre'] . '</td>
            </tr>
        ';
    }
    $html .= '
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
