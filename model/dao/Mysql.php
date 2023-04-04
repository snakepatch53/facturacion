<?php
/* 
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/dao/Mysql.php
*/
class Mysql
{
    private $conn;
    private $last_id;
    public function query($sql)
    {
        $this->conectar();
        $resultado = mysqli_query($this->conn, $sql);
        $this->last_id = mysqli_insert_id($this->conn);
        $this->desconectar();
        return $resultado;
    }
    public function conectar()
    {
        $this->conn = mysqli_connect("localhost", "moronanet", "ikVtGEE6=m", "moronane_facturacion");
        mysqli_set_charset($this->conn, "utf8");
        return $this->conn;
    }
    private function desconectar()
    {
        mysqli_close($this->conn);
    }
    public function getLastId()
    {
        return $this->last_id;
    }
}
