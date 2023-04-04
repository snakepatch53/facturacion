<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    $cliente_rs = $clienteDao->select();
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Clientes - ' . $fecha;
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
                            <th>Cédula</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Contacto</th>
                        </tr>
    ';
    while ($r = mysqli_fetch_assoc($cliente_rs)) {
        $html .= '
            <tr>
                <td>' . $r['cliente_nombre1'] . ' ' . $r['cliente_apellido1'] . '</td>
                <td>' . $r['cliente_cedula']  . '</td>
                <td>' . $r['cliente_ciudad'] . '</td>
                <td>' . $r['cliente_direccion'] . '</td>
                <td>' . $r['cliente_celular'] . (($r['cliente_telefono']) != "" ? " / " . $r['cliente_telefono'] : "") . '</td>
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
