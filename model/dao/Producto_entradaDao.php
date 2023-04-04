<?php
class Producto_entradaDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Mysql();
    }
    public function select()
    {
        return $this->conn->query("
            SELECT * FROM producto_entrada
                INNER JOIN producto ON producto.producto_id = producto_entrada.producto_id
        ");
    }
    public function selectById($producto_entrada_id)
    {
        return $this->conn->query("
            SELECT * FROM producto_entrada
                INNER JOIN producto ON producto.producto_id = producto_entrada.producto_id
            WHERE producto_entrada_id = $producto_entrada_id
        ");
    }
    public function insert(
        $producto_entrada_fecha,
        $producto_entrada_cantidad,
        $producto_entrada_precio,
        $producto_entrada_comision,
        $producto_id,
        $producto_compra_id
    ) {
        return $this->conn->query("
            INSERT INTO producto_entrada SET 
                producto_entrada_fecha='$producto_entrada_fecha', 
                producto_entrada_cantidad=$producto_entrada_cantidad, 
                producto_entrada_precio=$producto_entrada_precio, 
                producto_entrada_comision=$producto_entrada_comision, 
                producto_id=$producto_id,
                producto_compra_id=$producto_compra_id
        ");
    }
    public function update(
        $producto_entrada_fecha, 
        $producto_entrada_cantidad, 
        $producto_entrada_precio, 
        $producto_entrada_comision, 
        $producto_id, 
        $producto_compra_id,
        $producto_entrada_id
    ){
        return $this->conn->query("
            UPDATE producto_entrada SET 
                producto_entrada_fecha='$producto_entrada_fecha', 
                producto_entrada_cantidad=$producto_entrada_cantidad, 
                producto_entrada_precio=$producto_entrada_precio, 
                producto_entrada_comision=$producto_entrada_comision, 
                producto_id=$producto_id, 
                producto_compra_id=$producto_compra_id 
            WHERE producto_entrada_id = $producto_entrada_id
        ");
    }
    public function delete($producto_entrada_id)
    {
        return $this->conn->query("DELETE FROM producto_entrada WHERE producto_entrada_id = $producto_entrada_id ");
    }
}
