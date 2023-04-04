<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    $privilegio_rs = $privilegioDao->select();
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Privilegios - ' . $fecha;
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
                            <th>Nombre</th>
                            <th>Información</th>
                            <th>Privilegios</th>
                            <th>Usuarios</th>
                            <th>Bodegas</th>
                            <th>Proveedores</th>
                            <th>Clientes</th>
                            <th>Productos</th>
                            <th>Compras</th>
                            <th>Ventas</th>
                        </tr>
    ';
    while ($privilegio_r = mysqli_fetch_assoc($privilegio_rs)) {
        $html .= '
            <tr>
                <td>' . $privilegio_r['privilegio_nombre'] . '</td>
                <td>' . (($privilegio_r['privilegio_informacion'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_privilegio'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_usuario'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_bodega'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_proveedor'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_cliente'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_producto'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_compra'] == 0) ? ('NO') : ('SI')) . '</td>
                <td>' . (($privilegio_r['privilegio_venta'] == 0) ? ('NO') : ('SI')) . '</td>
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
