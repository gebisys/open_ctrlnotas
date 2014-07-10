<?php

class Docente {

    protected	$obj;
    protected	$db;
    public	$paginator;
    public 	$total;

    public function __construct($obj) {
        if (is_object($obj)) {
            $this->obj = $obj;
            $this->db = $this->obj->Connect();
        }
    }

    public function insertDocente() {
        $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "cargo" => $_POST['cargo'],
            "email" => $_POST['email'],
            "user" => $_POST['user'],
            "pass" => $_POST['pwd']
        );

        $sql = "INSERT INTO `ctrl_docentes` SET `dcnt_nom`=:nom, `dcnt_cargo`=:cargo, `dcnt_ape`=:ape, `dcnt_email`=:email, `dcnt_user` =:user, `dcnt_pwd`=md5(:pass)";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function updateDocente($opt = 0 ) {
        if($opt === 0 ){
         $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "cargo" => $_POST['cargo'],
            "email" => $_POST['email'],
            "user" => $_POST['user'],
             "id" => $_POST['id']
        );

        $sql = "UPDATE `ctrl_docentes` SET `dcnt_nom`=:nom, `dcnt_cargo`=:cargo, `dcnt_ape`=:ape, `dcnt_email`=:email, `dcnt_user` =:user WHERE `dcnt_id`=:id";
        
        }else {
             $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "cargo" => $_POST['cargo'],
            "email" => $_POST['email'],
            "user" => $_POST['user'],
            "pass" => $_POST['password'],
            "id" => $_POST['id']
        );

         $sql = "UPDATE `ctrl_docentes` SET `dcnt_nom`=:nom, `dcnt_cargo`=:cargo, `dcnt_ape`=:ape, `dcnt_email`=:email, `dcnt_user` =:user, `dcnt_pwd`=md5(:pass) WHERE `dcnt_id`=:id";
        }
        $this->obj->Query($this->db, $sql, $data);
    }

    public function deleteDocente() {
        $data = array(
            "id" => $_GET['del']
        );

        $sql = "DELETE FROM ctrl_docentes WHERE `dcnt_id`=:id";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function getDocentes($limit = 10) {
	#Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_docentes` ORDER BY `dcnt_id` LIMIT {$start_index},{$limit}";
        $this->totalDocentes();
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, NULL); //Damos salida al paginador
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalDocentes(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_docentes`";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    

    public function getDocente($id) {
        $sql = "SELECT * FROM `ctrl_docentes` WHERE `dcnt_id`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getDocenteNom($id) {
        $sql = "SELECT `dcnt_nom`, `dcnt_ape` FROM `ctrl_docentes` WHERE `dcnt_id`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }

}

?>
