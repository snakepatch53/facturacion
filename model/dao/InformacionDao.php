<?php
class InformacionDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Mysql();
    }
    public function select()
    {
        return $this->conn->query("SELECT * FROM informacion");
    }
    public function selectById($informacion_id)
    {
        return $this->conn->query("SELECT * FROM informacion WHERE informacion_id = $informacion_id");
    }
    public function update(
        $informacion_nombre,
        $informacion_sigla,
        $informacion_ciudad,
        $informacion_direccion,
        $informacion_telefono,
        $informacion_celular,
        $informacion_email,
        $informacion_iva,
        $informacion_primary_background,
        $informacion_primary_background_hover,
        $informacion_primary_color,
        $informacion_primary_color_hover,
        $informacion_secondary_background,
        $informacion_secondary_background_hover,
        $informacion_secondary_color,
        $informacion_secondary_color_hover,
        $informacion_tertiary_background,
        $informacion_tertiary_background_hover,
        $informacion_tertiary_color,
        $informacion_tertiary_color_hover,
        $informacion_success,
        $informacion_info,
        $informacion_warnning,
        $informacion_error,
        $informacion_id
    ) {
        return $this->conn->query("
            UPDATE informacion SET 
                informacion_nombre = '$informacion_nombre',
                informacion_sigla = '$informacion_sigla',
                informacion_ciudad = '$informacion_ciudad',
                informacion_direccion = '$informacion_direccion',
                informacion_telefono = '$informacion_telefono',
                informacion_celular = '$informacion_celular',
                informacion_email = '$informacion_email',
                informacion_iva = $informacion_iva,
                informacion_primary_background = '$informacion_primary_background',
                informacion_primary_background_hover = '$informacion_primary_background_hover',
                informacion_primary_color = '$informacion_primary_color',
                informacion_primary_color_hover = '$informacion_primary_color_hover',
                informacion_secondary_background = '$informacion_secondary_background',
                informacion_secondary_background_hover = '$informacion_secondary_background_hover',
                informacion_secondary_color = '$informacion_secondary_color',
                informacion_secondary_color_hover = '$informacion_secondary_color_hover',
                informacion_tertiary_background = '$informacion_tertiary_background',
                informacion_tertiary_background_hover = '$informacion_tertiary_background_hover',
                informacion_tertiary_color = '$informacion_tertiary_color',
                informacion_tertiary_color_hover = '$informacion_tertiary_color_hover',
                informacion_success = '$informacion_success',
                informacion_info = '$informacion_info',
                informacion_warnning = '$informacion_warnning',
                informacion_error = '$informacion_error'
            WHERE informacion_id = $informacion_id
        ");
    }
    public function updateInformacion_logo(
        $informacion_logo,
        $informacion_id
    ) {
        return $this->conn->query("
            UPDATE informacion SET 
                informacion_logo='$informacion_logo' 
            WHERE informacion_id = $informacion_id
        ");
    }
    public function updateInformacion_icon(
        $informacion_icon,
        $informacion_id
    ) {
        return $this->conn->query("
            UPDATE informacion SET 
                informacion_icon='$informacion_icon' 
            WHERE informacion_id = $informacion_id
        ");
    }
}
