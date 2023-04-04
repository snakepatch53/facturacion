<?php
session_start();

include('model/dao/Mysql.php');
include('model/vendor/autoload.php');
include('model/dao/InformacionDao.php');
include('model/dao/PrivilegioDao.php');
include('model/dao/UsuarioDao.php');
include('model/dao/BodegaDao.php');
include('model/dao/ProveedorDao.php');
include('model/dao/ClienteDao.php');
include('model/dao/ProductoDao.php');
include('model/dao/Producto_entradaDao.php');
include('model/dao/Producto_salidaDao.php');
include('model/dao/Producto_compraDao.php');
include('model/dao/Producto_ventaDao.php');
$informacionDao = new InformacionDao();
$privilegioDao = new PrivilegioDao();
$usuarioDao = new UsuarioDao();
$bodegaDao = new BodegaDao();
$proveedorDao = new ProveedorDao();
$clienteDao = new ClienteDao();
$productoDao = new ProductoDao();
$producto_entradaDao = new Producto_entradaDao();
$producto_salidaDao = new Producto_salidaDao();
$producto_compraDao = new Producto_compraDao();
$producto_ventaDao = new Producto_ventaDao();

$informacion_r = mysqli_fetch_assoc($informacionDao->select());

date_default_timezone_set('America/Guayaquil');
$date = date('Y-m-d');
$dateTime = date('Y-m-d H:i:s');

if (empty($_SESSION['usuario_id'])) {
    header('location: ./login');
}


function permission($page)
{
    if ($_SESSION['privilegio_' . $page] == 0) {
        header('location: ./inicio');
    }
}

function isPageActive($currentPage, $optionTool)
{
    if (strtolower($currentPage) == strtolower($optionTool)) {
        return "active";
    } else {
        return "";
    }
}
