<?php
if (empty($proyect)) {
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Productos</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>producto.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>table.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>

            <section class="head ideasection open" id="sectionHead">
                <h3>Productos</h3>
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
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Genérico</th>
                                <th>Existencia</th>
                                <th>Precio</th>
                                <th>Estantería</th>
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
                        <h3>Producto: </h3>
                        <input type="hidden" name="producto_id" value="0">
                        <input type="text" name="producto_nombre_view" value="" disabled>
                    </div>
                    <div class="body">
                        <div class="campo">
                            <span>Código<b>*</b>:</span>
                            <input type="text" name="producto_codigo" placeholder="Código">
                        </div>
                        <div class="campo">
                            <span>Nombre<b>*</b>:</span>
                            <input type="text" name="producto_nombre" placeholder="Nombre">
                        </div>
                        <div class="campo">
                            <span>Marca<b>*</b>:</span>
                            <input type="text" name="producto_marca" placeholder="Marca">
                        </div>
                        <div class="campo">
                            <span>Nombre Genérico:</span>
                            <input type="text" name="producto_modelo" placeholder="Genérico">
                        </div>
                        <div class="campo">
                            <span>Elaboración:</span>
                            <input type="date" name="producto_elaboracion" placeholder="Elaboración">
                        </div>
                        <div class="campo">
                            <span>Vencimiento<b>*</b>:</span>
                            <input type="date" name="producto_vencimiento" placeholder="Vencimiento">
                        </div>
                        <div class="campo">
                            <span>Foto:</span>
                            <div class="inputfile">
                                <input class="placeholder_off" type="file" name="producto_foto" placeholder="Foto" accept="image/png">
                                <img src="view/src/icon/image.png">
                            </div>
                        </div>
                        <div class="campo">
                            <span>Descripción:</span>
                            <input type="text" name="producto_descripcion" placeholder="Descripción">
                        </div>
                        <div class="campo">
                            <span>Estanteria<b>*</b>:</span>
                            <select name="bodega_id"></select>
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
    <script src="<?= $proyect['root_js'] ?>producto.js"></script>
</foot>

</html>