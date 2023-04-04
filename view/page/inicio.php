<?php
if (empty($proyect)) {
    header("location:/");
}
// $usuario_count = mysqli_num_rows($usuarioDao->select());
// $bodega_count = mysqli_num_rows($bodegaDao->select());
// $proveedor_count = mysqli_num_rows($proveedorDao->select());
// $cliente_count = mysqli_num_rows($clienteDao->select());
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Usuarios</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>inicio.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>
            <div class="content_graphic">
                <div id="graphic_compra" class="graphic"></div>
                <div id="graphic_venta" class="graphic"></div>
                <div id="graphic_producto" class="graphic"></div>
            </div>
        </page>

    </content>

</body>
<foot>
    <?php include($proyect['root_component'] . 'foot.php') ?>
    <script src="<?= $proyect['root_js_library'] ?>plotly.min.js"></script>
    <script src="<?= $proyect['root_js'] ?>inicio.js"></script>
</foot>

</html>