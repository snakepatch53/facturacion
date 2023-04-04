<?php
if (empty($proyect)) {
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include($proyect['root_component'] . 'head.php') ?>
    <title>Panel - Usuarios</title>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>table.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>informacion.css">
</head>

<body>
    <div class="state open" id="tool_toggle_menu"></div>
    <header> <?php include($proyect['root_component'] . 'header.php') ?> </header>

    <content>
        <tool> <?php include($proyect['root_component'] . 'tool.php') ?> </tool>

        <page>

            <section class="ideasection open" id="sectionForm">
                <form class="ideaform" action="#" method="POST" onsubmit="return false" id="formData">
                    <div class="head">
                        <h3>Información </h3>
                        <input type="hidden" name="informacion_id" value="<?= $informacion_r['informacion_id'] ?>">
                    </div>
                    <div class="body">

                        <div class="campo">
                            <span>Nombre<b>*</b>:</span>
                            <input type="text" name="informacion_nombre" placeholder="nombre" value="<?= $informacion_r['informacion_nombre'] ?>">
                        </div>
                        <div class="campo">
                            <span>Siglas<b>*</b>:</span>
                            <input type="text" name="informacion_sigla" placeholder="sigla" value="<?= $informacion_r['informacion_sigla'] ?>">
                        </div>
                        <div class="campo">
                            <span>Logo:</span>
                            <div class="inputfile">
                                <input class="placeholder_off" type="file" name="informacion_logo" placeholder="Logo" accept="image/png">
                                <img src="view/src/icon/image.png">
                            </div>
                        </div>
                        <div class="campo">
                            <span>Icono:</span>
                            <div class="inputfile">
                                <input class="placeholder_off" type="file" name="informacion_icon" placeholder="Logo" accept="image/png">
                                <img src="view/src/icon/image.png">
                            </div>
                        </div>
                        <div class="campo">
                            <span>Ciudad<b>*</b>:</span>
                            <input type="text" name="informacion_ciudad" placeholder="ciudad" value="<?= $informacion_r['informacion_ciudad'] ?>">
                        </div>
                        <div class="campo">
                            <span>Dirección<b>*</b>:</span>
                            <input type="text" name="informacion_direccion" placeholder="direccion" value="<?= $informacion_r['informacion_direccion'] ?>">
                        </div>
                        <div class="campo">
                            <span>Teléfono<b>*</b>:</span>
                            <input type="text" name="informacion_telefono" placeholder="telefono" value="<?= $informacion_r['informacion_telefono'] ?>">
                        </div>
                        <div class="campo">
                            <span>Celular<b>*</b>:</span>
                            <input type="text" name="informacion_celular" placeholder="celular" value="<?= $informacion_r['informacion_celular'] ?>">
                        </div>
                        <div class="campo">
                            <span>Correo electrónico<b>*</b>:</span>
                            <input type="text" name="informacion_email" placeholder="email" value="<?= $informacion_r['informacion_email'] ?>">
                        </div>
                        <div class="campo">
                            <span>IVA<b>*</b>:</span>
                            <input type="number" name="informacion_iva" placeholder="iva" value="<?= $informacion_r['informacion_iva'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Primario (Fondo)<b>*</b>:</span>
                            <input type="color" name="informacion_primary_background" placeholder="primary_background" value="<?= $informacion_r['informacion_primary_background'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Primario (Fondo Hover)<b>*</b>:</span>
                            <input type="color" name="informacion_primary_background_hover" placeholder="primary_background_hover" value="<?= $informacion_r['informacion_primary_background_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Primario (Texto)<b>*</b>:</span>
                            <input type="color" name="informacion_primary_color" placeholder="primary_color" value="<?= $informacion_r['informacion_primary_color'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Primario (Texto Hover)<b>*</b>:</span>
                            <input type="color" name="informacion_primary_color_hover" placeholder="primary_color_hover" value="<?= $informacion_r['informacion_primary_color_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Secundario (Fondo)<b>*</b>:</span>
                            <input type="color" name="informacion_secondary_background" placeholder="secondary_background" value="<?= $informacion_r['informacion_secondary_background'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Secundario (Fondo Hover)<b>*</b>:</span>
                            <input type="Color" name="informacion_secondary_background_hover" placeholder="secondary_background_hover" value="<?= $informacion_r['informacion_secondary_background_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Secundario (Texto)<b>*</b>:</span>
                            <input type="color" name="informacion_secondary_color" placeholder="secondary_color" value="<?= $informacion_r['informacion_secondary_color'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Secundario (Texto Hover)<b>*</b>:</span>
                            <input type="color" name="informacion_secondary_color_hover" placeholder="secondary_color_hover" value="<?= $informacion_r['informacion_secondary_color_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Terciario (Fondo)<b>*</b>:</span>
                            <input type="color" name="informacion_tertiary_background" placeholder="tertiary_background" value="<?= $informacion_r['informacion_tertiary_background'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Terciario (Fondo Hover)<b>*</b>:</span>
                            <input type="color" name="informacion_tertiary_background_hover" placeholder="tertiary_background_hover" value="<?= $informacion_r['informacion_tertiary_background_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Terciario (Texto)<b>*</b>:</span>
                            <input type="color" name="informacion_tertiary_color" placeholder="tertiary_color" value="<?= $informacion_r['informacion_tertiary_color'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Terciario (Texto Hover)<b>*</b>:</span>
                            <input type="color" name="informacion_tertiary_color_hover" placeholder="tertiary_color_hover" value="<?= $informacion_r['informacion_tertiary_color_hover'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Success<b>*</b>:</span>
                            <input type="color" name="informacion_success" placeholder="success" value="<?= $informacion_r['informacion_success'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Info<b>*</b>:</span>
                            <input type="color" name="informacion_info" placeholder="info" value="<?= $informacion_r['informacion_info'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Warnning<b>*</b>:</span>
                            <input type="color" name="informacion_warnning" placeholder="warnning" value="<?= $informacion_r['informacion_warnning'] ?>">
                        </div>
                        <div class="campo">
                            <span>Color Error<b>*</b>:</span>
                            <input type="color" name="informacion_error" placeholder="error" value="<?= $informacion_r['informacion_error'] ?>">
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
                            <button class="edit ideabutton" id="formButtonEdit">
                                <img src="view/src/icon/edit.png">
                                <span>Editar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="ideamodal" id="sectionModal">
                <div class="ideaconfirm">
                    <div class="head">
                        <p class="msg">¿Esta seguro de realizar estos cambios?</p>
                        <button id="modalClose"><img src="view/src/icon/close.png"></button>
                    </div>
                    <div class="foot">
                        <button class="cancel ideabutton" id="modalNo">
                            <img src="view/src/icon/cancel.png">
                            <span>Cancelar</span>
                        </button>
                        <button class="delete ideabutton" id="modalYes">
                            <img src="view/src/icon/save.png">
                            <span>Guardar</span>
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
    <script src="<?= $proyect['root_js'] ?>informacion.js"></script>
</foot>

</html>