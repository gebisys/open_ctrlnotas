<?php

class Generic {

    protected $obj;
    protected $db;
    public $paginator;
    public $total;

    public function __construct($obj) {
        if (is_object($obj)) {
            $this->obj = $obj;
            $this->db = $this->obj->Connect();
        }
    }

    public function GetGrades() {
        $sql = "SELECT * FROM `ctrl_grados` ORDER BY `id_gra` ASC";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getNameGrade($id) {
        $sql = "SELECT * FROM `ctrl_grados` WHERE `id_gra`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }

    public function getMateria($id) {
        $sql = "SELECT * FROM `ctrl_materias` WHERE `id_mat`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getPeriodos() {
        $sql = "SELECT * FROM `ctrl_periodos` ORDER BY `prdo_id` ASC";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getPeriodo($id) {
        $sql = "SELECT * FROM `ctrl_periodos` WHERE `prdo_id` = '{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function updatePeriodo($id=null) {
       $data = array(
           "nom" => $_POST['nom'],
           "status" => $_POST['status'],
           "enable" => $_POST['enable'],
            "id" => $_POST['id']
        );
        $sql = "UPDATE `ctrl_periodos` SET `prdo_nom`=:nom, `prdo_status`=:status,`enabled_period`=:enable WHERE `prdo_id`=:id";       
        $this->obj->Query($this->db, $sql, $data);
    }
    
    

}

?>
