                            
<?php

class Producto_ventaDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Mysql();
    }
    public function getLastId()
    {
        return $this->conn->getLastId();
    }
    public function select()
    {
        return $this->conn->query("
            SELECT * FROM producto_venta
                INNER JOIN usuario ON usuario.usuario_id = producto_venta.usuario_id
            ORDER BY producto_venta.producto_venta_fecha DESC, producto_venta.producto_venta_id DESC
        ");
    }
    public function selectById($producto_venta_id)
    {
        return $this->conn->query("
            SELECT * FROM producto_venta
                INNER JOIN usuario ON usuario.usuario_id = producto_venta.usuario_id
            WHERE producto_venta_id = $producto_venta_id
                ORDER BY producto_venta.producto_venta_fecha DESC, producto_venta.producto_venta_id DESC
        ");
    }
    public function insert(
        $producto_venta_fecha,
        $producto_venta_iva,
        $cliente_id,
        $usuario_id
    ) {
        return $this->conn->query("
            INSERT INTO producto_venta SET 
                producto_venta_fecha='$producto_venta_fecha', 
                producto_venta_iva='$producto_venta_iva',
                cliente_id=$cliente_id, 
                usuario_id=$usuario_id
        ");
    }
    public function delete($producto_venta_id)
    {
        return $this->conn->query("DELETE FROM producto_venta WHERE producto_venta_id = $producto_venta_id ");
    }
}
?>
            
                        