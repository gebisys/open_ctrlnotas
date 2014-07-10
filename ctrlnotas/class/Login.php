<?php

class Login {

    protected   $db;
    protected   $obj;
    public	$paginator;
    public 	$total;

    public function __construct($_obj) {
        if (is_object($_obj)) {
            $this->obj = $_obj;
            $this->db = $this->obj->Connect();
        } else {
            return false;
        }
    }

    public function access() {

        $data = array(
            'usuario' => $_POST['username'],
            'clave' => $_POST['adminpassword']
        );

        $sql = "SELECT * FROM `ctrl_usuarios` WHERE `usu_nomb`=:usuario AND `usu_pass`=md5(:clave) LIMIT 1";

        $stmt = $this->obj->Query($this->db, $sql, $data);
        if ($this->obj->numRows($stmt) == 1) {
            $data = $this->obj->fetchAssoc($stmt);
            $_SESSION['sys_user'] = $data[0]['usu_nomb'];
            $_SESSION['sys_user_level'] = $data[0]['usu_level'];
            return true;
        } else {
            return false;
        }
    }

    public function saveUser() {
        $data = array(
            "usuario" => $_POST["user"],
            "clave" => $_POST["pwd"],
            "tipo" => $_POST["tipo"],
            "code" => $_POST["emple"]
        );
        $sql = "INSERT `ctrl_usuarios` SET `usu_nomb`=:usuario, `usu_pass`=md5(:clave), `usu_level`=:tipo, `usu_code`=:code";
        $this->obj->Query($this->db, $sql, $data);
        return true;
        
    }

    public function updateUser($opt = 0 ) {
        if($opt === 0 ){
         $data = array(
           "usuario" => $_POST["user"],
            "tipo" => $_POST["tipo"],
            "code" => $_POST["emple"],
            "id" => $_POST['id']
        );

        $sql = "UPDATE `ctrl_usuarios` SET `usu_nomb`=:usuario, `usu_level`=:tipo, `usu_code`=:code WHERE `id_usu`=:id";
        
        }else {
             $data = array(
          "usuario" => $_POST["user"],
            "clave" => $_POST["password"],
            "tipo" => $_POST["tipo"],
            "code" => $_POST["emple"],
            "id" => $_POST['id']
        );

         $sql = "UPDATE `ctrl_usuarios` SET `usu_nomb`=:usuario, `usu_pass`=md5(:clave), `usu_level`=:tipo, `usu_code`=:code WHERE `id_usu`=:id";
        }
        $this->obj->Query($this->db, $sql, $data);
    }

    public function deleteUser() {
        $data = array(
            "id" => $_GET['del']
        );

        $sql = "DELETE FROM ctrl_usuarios WHERE `id_usu`=:id";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function getUsers($limit = 10) {
	#Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_usuarios` ORDER BY `id_usu` DESC LIMIT {$start_index},{$limit}";
        $this->totalUsers();
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, NULL); //Damos salida al paginador
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalUsers(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_usuarios`";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    

    public function getUser($id) {
        $sql = "SELECT * FROM `ctrl_usuarios` WHERE `id_usu`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }

}

?>
