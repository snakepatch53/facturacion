<?php
if (empty($proyect)) {
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Ventas</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>ventas.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>table.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>


            <section class="head ideasection open" id="sectionHead">
                <h3>Ventas</h3>
                <hr class="d" />
                <div class="report ideareport">
                    <select id="selectReport">
                        <option value="">Reporte</option>
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>
                <hr class="d" />
                <div class="search ideasearch">
                    <span>Buscar: </span>
                    <div class="content">
                        <img src="view/src/icon/search.png">
                        <input type="search" placeholder="Busca por cualquier campo.." id="inputSearch">
                    </div>
                </div>
                <hr class="d" />
                <button class="ideabutton" id="inputNewButton">
                    <img src="view/src/icon/add.png">
                    <span>Agregar</span>
                </button>
            </section>

            <section class="table ideasection open" id="sectionTable">
                <div class="content_table ideatable">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tableData"></tbody>
                    </table>
                </div>
            </section>

            <form class="ideaform-venta" action="#" method="POST" onsubmit="return false" id="formData">
                <input type="hidden" name="producto_venta_id" value="0">
                <input type="hidden" name="cliente_id" value="">
                <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario_id'] ?>">
                <section class="usuario ideasection open_" id="sectionUser">
                    <div class="head">
                        <h3>Datos del cliente</h3>
                        <div class="search ideasearch">
                            <span>Buscar: </span>
                            <div class="content">
                                <img src="view/src/icon/search.png">
                                <input type="search" placeholder="Busca por cualquier campo.." id="inputSearchCliente" autocomplete="off">
                            </div>
                        </div>
                        <a href="./cliente" target="_blank" class="ideabutton" id="inputNewButton">
                            <img src="view/src/icon/user.png">
                            <span>Clientes</span>
                        </a>
                    </div>
                    <div class="ideaform ideaform-cliente _client-data-open" id="ideaform-cliente">
                        <div class="body client-data-yes">
                            <div class="campo">
                                <span>Cédula:</span>
                                <input class="disabled" type="text" name="cliente_cedula" placeholder="Cedula" disabled>
                            </div>
                            <div class="campo">
                                <span>Nombre:</span>
                                <input class="disabled" type="text" name="cliente_nombre" placeholder="Nombre" disabled>
                            </div>
                            <div class="campo">
                                <span>Contacto:</span>
                                <input class="disabled" type="text" name="cliente_contacto" placeholder="Contacto" disabled>
                            </div>
                            <div class="campo">
                                <span>Dirección:</span>
                                <input class="disabled" type="text" name="cliente_direccion" placeholder="Dirección" disabled>
                            </div>
                        </div>
                        <div class="body client-data-no">
                            <div class="campo">
                                <input class="disabled" type="text" placeholder="Consumidor Final" disabled>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="ideasection open_" id="sectionForm">
                    <div class="ideaform">
                        <div class="head">
                            <h3>Datos de venta</h3>
                        </div>
                        <div class="body">
                            <input type="hidden" name="producto_venta_iva" value="<?= $informacion_r['informacion_iva'] ?>">
                            <div class="campo">
                                <span>Fecha<b>*</b>:</span>
                                <input type="date" name="producto_venta_fecha" placeholder="Fecha" value="<?= $date ?>">
                            </div>
                            <div class="campo">
                                <span>Vendedor:</span>
                                <input class="disabled" type="text" name="usuario_nombre" placeholder="Usuario" value="<?= $_SESSION['usuario_nombre'] ?>" disabled>
                            </div>
                        </div>
                        <div class="productos">
                            <div class="head">
                                <h3>Producto</h3>
                                <div class="search ideasearch">
                                    <span>Buscar: </span>
                                    <div class="content">
                                        <img src="view/src/icon/search.png">
                                        <input type="search" placeholder="Busca por Código o Nombre del producto.." id="inputSearchProducto" autocomplete="off">
                                    </div>
                                    <div class="search-results open_" id="searchProductoResults">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Existencia</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataTableProducto"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <a href="./producto" target="_blank" class="ideabutton" id="inputNewButton">
                                    <img src="view/src/icon/product.png">
                                    <span>Productos</span>
                                </a>
                            </div>
                            <div class="form-producto">
                                <input type="hidden" name="producto_id" value="">
                                <input class="disabled input" name="producto_codigo" type="text" placeholder="Codigo" disabled>
                                <input class="disabled input" name="producto_nombre" type="text" placeholder="Nombre" disabled>
                                <input class="disabled input" name="producto_precio" type="text" placeholder="Unidad $" disabled>
                                <input class="disabled input" name="producto_precioT" type="text" placeholder="Total $" disabled>
                                <input class="input" name="producto_cantidad" type="number" placeholder="Cantidad" onkeydown="(() => { if(event.key==='.'){event.preventDefault();} })()">
                                <button class="save ideabutton" id="formButtonAddProductoFactura">
                                    <img src="view/src/icon/add.png">
                                    <span>Agregar</span>
                                </button>
                            </div>
                            <div class="msg" id="productoMsg"></div>
                        </div>
                        <div class="table ideasection factura open">
                            <table class="content_table ideatable" border="1">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTableFactura"></tbody>
                                <thead>
                                    <tr>
                                        <th colspan="5" class="th-foot-left">Subtotal: </th>
                                        <th colspan="2" class="th-foot-right" id="resultFacturaSubtotal">$30</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="th-foot-left">IVA (12%): </th>
                                        <th colspan="2" class="th-foot-right" id="resultFacturaIVA">$2.13</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="th-foot-left">Total: </th>
                                        <th colspan="2" class="th-foot-right" id="resultFacturaTotal">$30002.13</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="foot">
                            <div class="msg" id="ventaMsg"></div>
                            <div class="buttons">
                                <button class="save ideabutton" id="formButtonSave">
                                    <img src="view/src/icon/dollar.png">
                                    <span>Realizar Venta</span>
                                </button>
                                <button class="cancel ideabutton" id="formButtonCancel">
                                    <img src="view/src/icon/cancel.png">
                                    <span>Cancelar Venta</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

            <section class="ideamodal" id="sectionModal">
                <div class="ideaconfirm">
                    <div class="head">
                        <p class="msg">¿Esta seguro de realizar esta acción?</p>
                        <button id="modalClose"><img src="view/src/icon/close.png"></button>
                    </div>
                    <div class="foot">
                        <button class="cancel ideabutton" id="modalNo">
                            <img src="view/src/icon/cancel.png">
                            <span>NO</span>
                        </button>
                        <button class="delete ideabutton" id="modalYes" style="background: #00A65A;">
                            <img src="view/src/icon/ok.png">
                            <span>SI</span>
                        </button>
                    </div>
                </div>
            </section>

            <section class="ideamodal _open" id="sectionProgress">
                <div class="modal-progress">
                    <span id="sectionProgressText">Procesando..</span>
                    <div class="progress_bar"></div>
                </div>
            </section>

        </page>

    </content>

</body>

<foot>
    <?php include($proyect['root_component'] . 'foot.php') ?>
    <script src="<?= $proyect['root_js'] ?>ventas.js"></script>
</foot>

</html>