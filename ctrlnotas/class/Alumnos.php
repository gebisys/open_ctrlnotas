<?php

class Alumno {

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

    public function insertAlumn() {
        $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "grade" => $_POST['grade'],
            "cod" => $_POST['nie'],
            "pass" => $_POST['pwd'],
            "matricula" =>$_POST['matricula']
        );

        $sql = "INSERT INTO `ctrl_alumnos` SET `alumn_nomb`=:nom, `alumn_code`=:cod, `alumn_apell`=:ape, `cod_grado`=:grade,`contrasena_alum`=md5(:pass), `matricula`=:matricula";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function updateAlumn($opt = 0 ) {
        if($opt === 0 ){
        $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "grade" => $_POST['grade'],
            "cod" => $_POST['nie'],
            "matricula" =>$_POST['matricula'],
            "id" => $_POST['id']
        );

        $sql = "UPDATE `ctrl_alumnos` SET `alumn_nomb`=:nom, `alumn_code`=:cod, `alumn_apell`=:ape, `cod_grado`=:grade,  `matricula`=:matricula WHERE `id_alumn`=:id";
        
        }else {
             $data = array(
            "nom" => $_POST['name'],
            "ape" => $_POST['ape'],
            "grade" => $_POST['grade'],
            "cod" => $_POST['nie'],
            "pass" => $_POST['password'],
            "id" => $_POST['id']
        );

        $sql = "UPDATE `ctrl_alumnos` SET `alumn_nomb`=:nom, `alumn_code`=:cod, `alumn_apell`=:ape, `cod_grado`=:grade, `contrasena_alum`=md5(:pass) WHERE `id_alumn`=:id";
        }
        $this->obj->Query($this->db, $sql, $data);
    }

    public function deleteAlumn() {
        $data = array(
            "id" => $_GET['del']
        );

        $sql = "DELETE FROM ctrl_alumnos WHERE `id_alumn`=:id";
        $this->obj->Query($this->db, $sql, $data);
    }

    public function getAlumns($limit = 10) {
	#Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_alumnos` ORDER BY `alumn_apell` ASC LIMIT {$start_index},{$limit}";
        $this->totalAlumnos();
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, NULL); //Damos salida al paginador
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalAlumnos(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_alumnos`";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    

    public function getAlumn($id) {
        $sql = "SELECT * FROM `ctrl_alumnos` WHERE `id_alumn`='{$id}' LIMIT 1";
        $stmt = $this->obj->Query($this->db, $sql);
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getAlumnByGrade($limit = 10){
        #Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_alumnos` WHERE `cod_grado` = '{$_GET['idg']}' ORDER BY `alumn_apell` ASC LIMIT {$start_index},{$limit}";
        $this->totalAlumnosByGrade();
        $gets = "idg=".$_GET['idg'];
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, $gets); //Damos salida al paginador
        
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalAlumnosByGrade(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_alumnos` WHERE `cod_grado` = '{$_GET['idg']}'";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    
    public function getAlumnByNom($limit = 10){
        #Declaracion de variables
	$pagep 			= (isset( $_GET["page"] ) && is_numeric( $_GET["page"] ) ) ? $_GET["page"] : 1;
	$start_index 		= ($pagep * $limit) - $limit;
        $sql			= "SELECT * FROM `ctrl_alumnos` WHERE `alumn_nomb` LIKE  '%{$_GET['findA']}%' OR `alumn_apell` LIKE  '%{$_GET['findA']}%' ORDER BY `alumn_apell` ASC LIMIT {$start_index},{$limit}";
        $this->totalAlumnosByNom();
        $gets = "findA=".$_GET['findA'];
        $this->paginator 	= new paginator($pagep, $limit, 5, $this->total, $pagep, $gets); //Damos salida al paginador
        
        $stmt 			= $this->obj->Query($this->db, $sql); //Retornamos los resultados
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function totalAlumnosByNom(){
    	$sqlTotal		= "SELECT COUNT(*) As Total FROM `ctrl_alumnos` WHERE `alumn_nomb` LIKE  '%{$_GET['findA']}%' OR `alumn_apell` LIKE  '%{$_GET['findA']}%'";
        $stmtTotal		= $this->obj->Query($this->db, $sqlTotal);
        $this->total		= $this->obj->fetchObject($stmtTotal);
    }
    
    public function VerifyNotasAlumn($idA, $idG, $year){
     
    	$sql	= "";
    	/**cod_grado*/
    	switch($idG){
    		case "1":
    		case "2":
    		case "3":
    		case "4":
    		case "5":
    		case "6":
    			//Primaria
		    	$sql	=	"SELECT
		    				a.id_alumn As id
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notasprimaria n
		    				ON a.id_alumn = n.id_alumn
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				a.id_alumn = '{$idA}' 
		    				AND n.id_gra = '{$idG}' 
                                                AND n.ntpr_fecha = '{$year}'
                                        ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
		    			
		 case "7":
		 case "8":
		 case "9":
		 	//Secundaria
		    	$sql	=	"SELECT
		    				a.id_alumn As id
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notassecundaria n
		    				ON a.id_alumn = n.alumn_code
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				a.id_alumn = '{$idA}' 
		    				AND n.id_grad = '{$idG}'
                                                AND n.ntscn_fecha = '{$year}'
		    			 ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
		    			
		case "10":
		case "11":
			//Bachillerato
		    	$sql	=	"SELECT
		    				a.id_alumn As id
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notasbachillerato n
		    				ON a.id_alumn = n.alumn_code
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				a.id_alumn = '{$idA}' 
		    				AND n.id_gra = '{$idG}'
                                                AND n.nbch_fecha = '{$year}'
		    			 ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
    	}
        
        $stmt 	= $this->obj->Query($this->db, $sql);
        $result = $this->obj->fetchAssoc($stmt);
        if(count($result) == 0){
            echo "<a href='createDefaultScoreAlumn.php?ida=".$idA."&idg=".$idG."&year=".$year."' id=''><img src='images/icons/exclamation.png' title='Alumna no tiene notas registradas ¡Click para Crear notas por Defecto!'/></a>";
        }
    	
    }
    
    
    /*funcion para crear notas por defecto */
    public function createDefaultScore(){     
        switch($_GET['idg']){
    		case "1":
    		case "2":
    		case "3":
    		case "4":
    		case "5":
    		case "6":
    			//Primaria
                     /* Obteniendo los periodos con notas registradas pàra el grado */
                        $sql = "SELECT `ntpr_periodo` FROM `ctrl_notasprimaria` WHERE `id_gra` = '{$_GET['idg']}' AND `ntpr_fecha` = '{$_GET['year']}'  Group by `ntpr_periodo`";
                        $stmt 	= $this->obj->Query($this->db, $sql);
                        $periods = $this->obj->fetchAssoc($stmt);
                         for ($i = 0; $i < count($periods); $i++):
                               /* Obteniendo las materiasd del grado */
                            $sql1 = "SELECT  dm.id_mat AS id_materia
                                        FROM ctrl_grados g
                                        INNER JOIN ctrl_doc2grado dg
                                                ON g.id_gra = dg.id_gra
                                        INNER JOIN ctrl_doc2materia dm
                                                ON dg.dcnt_id = dm.dcnt_id
                                        WHERE g.id_gra= '{$_GET['idg']}' AND dg.code_asig = dm.code_asig
                                        ";
                            $stmt1 	= $this->obj->Query($this->db, $sql1);
                            $mats = $this->obj->fetchAssoc($stmt1);
                            for ($o = 0; $o < count($mats); $o++):
                                  $sql2 = "INSERT INTO 
                                            `ctrl_notasprimaria` 
                                        SET 
                                            `ntpr_act1` = '0',
                                            `ntpr_act2` = '0',
                                            `ntpr_act3` = '0',
                                            `ntpr_actprom` = '0',
                                            `ntpr_examen` = '0',
                                            `ntpr_examen_pro` = '0',
                                            `ntpr_promedio` = '0',
                                            `id_alumn` = '{$_GET["ida"]}',
                                            `id_mat` = '{$mats[$o]["id_materia"]}', 
                                            `id_gra` = '{$_GET['idg']}', 
                                            `ntpr_periodo` = '{$periods[$i]["ntpr_periodo"]}', 
                                            `ntpr_fecha` = '{$_GET['year']}',
                                            `observ` = ' '
                                        ";
                                    $this->obj->Query($this->db, $sql2);   
                            endfor;
                         endfor;
		    break;
		    			
		 case "7":
		 case "8":
		 case "9":
		 	//Secundaria
                      /* Obteniendo los periodos con notas registradas pàra el grado */
		    	$sql = "SELECT `ntscn_periodo`  FROM `ctrl_notassecundaria` WHERE `id_grad` = '{$_GET['idg']}' AND `ntscn_fecha` = '{$_GET['year']}'  Group by `ntscn_periodo`";
                         $stmt 	= $this->obj->Query($this->db, $sql);
                        $periods = $this->obj->fetchAssoc($stmt);
                         for ($i = 0; $i < count($periods); $i++):
                               /* Obteniendo las materiasd del grado */
                            $sql1 = "SELECT  dm.id_mat AS id_materia
                                        FROM ctrl_grados g
                                        INNER JOIN ctrl_doc2grado dg
                                                ON g.id_gra = dg.id_gra
                                        INNER JOIN ctrl_doc2materia dm
                                                ON dg.dcnt_id = dm.dcnt_id
                                        WHERE g.id_gra= '{$_GET['idg']}' AND dg.code_asig = dm.code_asig
                                        ";
                            $stmt1 	= $this->obj->Query($this->db, $sql1);
                            $mats = $this->obj->fetchAssoc($stmt1);
                            for ($o = 0; $o < count($mats); $o++):
                                  $sql2 = " INSERT INTO 
                                        `ctrl_notassecundaria` 
                                    SET 
                                        `ntscn_act1` = '0',
                                        `ntscn_act2` = '0',
                                        `ntscn_act3` = '0',
                                        `ntscn_act_prom` = '0',
                                        `ntscn_auto` = '0',
                                        `ntscn_hetero` = '0',
                                        `ntscn_evaluacion_prom` = '0',
                                        `ntscn_prueba_obj` = '0',
                                        `ntscn_prueba_obj_prom` = '0',
                                        `ntscn_promedio` = '0',
                                        `alumn_code` = '{$_GET["ida"]}',
                                        `id_mat` = '{$mats[$o]["id_materia"]}', 
                                        `id_grad` = '{$_GET['idg']}', 
                                        `ntscn_periodo` = '{$periods[$i]["ntscn_periodo"]}', 
                                        `ntscn_fecha` = '{$_GET['year']}',
                                        `observ` = ' '
                                        ";
                                    $this->obj->Query($this->db, $sql2);   
                            endfor;
                         endfor;
                        break;
		    			
		case "10":
		case "11":
			//Bachillerato
                     /* Obteniendo los periodos con notas registradas pàra el grado */
		    	$sql = "SELECT nbch_periodo  FROM `ctrl_notasbachillerato` WHERE `id_gra` = '{$_GET['idg']}' AND `nbch_fecha` = '{$_GET['year']}'  Group by `nbch_periodo`";
                         $stmt 	= $this->obj->Query($this->db, $sql);
                        $periods = $this->obj->fetchAssoc($stmt);
                         for ($i = 0; $i < count($periods); $i++):
                               /* Obteniendo las materiasd del grado */
                            $sql1 = "SELECT  dm.id_mat AS id_materia
                                        FROM ctrl_grados g
                                        INNER JOIN ctrl_doc2grado dg
                                                ON g.id_gra = dg.id_gra
                                        INNER JOIN ctrl_doc2materia dm
                                                ON dg.dcnt_id = dm.dcnt_id
                                        WHERE g.id_gra= '{$_GET['idg']}' AND dg.code_asig = dm.code_asig
                                        ";
                            $stmt1 	= $this->obj->Query($this->db, $sql1);
                            $mats = $this->obj->fetchAssoc($stmt1);
                            for ($o = 0; $o < count($mats); $o++):
                                  $sql2 = "
                                                        INSERT INTO 
                                        `ctrl_notasbachillerato` 
                                    SET 
                                         `nbch_act1` = '0',
                                        `nbch_act2` = '0',
                                        `nbch_act3` = '0',
                                        `nbch_actprom` = '0',
                                        `nbch_auto` = '0',
                                        `nbch_hetero` = '0',
                                        `nbch_promedio` = '0',
                                        `nbch_prbobjetiva` = '0',
                                        `nbch_prbobjetiva_prom` = '0',
                                        `nbch_promedio_final` = '0',
                                        `alumn_code` = '{$_GET["ida"]}',
                                        `id_mat` = '{$mats[$o]["id_materia"]}', 
                                        `id_gra` = '{$_GET['idg']}', 
                                        `nbch_periodo` = '{$periods[$i]["nbch_periodo"]}', 
                                        `nbch_fecha` = '{$_GET['year']}',
                                        `observ` = ' '
                                    ";
                                    $this->obj->Query($this->db, $sql2);   
                            endfor;
                         endfor;
                         
		    break;
    	}
        
        echo "<script type='text/javascript'>location.replace('alumnos_list.php');</script>";

    }
    
       

}

?>
