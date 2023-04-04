<?php
class BodegaDao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Mysql();
    }
    public function select()
    {
        return $this->conn->query("SELECT * FROM bodega");
    }
    public function insert($bodega_nombre, $bodega_descripcion)
    {
        return $this->conn->query("
            INSERT INTO bodega SET 
                bodega_nombre = '$bodega_nombre',
                bodega_descripcion = '$bodega_descripcion'
        ");
    }
    public function update($bodega_nombre, $bodega_descripcion, $bodega_id)
    {
        return $this->conn->query("
            UPDATE bodega SET 
                bodega_nombre = '$bodega_nombre',
                bodega_descripcion = '$bodega_descripcion'
            WHERE bodega_id = $bodega_id 
        ");
    }
    public function delete($bodega_id)
    {
        return $this->conn->query("DELETE FROM bodega WHERE bodega_id = $bodega_id ");
    }
}
