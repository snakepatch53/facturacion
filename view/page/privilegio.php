<?php
if (empty($proyect)) {
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Privilegios</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>privilegio.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>table.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>


            <section class="head ideasection open" id="sectionHead">
                <h3>Privilegios</h3>
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
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tableData"></tbody>
                    </table>
                </div>
            </section>

            <section class="ideasection" id="sectionForm">
                <form class="ideaform" action="#" method="POST" onsubmit="return false" id="formData">
                    <div class="head">
                        <h3>Privilegios de: </h3>
                        <input type="hidden" name="privilegio_id" value="0">
                        <input type="text" name="privilegio_nombre_view" value="" disabled>
                    </div>
                    <div class="body">
                        <div class="campo">
                            <span>Nombre<b>*</b>:</span>
                            <input type="text" name="privilegio_nombre" placeholder="Nombre">
                        </div>
                        
                        <div class="campo">
                            <span>Administración de Información<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_informacion_si">
                                    <input type="radio" name="privilegio_informacion" id="radio_privilegio_informacion_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_informacion_no">
                                    <input type="radio" name="privilegio_informacion" id="radio_privilegio_informacion_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Privilegios<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_privilegio_si">
                                    <input type="radio" name="privilegio_privilegio" id="radio_privilegio_privilegio_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_privilegio_no">
                                    <input type="radio" name="privilegio_privilegio" id="radio_privilegio_privilegio_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Usuarios<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_usuario_si">
                                    <input type="radio" name="privilegio_usuario" id="radio_privilegio_usuario_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_usuario_no">
                                    <input type="radio" name="privilegio_usuario" id="radio_privilegio_usuario_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Estanterias<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_bodega_si">
                                    <input type="radio" name="privilegio_bodega" id="radio_privilegio_bodega_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_bodega_no">
                                    <input type="radio" name="privilegio_bodega" id="radio_privilegio_bodega_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Proveedores<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_proveedor_si">
                                    <input type="radio" name="privilegio_proveedor" id="radio_privilegio_proveedor_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_proveedor_no">
                                    <input type="radio" name="privilegio_proveedor" id="radio_privilegio_proveedor_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Clientes<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_cliente_si">
                                    <input type="radio" name="privilegio_cliente" id="radio_privilegio_cliente_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_cliente_no">
                                    <input type="radio" name="privilegio_cliente" id="radio_privilegio_cliente_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Productos<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_producto_si">
                                    <input type="radio" name="privilegio_producto" id="radio_privilegio_producto_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_producto_no">
                                    <input type="radio" name="privilegio_producto" id="radio_privilegio_producto_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Compras<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_compra_si">
                                    <input type="radio" name="privilegio_compra" id="radio_privilegio_compra_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_compra_no">
                                    <input type="radio" name="privilegio_compra" id="radio_privilegio_compra_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="campo">
                            <span>Administración de Ventas<b>*</b>:</span>
                            <div class="radios">
                                <label for="radio_privilegio_venta_si">
                                    <input type="radio" name="privilegio_venta" id="radio_privilegio_venta_si" value="1">
                                    <span>Si</span>
                                </label>
                                <label for="radio_privilegio_venta_no">
                                    <input type="radio" name="privilegio_venta" id="radio_privilegio_venta_no" value="0" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="foot">
                        <div class="msg" id="formMsg"></div>
                        <div class="buttons">
                            <button class="save ideabutton" id="formButtonSave">
                                <img src="view/src/icon/save.png">
                                <span>Guardar</span>
                            </button>
                            <button class="cancel ideabutton" id="formButtonCancel">
                                <img src="view/src/icon/cancel.png">
                                <span>Cancelar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="ideamodal" id="sectionModal">
                <div class="ideaconfirm">
                    <div class="head">
                        <p class="msg">¿Esta seguro de eliminar este dato?</p>
                        <button id="modalClose"><img src="view/src/icon/close.png"></button>
                    </div>
                    <div class="foot">
                        <button class="cancel ideabutton" id="modalNo">
                            <img src="view/src/icon/cancel.png">
                            <span>Cancelar</span>
                        </button>
                        <button class="delete ideabutton" id="modalYes">
                            <img src="view/src/icon/delete.png">
                            <span>Eliminar</span>
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
    <script src="<?= $proyect['root_js_library'] ?>validacion.js"></script>
    <script src="<?= $proyect['root_js'] ?>privilegio.js"></script>
</foot>

</html>