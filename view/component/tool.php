<?php if ($_SESSION['usuario_foto'] == null) { ?>
    <img src="<?= $proyect['root_src'] ?>img/user.png" alt="user photo" class="user_img">
<?php } else { ?>
    <img src="<?= $proyect['root_src'] ?>file/usuario_foto/<?= $_SESSION['usuario_foto'] ?>?date=<?= $dateTime ?>" alt="user photo" class="user_img">
<?php } ?>
<span class="user_name"><?= $_SESSION['usuario_nombre'] ?></span>

<a class="option <?= isPageActive($currentPage, 'inicio') ?>" href="./inicio">
    <img src="<?= $proyect['root_src'] ?>icon/home.png" alt="icon home">
    <span>Inicio</span>
</a>
<?php if ($_SESSION['privilegio_informacion'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'informacion') ?>" href="./informacion">
        <img src="<?= $proyect['root_src'] ?>icon/info.png" alt="icon">
        <span>Información</span>
    </a>
<?php }
if ($_SESSION['privilegio_privilegio'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'privilegio') ?>" href="./privilegio">
        <img src="<?= $proyect['root_src'] ?>icon/lock.png" alt="icon">
        <span>Privilegios</span>
    </a>
<?php }
if ($_SESSION['privilegio_usuario'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'usuario') ?>" href="./usuario">
        <img src="<?= $proyect['root_src'] ?>icon/user.png" alt="icon">
        <span>Usuarios</span>
    </a>
<?php }
if ($_SESSION['privilegio_cliente'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'cliente') ?>" href="./cliente">
        <img src="<?= $proyect['root_src'] ?>icon/users.png" alt="icon">
        <span>Clientes</span>
    </a>
<?php }
if ($_SESSION['privilegio_proveedor'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'proveedor') ?>" href="./proveedor">
        <img src="<?= $proyect['root_src'] ?>icon/truck.png" alt="icon">
        <span>Proveedores</span>
    </a>
<?php }
if ($_SESSION['privilegio_bodega'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'bodega') ?>" href="./estanteria">
        <img src="<?= $proyect['root_src'] ?>icon/block.png" alt="icon">
        <span>Estanterías</span>
    </a>
<?php }
if ($_SESSION['privilegio_producto'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'producto') ?>" href="./producto">
        <img src="<?= $proyect['root_src'] ?>icon/product.png" alt="icon">
        <span>Productos</span>
    </a>
<?php }
if ($_SESSION['privilegio_compra'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'compra') ?>" href="./compras">
        <img src="<?= $proyect['root_src'] ?>icon/git2.png" alt="icon">
        <span>Compras</span>
    </a>
<?php }
if ($_SESSION['privilegio_venta'] == 1) { ?>
    <hr>
    <a class="option <?= isPageActive($currentPage, 'venta') ?>" href="./ventas">
        <img src="<?= $proyect['root_src'] ?>icon/git.png" alt="icon">
        <span>Ventas</span>
    </a>
<?php } ?>