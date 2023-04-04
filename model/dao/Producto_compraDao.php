<?php

class Producto_compraDao
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
            SELECT * FROM producto_compra
                INNER JOIN proveedor ON proveedor.proveedor_id = producto_compra.proveedor_id
                INNER JOIN usuario ON usuario.usuario_id = producto_compra.usuario_id
            ORDER BY producto_compra.producto_compra_fecha DESC, producto_compra.producto_compra_id DESC
        ");
    }
    public function selectById($producto_compra_id)
    {
        return $this->conn->query("
            SELECT * FROM producto_compra 
                INNER JOIN proveedor ON proveedor.proveedor_id = producto_compra.proveedor_id
                INNER JOIN usuario ON usuario.usuario_id = producto_compra.usuario_id
            WHERE producto_compra_id = $producto_compra_id
                ORDER BY producto_compra.producto_compra_fecha DESC, producto_compra.producto_compra_id DESC
        ");
    }
    public function insert(
        $producto_compra_fecha,
        $producto_compra_iva,
        $proveedor_id,
        $usuario_id
    ) {
        return $this->conn->query("
            INSERT INTO producto_compra SET 
                producto_compra_fecha='$producto_compra_fecha', 
                producto_compra_iva=$producto_compra_iva, 
                proveedor_id=$proveedor_id, 
                usuario_id=$usuario_id 
        ");
    }
    public function update(
        $producto_compra_fecha,
        $producto_compra_iva,
        $proveedor_id,
        $usuario_id,
        $producto_compra_id
    ) {
        return $this->conn->query("
            UPDATE producto_compra SET 
                producto_compra_fecha='$producto_compra_fecha', 
                producto_compra_iva=$producto_compra_iva, 
                proveedor_id=$proveedor_id, 
                usuario_id=$usuario_id 
            WHERE producto_compra_id = $producto_compra_id 
        ");
    }
    public function delete($producto_compra_id)
    {
        return $this->conn->query("DELETE FROM producto_compra WHERE producto_compra_id = $producto_compra_id ");
    }
}
