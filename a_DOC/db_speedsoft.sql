DROP DATABASE iglesia;

CREATE DATABASE iglesia;

USE iglesia;

-- @@@@options:{ "files": [{"type":"png", "name":"pagina_logo"}, {"type":"png", "name":"pagina_icon"}] }
CREATE TABLE pagina (
    pagina_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pagina_nombre VARCHAR(50),
    pagina_sigla VARCHAR(20),
    pagina_logo VARCHAR(10),
    pagina_icon VARCHAR(10),
    pagina_primary_background VARCHAR(10),
    pagina_primary_background_hover VARCHAR(10),
    pagina_primary_color VARCHAR(10),
    pagina_primary_color_hover VARCHAR(10),
    pagina_secondary_background VARCHAR(10),
    pagina_secondary_background_hover VARCHAR(10),
    pagina_secondary_color VARCHAR(10),
    pagina_secondary_color_hover VARCHAR(10),
    pagina_tertiary_background VARCHAR(10),
    pagina_tertiary_background_hover VARCHAR(10),
    pagina_tertiary_color VARCHAR(10),
    pagina_tertiary_color_hover VARCHAR(10),
    pagina_success VARCHAR(10),
    pagina_info VARCHAR(10),
    pagina_warnning VARCHAR(10),
    pagina_error VARCHAR(10)
) ENGINE INNODB;

-- @@@@options:{ "account": {"user":"usuario_user","pass":"usuario_pass"}, "files": [{"type":"png", "name":"usuario_foto"}] }
CREATE TABLE usuario (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usuario_nombre VARCHAR(50),
    usuario_user VARCHAR(50),
    usuario_pass VARCHAR(50),
    usuario_foto VARCHAR(10)
) ENGINE INNODB;

CREATE TABLE nivel (
    nivel_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nivel_nombre VARCHAR(50),
    nivel_descripcion TEXT
) ENGINE INNODB;

CREATE TABLE estudiante (
    estudiante_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    estudiante_nombre VARCHAR(50),
    estudiante_apellido VARCHAR(50),
    estudiante_edad INT,
    estudiante_representante VARCHAR(50),
    estudiante_direccion TEXT,
    estudiante_telefono VARCHAR(11),
    nivel_id INT,
    FOREIGN KEY (nivel_id) REFERENCES nivel (nivel_id)
) ENGINE INNODB;

CREATE TABLE cobro (
    cobro_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cobro_fecha_ini VARCHAR(50),
    cobro_fecha_fin VARCHAR(50),
    cobro_valor DOUBLE,
    estudiante_id INT,
    FOREIGN KEY (estudiante_id) REFERENCES estudiante (estudiante_id)
) ENGINE INNODB;