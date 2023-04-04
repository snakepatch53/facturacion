<?php
class ProductoDao
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
            SELECT * FROM producto
                INNER JOIN bodega ON bodega.bodega_id = producto.bodega_id
            ORDER BY producto.producto_id DESC
        ");
    }
    public function selectById($producto_id)
    {
        return $this->conn->query("
            SELECT * FROM producto
                INNER JOIN bodega ON bodega.bodega_id = producto.bodega_id
            WHERE producto_id = $producto_id
                ORDER BY producto.producto_id DESC
        ");
    }
    public function insert(
        $producto_nombre,
        $producto_codigo,
        $producto_marca,
        $producto_modelo,
        $producto_elaboracion,
        $producto_vencimiento,
        $producto_descripcion,
        $bodega_id
    ) {
        return $this->conn->query("
            INSERT INTO producto SET 
                producto_nombre='$producto_nombre', 
                producto_codigo='$producto_codigo', 
                producto_marca='$producto_marca', 
                producto_modelo='$producto_modelo', 
                producto_elaboracion='$producto_elaboracion', 
                producto_vencimiento='$producto_vencimiento', 
                producto_descripcion='$producto_descripcion',
                bodega_id='$bodega_id'
        ");
    }
    public function update(
        $producto_nombre,
        $producto_codigo,
        $producto_marca,
        $producto_modelo,
        $producto_elaboracion,
        $producto_vencimiento,
        $producto_descripcion,
        $bodega_id,
        $producto_id
    ) {
        return $this->conn->query("
            UPDATE producto SET 
                producto_nombre='$producto_nombre', 
                producto_codigo='$producto_codigo', 
                producto_marca='$producto_marca', 
                producto_modelo='$producto_modelo', 
                producto_elaboracion='$producto_elaboracion', 
                producto_vencimiento='$producto_vencimiento', 
                producto_descripcion='$producto_descripcion',
                bodega_id='$bodega_id' 
            WHERE producto_id = $producto_id
        ");
    }
    public function delete($producto_id)
    {
        return $this->conn->query("DELETE FROM producto WHERE producto_id = $producto_id ");
    }
    public function updateProducto_foto(
        $producto_foto,
        $producto_id
    ) {
        return $this->conn->query("
            UPDATE producto SET 
                producto_foto='$producto_foto' 
            WHERE producto_id = $producto_id
        ");
    }
}
