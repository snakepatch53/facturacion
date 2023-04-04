<?php
// session_start();
if (isset($_SESSION['usuario_id'])) {
    $usuario_rs = $usuarioDao->select();
    $mpdf = new \Mpdf\Mpdf(['en-GB-x', 'A4', '', '', 0, 0, 0, 0, 0, 0]);
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d');
    $tittle = 'Lista de Usuarios - ' . $fecha;
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
                    <h3>'. $tittle .'</h3>
                    <table border="1">
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Foto</th>
                            <th>Privilegio</th>
                        </tr>
    ';
    while ($r = mysqli_fetch_assoc($usuario_rs)) {
        $src_foto = "view/src/img/user.png";
        if ($r['usuario_foto'] != null) {
            $src_foto = "view/src/file/usuario_foto/" . $r['usuario_foto'];
        }
        $html .= '
            <tr>
                <td>' . $r['usuario_nombre'] . '</td>
                <td>' . $r['usuario_user'] . '</td>
                <td><img src="' . $src_foto . '" /></td>
                <td>' . $r['privilegio_nombre'] . '</td>
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
