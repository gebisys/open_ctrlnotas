<?php

class Materias {

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

    public function insertMateria() {
        $data = array(
            "nom" => $_POST['mat']
        );

        $sql = "INSERT INTO `ctrl_materias` SET `nombre_mat`=:nom";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function updateMateria() {       
        $data = array(
           "nom" => $_POST['mat'],
            "id" => $_POST['id']
        );
        $sql = "UPDATE `ctrl_materias` SET `nombre_mat`=:nom WHERE `id_mat`=:id";       
        $this->obj->Query($this->db, $sql, $data);
    }

    public function deleteMateria() {
        $data = array(
            "id" => $_GET['del']
        );

        $sql = "DELETE FROM ctrl_materias WHERE `id_mat`=:id";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function getMaterias($limit = 10) {
	#Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_materias` ORDER BY `nombre_mat` LIMIT {$start_index},{$limit}";
        $this->totalMaterias();
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, NULL); //Damos salida al paginador
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalMaterias(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_materias`";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    

    public function getMateria($id) {
        $sql = "SELECT * FROM `ctrl_materias` WHERE `id_mat`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    
}

?>
