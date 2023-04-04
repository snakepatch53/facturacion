<?php
// ob_start();
// $proyect = json_decode(file_get_contents('http://facturacion.moronanet.com/config.json'), true);
// $proyect = json_decode(file_get_contents('https://facturacion.moronanet.com/config.json'), true);

$proyect = array(
    "name" => "",
    "root_page" => "./view/page/",
    "root_component" => "./view/component/",
    "root_js_library" => "./control/library/",
    "root_css" => "./view/css/",
    "root_js" => "./control/script/",
    "root_src" => "./view/src/",
    "root_file" => "./view/src/file/",
    "root_absolute" => "https://facturacion.moronanet.com"
);
if ($_SERVER['HTTPS'] != "on") {
    header("location: " . $proyect['root_absolute']);
}

include 'model/library/Router/Route.php';
include 'model/library/Router/Router.php';
include 'model/library/Router/RouteNotFoundException.php';
$router = new Router\Router($proyect['name']);

// INICIO
$router->add('/(|inicio|index|panel|index.php)', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'inicio';
    include($proyect['root_page'] . 'inicio.php');
}, ['GET']);

// PANEL INFORMACION
$router->add('/informacion', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'informacion';
    permission($currentPage);
    include($proyect['root_page'] . 'informacion.php');
}, ['GET']);

// PANEL PRIVILEGIO
$router->add('/privilegio', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'privilegio';
    permission($currentPage);
    include($proyect['root_page'] . 'privilegio.php');
}, ['GET']);
$router->add('/privilegio/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'privilegio';
    permission($currentPage);
    include('model/script/privilegio/pdf.php');
}, ['GET']);
$router->add('/privilegio/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'privilegio';
    permission($currentPage);
    $type = "normal";
    include('model/script/privilegio/excel.php');
}, ['GET']);
$router->add('/privilegio/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'privilegio';
    permission($currentPage);
    $type = "csv";
    include('model/script/privilegio/excel.php');
}, ['GET']);

// PANEL USUARIO
$router->add('/usuario', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'usuario';
    permission($currentPage);
    include($proyect['root_page'] . 'usuario.php');
}, ['GET']);
$router->add('/usuario/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'usuario';
    permission($currentPage);
    include('model/script/usuario/pdf.php');
}, ['GET']);
$router->add('/usuario/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'usuario';
    permission($currentPage);
    $type = "normal";
    include('model/script/usuario/excel.php');
}, ['GET']);
$router->add('/usuario/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'usuario';
    permission($currentPage);
    $type = "csv";
    include('model/script/usuario/excel.php');
}, ['GET']);

// PANEL CLIENTE
$router->add('/cliente', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'cliente';
    permission($currentPage);
    include($proyect['root_page'] . 'cliente.php');
}, ['GET']);
$router->add('/cliente/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'cliente';
    permission($currentPage);
    include('model/script/cliente/pdf.php');
}, ['GET']);
$router->add('/cliente/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'cliente';
    permission($currentPage);
    $type = "normal";
    include('model/script/cliente/excel.php');
}, ['GET']);
$router->add('/cliente/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'cliente';
    permission($currentPage);
    $type = "csv";
    include('model/script/cliente/excel.php');
}, ['GET']);

// PANEL PROVEEDOR
$router->add('/proveedor', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'proveedor';
    permission($currentPage);
    include($proyect['root_page'] . 'proveedor.php');
}, ['GET']);
$router->add('/proveedor/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'proveedor';
    permission($currentPage);
    include('model/script/proveedor/pdf.php');
}, ['GET']);
$router->add('/proveedor/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'proveedor';
    permission($currentPage);
    $type = "normal";
    include('model/script/proveedor/excel.php');
}, ['GET']);
$router->add('/proveedor/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'proveedor';
    permission($currentPage);
    $type = "csv";
    include('model/script/proveedor/excel.php');
}, ['GET']);

// PANEL BODEGA
$router->add('/estanteria', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'bodega';
    permission($currentPage);
    include($proyect['root_page'] . 'bodega.php');
}, ['GET']);
$router->add('/estanteria/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'bodega';
    permission($currentPage);
    include('model/script/bodega/pdf.php');
}, ['GET']);
$router->add('/estanteria/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'bodega';
    permission($currentPage);
    $type = "normal";
    include('model/script/bodega/excel.php');
}, ['GET']);
$router->add('/estanteria/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'bodega';
    permission($currentPage);
    $type = "csv";
    include('model/script/bodega/excel.php');
}, ['GET']);

// PANEL PRODUCTO
$router->add('/producto', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'producto';
    permission($currentPage);
    include($proyect['root_page'] . 'producto.php');
}, ['GET']);
$router->add('/producto/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'producto';
    permission($currentPage);
    include('model/script/producto/pdf.php');
}, ['GET']);
$router->add('/producto/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'producto';
    permission($currentPage);
    $type = "normal";
    include('model/script/producto/excel.php');
}, ['GET']);
$router->add('/producto/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'producto';
    permission($currentPage);
    $type = "csv";
    include('model/script/producto/excel.php');
}, ['GET']);

// PANEL COMPRAS
$router->add('/compras', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'compra';
    permission($currentPage);
    permission($currentPage);
    include($proyect['root_page'] . 'compras.php');
}, ['GET']);
$router->add('/compras/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'compra';
    permission($currentPage);
    include('model/script/producto_compra/pdf.php');
}, ['GET']);
$router->add('/compras/pdf/([0-9]+)', function ($producto_compra_id) {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'compra';
    permission($currentPage);
    include('model/script/producto_compra/factura_pdf.php');
}, ['GET']);
$router->add('/compras/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'compra';
    permission($currentPage);
    $type = "normal";
    include('model/script/producto_compra/excel.php');
}, ['GET']);
$router->add('/compras/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'compra';
    permission($currentPage);
    $type = "csv";
    include('model/script/producto_compra/excel.php');
}, ['GET']);

// PANEL VENTAS
$router->add('/ventas', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'venta';
    permission($currentPage);
    permission($currentPage);
    include($proyect['root_page'] . 'ventas.php');
}, ['GET']);
$router->add('/ventas/pdf', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'venta';
    permission($currentPage);
    include('model/script/producto_venta/pdf.php');
}, ['GET']);
$router->add('/ventas/pdf/([0-9]+)', function ($producto_venta_id) {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'venta';
    permission($currentPage);
    include('model/script/producto_venta/factura_pdf.php');
}, ['GET']);
$router->add('/ventas/excel', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'venta';
    permission($currentPage);
    $type = "normal";
    include('model/script/producto_venta/excel.php');
}, ['GET']);
$router->add('/ventas/csv', function () {
    global $proyect;
    include('./model/library/include.php');
    $currentPage = 'venta';
    permission($currentPage);
    $type = "csv";
    include('model/script/producto_venta/excel.php');
}, ['GET']);

// LOGIN
$router->add('/login', function () {
    global $proyect;
    session_start();
    if (isset($_SESSION['usuario_id'])) {
        header('location: ./inicio');
    }
    include($proyect['root_page'] . 'login.php');
}, ['GET']);

// ERROR 404
$router->add('/.*', function () {
    global $proyect;
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    echo '<h1>404 - El sitio solicitado no existe</h1>';
});

// EJECUTAR RUTAS
$router->route();
