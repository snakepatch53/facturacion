DROP DATABASE facturacion;

CREATE DATABASE facturacion;

USE facturacion;

CREATE TABLE informacion (
    informacion_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    informacion_nombre VARCHAR(100),
    informacion_sigla VARCHAR(50),
    informacion_logo VARCHAR(10),
    informacion_icon VARCHAR(10),
    informacion_ciudad VARCHAR(50),
    informacion_direccion VARCHAR(100),
    informacion_telefono VARCHAR(11),
    informacion_celular VARCHAR(11),
    informacion_email VARCHAR(100),
    informacion_iva DOUBLE,
    informacion_primary_background VARCHAR(50),
    informacion_primary_background_hover VARCHAR(50),
    informacion_primary_color VARCHAR(50),
    informacion_primary_color_hover VARCHAR(50),
    informacion_secondary_background VARCHAR(50),
    informacion_secondary_background_hover VARCHAR(50),
    informacion_secondary_color VARCHAR(50),
    informacion_secondary_color_hover VARCHAR(50),
    informacion_tertiary_background VARCHAR(50),
    informacion_tertiary_background_hover VARCHAR(50),
    informacion_tertiary_color VARCHAR(50),
    informacion_tertiary_color_hover VARCHAR(50),
    informacion_success VARCHAR(50),
    informacion_info VARCHAR(50),
    informacion_warnning VARCHAR(50),
    informacion_error VARCHAR(50)
) ENGINE INNODB;

CREATE TABLE privilegio (
    privilegio_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    privilegio_nombre VARCHAR(50),
    privilegio_informacion BOOLEAN,
    privilegio_privilegio BOOLEAN,
    privilegio_usuario BOOLEAN,
    privilegio_bodega BOOLEAN,
    privilegio_proveedor BOOLEAN,
    privilegio_cliente BOOLEAN,
    privilegio_producto BOOLEAN,
    privilegio_compra BOOLEAN,
    privilegio_venta BOOLEAN
) ENGINE INNODB;

CREATE TABLE usuario (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usuario_nombre VARCHAR(50),
    usuario_user VARCHAR(50),
    usuario_pass VARCHAR(50),
    usuario_foto VARCHAR(10),
    usuario_last VARCHAR(50),
    privilegio_id INT,
    FOREIGN KEY (privilegio_id) REFERENCES privilegio (privilegio_id)
) ENGINE INNODB;

CREATE TABLE bodega (
    bodega_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    bodega_nombre VARCHAR(50),
    bodega_descripcion TEXT
) ENGINE INNODB;

CREATE TABLE proveedor (
    proveedor_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    proveedor_nombre VARCHAR(50),
    proveedor_provicia VARCHAR(50),
    proveedor_ciudad VARCHAR(50),
    proveedor_direccion VARCHAR(50),
    proveedor_telefono VARCHAR(11),
    proveedor_celular VARCHAR(11),
    proveedor_email VARCHAR(50),
    proveedor_ruc VARCHAR(50)
) ENGINE INNODB;

CREATE TABLE cliente (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cliente_nombre1 VARCHAR(20),
    cliente_nombre2 VARCHAR(20),
    cliente_apellido1 VARCHAR(20),
    cliente_apellido2 VARCHAR(20),
    cliente_cedula VARCHAR(50),
    cliente_ruc VARCHAR(50),
    cliente_ciudad VARCHAR(50),
    cliente_direccion VARCHAR(50),
    cliente_telefono VARCHAR(11),
    cliente_celular VARCHAR(11),
    cliente_email VARCHAR(50)
) ENGINE INNODB;

CREATE TABLE producto (
    producto_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    producto_nombre VARCHAR(50),
    producto_codigo TEXT,
    producto_marca VARCHAR(50),
    producto_modelo VARCHAR(50),
    producto_elaboracion VARCHAR(50),
    producto_vencimiento VARCHAR(50),
    producto_descripcion TEXT,
    producto_foto VARCHAR(10),
    bodega_id INT,
    FOREIGN KEY (bodega_id) REFERENCES bodega (bodega_id)
) ENGINE INNODB;

CREATE TABLE producto_compra (
    producto_compra_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    producto_compra_fecha VARCHAR(20),
    producto_compra_iva DOUBLE,
    proveedor_id INT,
    usuario_id INT,
    FOREIGN KEY (proveedor_id) REFERENCES proveedor (proveedor_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
) ENGINE INNODB;

CREATE TABLE producto_entrada (
    producto_entrada_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    producto_entrada_fecha VARCHAR(20),
    producto_entrada_cantidad INT,
    producto_entrada_precio DOUBLE,
    producto_entrada_comision DOUBLE,
    producto_id INT,
    producto_compra_id INT,
    FOREIGN KEY (producto_id) REFERENCES producto (producto_id),
    FOREIGN KEY (producto_compra_id) REFERENCES producto_compra (producto_compra_id) ON DELETE CASCADE
) ENGINE INNODB;

CREATE TABLE producto_venta (
    producto_venta_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    producto_venta_fecha VARCHAR(20),
    producto_venta_iva DOUBLE,
    cliente_id INT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
) ENGINE INNODB;

CREATE TABLE producto_salida (
    producto_salida_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    producto_salida_fecha VARCHAR(20),
    producto_salida_cantidad INT,
    producto_salida_precio DOUBLE,
    producto_salida_comision DOUBLE,
    producto_id INT,
    producto_venta_id INT,
    FOREIGN KEY (producto_id) REFERENCES producto (producto_id),
    FOREIGN KEY (producto_venta_id) REFERENCES producto_venta (producto_venta_id) ON DELETE CASCADE
) ENGINE INNODB;