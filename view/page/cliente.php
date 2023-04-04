<?php
if (empty($proyect)) {
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Clientes</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>cliente.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>table.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>


            <section class="head ideasection open" id="sectionHead">
                <h3>Clientes</h3>
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
                                <th>Cédula / Ruc</th>
                                <th>Dirección</th>
                                <th>Contacto</th>
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
                        <h3>Cliente: </h3>
                        <input type="hidden" name="cliente_id" value="0">
                        <input type="text" name="cliente_nombre_view" value="" disabled>
                    </div>
                    <div class="body">

                        <div class="campo">
                            <span>Primer Nombre<b>*</b>:</span>
                            <input type="text" name="cliente_nombre1" placeholder="Primer Nombre">
                        </div>
                        <div class="campo">
                            <span>Segundo Nombre<b>*</b>:</span>
                            <input type="text" name="cliente_nombre2" placeholder="Segundo Nombre">
                        </div>
                        <div class="campo">
                            <span>Primer Apellido<b>*</b>:</span>
                            <input type="text" name="cliente_apellido1" placeholder="Primer Apellido">
                        </div>
                        <div class="campo">
                            <span>Segundo Apellido<b>*</b>:</span>
                            <input type="text" name="cliente_apellido2" placeholder="Segundo Apellido">
                        </div>
                        <div class="campo">
                            <span>Cédula<b style="color: var(--info);">*</b>:</span>
                            <input type="text" name="cliente_cedula" placeholder="Cédula">
                        </div>
                        <div class="campo">
                            <span>Ruc<b style="color: var(--info);">*</b>:</span>
                            <input type="text" name="cliente_ruc" placeholder="Ruc">
                        </div>
                        <div class="campo">
                            <span>Ciudad<b>*</b>:</span>
                            <input type="text" name="cliente_ciudad" placeholder="Ciudad">
                        </div>
                        <div class="campo">
                            <span>Dirección<b>*</b>:</span>
                            <input type="text" name="cliente_direccion" placeholder="Dirección">
                        </div>
                        <div class="campo">
                            <span>Teléfono:</span>
                            <input type="text" name="cliente_telefono" placeholder="Teléfono">
                        </div>
                        <div class="campo">
                            <span>Celular<b>*</b>:</span>
                            <input type="text" name="cliente_celular" placeholder="Celular">
                        </div>
                        <div class="campo">
                            <span>Correo Electronico<b>*</b>:</span>
                            <input type="text" name="cliente_email" placeholder="Correo Electronico">
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
    <script src="<?= $proyect['root_js'] ?>cliente.js"></script>
</foot>

</html>