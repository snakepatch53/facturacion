<?php
/* 
- CREA UN ARCHIVO CON EL NOMBRE Y EXTENSION INDICADA.
- RUTA: proyect/model/dao/UsuarioDao.php
*/
class UsuarioDao
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
            SELECT * FROM usuario
                INNER JOIN privilegio ON privilegio.privilegio_id = usuario.privilegio_id
        ");
    }
    public function insert(
        $usuario_nombre,
        $usuario_user,
        $usuario_pass,
        $privilegio_id
    ) {
        return $this->conn->query("
            INSERT INTO usuario SET 
                usuario_nombre = '$usuario_nombre',
                usuario_user = '$usuario_user',
                usuario_pass = '$usuario_pass',
                privilegio_id = '$privilegio_id'
        ");
    }
    public function update( 
        $usuario_nombre,
        $usuario_user,
        $privilegio_id, 
        $usuario_id
    ){
        return $this->conn->query("
            UPDATE usuario SET 
                usuario_nombre = '$usuario_nombre',
                usuario_user = '$usuario_user',
                privilegio_id = '$privilegio_id'
            WHERE usuario_id = $usuario_id 
        ");
    }
    public function updatePassword(
        $usuario_pass,
        $usuario_id
    ){
        return $this->conn->query("
            UPDATE usuario SET 
                usuario_pass = '$usuario_pass'
            WHERE usuario_id = $usuario_id 
        ");
    }
    public function delete($usuario_id)
    {
        return $this->conn->query("DELETE FROM usuario WHERE usuario_id = $usuario_id ");
    }

    public function updateUsuario_foto(
        $usuario_foto,
        $usuario_id
    ) {
        return $this->conn->query("
            UPDATE usuario SET 
                usuario_foto='$usuario_foto' 
            WHERE usuario_id = $usuario_id
        ");
    }


    public function login($usuario_user, $usuario_pass)
    {
        return $this->conn->query("
            SELECT * FROM usuario 
                INNER JOIN privilegio ON privilegio.privilegio_id = usuario.privilegio_id
            WHERE usuario_user='$usuario_user' AND usuario_pass='$usuario_pass'
        ");
    }
}
