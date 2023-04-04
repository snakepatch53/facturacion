<?php
class PrivilegioDao
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
        return $this->conn->query("SELECT * FROM privilegio");
    }

    public function insert(
        $privilegio_nombre,
        $privilegio_informacion,
        $privilegio_privilegio,
        $privilegio_usuario,
        $privilegio_bodega,
        $privilegio_proveedor,
        $privilegio_cliente,
        $privilegio_producto,
        $privilegio_compra,
        $privilegio_venta
    ) {
        return $this->conn->query("
            INSERT INTO privilegio SET 
                privilegio_nombre = '$privilegio_nombre',
                privilegio_informacion = '$privilegio_informacion',
                privilegio_privilegio = '$privilegio_privilegio',
                privilegio_usuario = '$privilegio_usuario',
                privilegio_bodega = '$privilegio_bodega',
                privilegio_proveedor = '$privilegio_proveedor',
                privilegio_cliente = '$privilegio_cliente',
                privilegio_producto = '$privilegio_producto',
                privilegio_compra = '$privilegio_compra',
                privilegio_venta = '$privilegio_venta'
        ");
    }
    public function update( 
        $privilegio_nombre,
        $privilegio_informacion,
        $privilegio_privilegio,
        $privilegio_usuario,
        $privilegio_bodega,
        $privilegio_proveedor,
        $privilegio_cliente,
        $privilegio_producto,
        $privilegio_compra,
        $privilegio_venta,
        $privilegio_id
    ){
        return $this->conn->query("
            UPDATE privilegio SET 
                privilegio_nombre = '$privilegio_nombre',
                privilegio_informacion = '$privilegio_informacion',
                privilegio_privilegio = '$privilegio_privilegio',
                privilegio_usuario = '$privilegio_usuario',
                privilegio_bodega = '$privilegio_bodega',
                privilegio_proveedor = '$privilegio_proveedor',
                privilegio_cliente = '$privilegio_cliente',
                privilegio_producto = '$privilegio_producto',
                privilegio_compra = '$privilegio_compra',
                privilegio_venta = '$privilegio_venta'
            WHERE privilegio_id = $privilegio_id 
        ");
    }
    public function delete($privilegio_id)
    {
        return $this->conn->query("DELETE FROM privilegio WHERE privilegio_id = $privilegio_id ");
    }
}
