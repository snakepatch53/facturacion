<?php
class Producto_salidaDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Mysql();
    }
    public function select()
    {
        return $this->conn->query("SELECT * FROM producto_salida");
    }
    public function selectById($producto_salida_id)
    {
        return $this->conn->query("SELECT * FROM producto_salida WHERE producto_salida_id = $producto_salida_id");
    }
    public function insert(
        $producto_salida_fecha,
        $producto_salida_cantidad,
        $producto_salida_precio,
        $producto_salida_comision,
        $producto_id,
        $producto_venta_id
    ) {
        return $this->conn->query("
            INSERT INTO producto_salida SET 
                producto_salida_fecha='$producto_salida_fecha', 
                producto_salida_cantidad=$producto_salida_cantidad, 
                producto_salida_precio=$producto_salida_precio, 
                producto_salida_comision=$producto_salida_comision, 
                producto_id=$producto_id, 
                producto_venta_id=$producto_venta_id
        ");
    }
    public function update(
        $producto_salida_fecha,
        $producto_salida_cantidad,
        $producto_salida_precio,
        $producto_salida_comision,
        $producto_id,
        $producto_venta_id,
        $producto_salida_id
    ) {
        return $this->conn->query("
            UPDATE producto_salida SET 
                producto_salida_fecha='$producto_salida_fecha', 
                producto_salida_cantidad=$producto_salida_cantidad, 
                producto_salida_precio=$producto_salida_precio, 
                producto_salida_comision=$producto_salida_comision, 
                producto_id=$producto_id, 
                producto_venta_id=$producto_venta_id 
            WHERE producto_salida_id = $producto_salida_id
        ");
    }
    public function delete($producto_salida_id)
    {
        return $this->conn->query("DELETE FROM producto_salida WHERE producto_salida_id = $producto_salida_id ");
    }
}
