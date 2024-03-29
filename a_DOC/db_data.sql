INSERT INTO
    informacion
SET
    informacion_id = 1,
    informacion_nombre = 'Maria Auxiliadora',
    informacion_sigla = 'M.A.',
    informacion_logo = null,
    informacion_icon = null,
    informacion_ciudad = 'Sucua',
    informacion_direccion = '24 de mayo',
    informacion_telefono = '0980199937',
    informacion_celular = '0700500601',
    informacion_email = 'empresa@email.com',
    informacion_iva = 12,
    informacion_primary_background = '#7BB12C',
    informacion_primary_background_hover = '#669224',
    informacion_primary_color = '#ffffff',
    informacion_primary_color_hover = '#f0f0f0',
    informacion_secondary_background = '#292D3E',
    informacion_secondary_background_hover = '#242736',
    informacion_secondary_color = '#ffffff',
    informacion_secondary_color_hover = '#f0f0f0',
    informacion_tertiary_background = '#FFFFFF',
    informacion_tertiary_background_hover = '#d5d5d5',
    informacion_tertiary_color = '#1b1b1b',
    informacion_tertiary_color_hover = '#000000',
    informacion_success = '#19A15F',
    informacion_info = '#427ad5',
    informacion_warnning = '#FFCD42',
    informacion_error = '#DD5145';

INSERT INTO
    privilegio
SET
    privilegio_id = 1,
    privilegio_nombre = "Administrador",
    privilegio_informacion = 1,
    privilegio_privilegio = 1,
    privilegio_usuario = 1,
    privilegio_bodega = 1,
    privilegio_proveedor = 1,
    privilegio_cliente = 1,
    privilegio_producto = 1,
    privilegio_compra = 1,
    privilegio_venta = 1;

INSERT INTO
    usuario
SET
    usuario_id = 1,
    usuario_nombre = 'Administrador',
    usuario_user = 'admin',
    usuario_pass = '21232f297a57a5a743894a0e4a801fc3',
    usuario_foto = null,
    privilegio_id = 1;