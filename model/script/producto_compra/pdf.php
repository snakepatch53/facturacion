<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    include('model/library/numero.php');
    include('model/library/producto_compra.php');
    $producto_rs = $productoDao->select();
    $producto_compra_rs = getProductoCompra_array($producto_compraDao, $producto_entradaDao);

    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Compras - ' . $fecha;
    $html = '
        <html>
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
                    <h3>' . $tittle . '</h3>
                    <table border="1">
                        <tr>
                            <th>Fecha</th>
                            <th>Vendedor</th>
                            <th>Proveedor</th>
                            <th>Total</th>
                        </tr>
    ';
    foreach ($producto_compra_rs as $index => $producto_compra_r) {
        $html .= '
            <tr>
                <td>' . $producto_compra_r['producto_compra_fecha'] . '</td>
                <td>' . $producto_compra_r['usuario_nombre'] . '</td>
                <td>' . $producto_compra_r['proveedor_nombre'] . '</td>
                <td>$' . $producto_compra_r['producto_compra_total'] . '</td>
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
