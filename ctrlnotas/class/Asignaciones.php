<?php

class Asignaciones {

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

    public function saveAsignacion() {
        $codeAsig = $this->obj->ramdomCode();
        $data = array(
            "docent" => $_POST['docente'],
            "mate" => $_POST['mate'],
            "code" => $codeAsig
        );
        $data1 = array(
            "docent" => $_POST['docente'],
            "grade" => $_POST['grade'],
            "code" => $codeAsig
        );

        $sql = "INSERT INTO `ctrl_doc2materia` SET `dcnt_id`=:docent, `id_mat`=:mate, `code_asig`=:code";
        $sql1 = "INSERT INTO `ctrl_doc2grado` SET `dcnt_id`=:docent, `id_gra`=:grade, `code_asig`=:code";
        $this->obj->Query($this->db, $sql, $data);
        $this->obj->Query($this->db, $sql1, $data1);
    }

    public function updateAsignacion() {
        $data = array(
            "docent" => $_POST['docente'],
            "mate" => $_POST['mate'],
            "code" => $_POST['code']
        );
        $data1 = array(
            "docent" => $_POST['docente'],
            "grade" => $_POST['grade'],
            "code" => $_POST['code']
        );
        $sql = "UPDATE `ctrl_doc2materia` SET `dcnt_id`=:docent, `id_mat`=:mate WHERE `code_asig`=:code";
        $sql1 = "UPDATE `ctrl_doc2grado` SET `dcnt_id`=:docent, `id_gra`=:grade WHERE `code_asig`=:code";
        $this->obj->Query($this->db, $sql, $data);
        $this->obj->Query($this->db, $sql1, $data1);
    }

    public function deleteAsignacion() {
        $data = array(
            "id" => $_GET['del']
        );

        $sql = "DELETE `ctrl_doc2grado`, `ctrl_doc2materia` FROM `ctrl_doc2grado`, `ctrl_doc2materia` WHERE `ctrl_doc2materia`.`code_asig`=:id AND `ctrl_doc2grado`.`code_asig`=:id";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function getAsignaciones($limit = 10, $opt = 0) {
        $where = ($opt == 0 ) ? "`ctrl_doc2materia`.`dcnt_id`= `ctrl_doc2grado`.`dcnt_id` AND `ctrl_doc2materia`.`code_asig`= `ctrl_doc2grado`.`code_asig` " : "`ctrl_doc2grado`.`dcnt_id` = '{$_GET['docente']}' AND `ctrl_doc2materia`.`dcnt_id` = '{$_GET['docente']}' AND `ctrl_doc2materia`.`code_asig`= `ctrl_doc2grado`.`code_asig` ";
        #Declaracion de variables
        $pagep = (isset($_GET["page"]) && is_numeric($_GET["page"]) ) ? $_GET["page"] : 1;
        $start_index = ($pagep * $limit) - $limit;
        $sql = "SELECT * FROM `ctrl_doc2grado`, `ctrl_doc2materia` WHERE {$where} LIMIT {$start_index},{$limit}";
        $this->totalAsignaciones($opt);
        $this->paginator = new paginator($pagep, $limit, 5, $this->total, $pagep, NULL); //Damos salida al paginador
        $stmt = $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }

    public function totalAsignaciones($opt = 0) {
        $where = ($opt == 0 ) ? "`ctrl_doc2materia`.`dcnt_id`= `ctrl_doc2grado`.`dcnt_id` AND `ctrl_doc2materia`.`code_asig`= `ctrl_doc2grado`.`code_asig` " : "`ctrl_doc2grado`.`dcnt_id` = '{$_GET['docente']}' AND `ctrl_doc2materia`.`dcnt_id` = '{$_GET['docente']}' AND `ctrl_doc2materia`.`code_asig`= `ctrl_doc2grado`.`code_asig` ";
        $sqlTotal = "SELECT COUNT(*) As Total FROM `ctrl_doc2grado`, `ctrl_doc2materia` WHERE {$where}";
        $stmtTotal = $this->obj->Query($this->db, $sqlTotal);
        $this->total = $this->obj->fetchObject($stmtTotal);
    }
    

    public function getAsignacion($id) {
        $sql = "SELECT * FROM  `ctrl_doc2grado`, `ctrl_doc2materia` WHERE `ctrl_doc2grado`.`code_asig` = '{$id}' AND `ctrl_doc2materia`.`code_asig` = '{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    
    public function getGradesxMat(){
    	
    	$sql	=	"SELECT g.id_gra As idg, g.nombre_gra As nombreg, g.nivel_gra As nivelg
    			FROM ctrl_grados g
    			INNER JOIN ctrl_doc2grado dg
    				ON g.id_gra = dg.id_gra
    			INNER JOIN ctrl_doc2materia dm
    				ON dg.dcnt_id = dm.dcnt_id
    			WHERE dm.dcnt_id = '{$_SESSION['sys_docente_id']}' AND dm.id_mat = '{$_GET['mat']}' AND dg.code_asig = dm.code_asig
    			";
    	$stmt = $this->obj->Query($this->db, $sql);
    	return $this->obj->fetchAssoc($stmt);
    }
    
    public function getGradesxMatid($docente_id, $mat_id){
    	
    	$sql	=	"SELECT g.id_gra As idg, g.nombre_gra As nombreg, g.nivel_gra As nivelg
    			FROM ctrl_grados g
    			INNER JOIN ctrl_doc2grado dg
    				ON g.id_gra = dg.id_gra
    			INNER JOIN ctrl_doc2materia dm
    				ON dg.dcnt_id = dm.dcnt_id
    			WHERE dm.dcnt_id = '{$docente_id}' AND dm.id_mat = '{$mat_id}' AND dg.code_asig = dm.code_asig
    			";
    	$stmt = $this->obj->Query($this->db, $sql);
    	return $this->obj->fetchAssoc($stmt);
    }

}
?>
