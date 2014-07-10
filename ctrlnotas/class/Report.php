<?php

class Reports {

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
    
    public function getAlumxGraxNotas($id) {
        $year	= date("Y");
        $sql = "SELECT  `id_alumn` As `id`, `alumn_code` As `code`, `alumn_nomb` As `nombre`, `alumn_apell` As `apellido` FROM `ctrl_alumnos` WHERE `cod_grado` = '{$id}' AND `matricula` = '{$year}' ORDER BY `alumn_apell` ASC  ";
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getAlumxGraxNotas2($id, $year) {
        $sql = "SELECT  `id_alumn` As `id`, `alumn_code` As `code`, `alumn_nomb` As `nombre`, `alumn_apell` As `apellido` FROM `ctrl_alumnos` WHERE `cod_grado` = '{$id}' AND `matricula` = '{$year}'  ORDER BY `alumn_apell` ASC ";
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getAlumxGra($opt, $mt_id, $gr_id, $pe_id, $year){
    	
    	$sql	= "";
    	
    	switch($opt){
    		case "primaria":
    			//Primaria
		    	$sql	=	"SELECT
		    				a.id_alumn As id, a.alumn_code As code, a.alumn_nomb As nombre, a.alumn_apell as apellido, n.observ As observacion,
		    				n.ntpr_act1 As ac1, n.ntpr_act2 As ac2, n.ntpr_act3 As ac3, n.ntpr_actprom As acPr, n.ntpr_examen As exam,
		    				n.ntpr_examen_pro As exampro, n.ntpr_promedio As promedio,
		    				m.id_mat As idm
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notasprimaria n
		    				ON a.id_alumn = n.id_alumn
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				m.id_mat = '{$mt_id}' AND  n.id_gra = '{$gr_id}' 
		    				AND n.ntpr_periodo = '{$pe_id}' AND n.ntpr_fecha = '{$year}'
		    			ORDER BY a.alumn_apell ASC 
                                                ";
		    			break;
		    			
		 case "secundaria":
		 	//Secundaria
		    	$sql	=	"SELECT
		    				a.id_alumn As id, a.alumn_code As code, a.alumn_nomb As nombre, a.alumn_apell as apellido, n.observ As observacion,
		    				n.ntscn_act1 As ac1, n.ntscn_act2 As ac2, n.ntscn_act3 As ac3, n.ntscn_act_prom As acPr, 
		    				n.ntscn_auto As auto, n.ntscn_hetero As hetero, 
		    				n.ntscn_evaluacion_prom As eval, n.ntscn_prueba_obj As probj, 
		    				n.ntscn_prueba_obj_prom As probjp, n.ntscn_promedio As promedio, m.id_mat As idm
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notassecundaria n
		    				ON a.id_alumn = n.alumn_code
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				m.id_mat = '{$mt_id}' AND  n.id_grad = '{$gr_id}' 
		    				AND n.ntscn_periodo = '{$pe_id}' AND n.ntscn_fecha = '{$year}'
                                        ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
		    			
		case "Bachillerato":
			//Bachillerato
		    	$sql	=	"SELECT
		    				a.id_alumn As id, a.alumn_code As code, a.alumn_nomb As nombre, a.alumn_apell as apellido, a.matricula As matricula, n.observ As observacion,
		    				n.nbch_act1 As ac1, n.nbch_act2 As ac2, n.nbch_act3 As ac3, n.nbch_actprom As acPr, 
		    				n.nbch_auto As auto, n.nbch_hetero As hetero, 
		    				n.nbch_promedio As eval, n.nbch_prbobjetiva As probj, n.nbch_prbobjetiva_prom As probjp, 
		    				n.nbch_promedio_final As promedio, m.id_mat As idm
		    			FROM 
		    				ctrl_alumnos a
		    			INNER JOIN ctrl_notasbachillerato n
		    				ON a.id_alumn = n.alumn_code
		    			INNER JOIN ctrl_materias m
		    				ON m.id_mat = n.id_mat
		    			WHERE 
		    				m.id_mat = '{$mt_id}' AND  n.id_gra = '{$gr_id}' 
		    				AND n.nbch_periodo = '{$pe_id}' AND n.nbch_fecha = '{$year}'
                                        ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
    	}  	
    	
    	
    			
    	
    	$stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
        
    }
    
    public function boletanotasprim($id){
      //Boleta notas primeria
	$sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, 
			d.dcnt_nom As Nombre_docente, d.dcnt_ape As Apellido_docente, 
			g.nombre_gra As Nombre_grado, 
			m.nombre_mat As Nombre_materia, m.id_mat As IDM,
			n.ntpr_act1 As Act1, n.ntpr_act2 As Act2, n.ntpr_act3 As Act3, n.ntpr_actprom As PO, 
			n.ntpr_examen As Exam, n.ntpr_examen_pro As Promedio_exam, n.ntpr_promedio As Promedio_total
		FROM
			ctrl_alumnos a
			INNER JOIN ctrl_grados g
				ON a.cod_grado = g.id_gra
			INNER JOIN ctrl_doc2grado dg
				ON g.id_gra = dg.id_gra
			INNER JOIN ctrl_docentes d
				ON d.dcnt_id = dg.dcnt_id
			INNER JOIN ctrl_doc2materia dm
				ON d.dcnt_id = dm.dcnt_id
			INNER JOIN ctrl_materias m
                                ON m.id_mat = dm.id_mat
                        INNER JOIN ctrl_notasprimaria n
				ON a.id_alumn = n.id_alumn 
                        
                        WHERE 
                                m.id_mat = n.id_mat 
                        AND 
                                g.id_gra = n.id_gra 
                        AND 
                                a.id_alumn = '{$id}'
                        AND
                                n.ntpr_periodo = '{$_GET['period']}'
                        AND
                                n.ntpr_fecha = '{$_GET['year']}'
                        GROUP BY 
                                m.id_mat";
        
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function boletanotassecond($id){
      //Boleta notas primeria
	$sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, 
			d.dcnt_nom As Nombre_docente, d.dcnt_ape As Apellido_docente, 
			g.nombre_gra As Nombre_grado, 
			m.nombre_mat As Nombre_materia, m.id_mat As IDM,
			n.ntscn_act1 As Act1, n.ntscn_act2 As Act2, n.ntscn_act3 As Act3, n.ntscn_act_prom As PO, 
			n.ntscn_auto As Autoe, n.ntscn_hetero As heteroe, n.ntscn_evaluacion_prom As POE,
			n.ntscn_prueba_obj As POB, n.ntscn_prueba_obj_prom As POBP, n.ntscn_promedio  As Promedio_total
		FROM
			ctrl_alumnos a
			INNER JOIN ctrl_grados g
				ON a.cod_grado = g.id_gra
			INNER JOIN ctrl_doc2grado dg
				ON g.id_gra = dg.id_gra
			INNER JOIN ctrl_docentes d
				ON d.dcnt_id = dg.dcnt_id
			INNER JOIN ctrl_doc2materia dm
				ON d.dcnt_id = dm.dcnt_id
			INNER JOIN ctrl_materias m
                                ON m.id_mat = dm.id_mat
                        INNER JOIN ctrl_notassecundaria n
				ON a.id_alumn = n.alumn_code
                        
                        WHERE 
                                m.id_mat = n.id_mat 
                        AND 
                                g.id_gra = n.id_grad 
                        AND 
                                a.id_alumn = '{$id}' 
                        AND
                                n.ntscn_periodo = '{$_GET['period']}'
                        AND
                                n.ntscn_fecha = '{$_GET['year']}'
                        GROUP BY 
                                m.id_mat";
        
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function boletanotasbach($id){
      //Boleta notas primeria
	$sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, 
			d.dcnt_nom As Nombre_docente, d.dcnt_ape As Apellido_docente, 
			g.nombre_gra As Nombre_grado, 
			m.nombre_mat As Nombre_materia, m.id_mat As IDM,
			n.nbch_act1 As Act1, n.nbch_act2 As Act2, n.nbch_act3 As Act3, n.nbch_actprom As PO, 
			n.nbch_auto As Autoe, n.nbch_hetero As heteroe, n.nbch_promedio As POE,
			n.nbch_prbobjetiva As POB, n.nbch_prbobjetiva_prom As POBP, n.nbch_promedio_final As Promedio_total
		FROM
			ctrl_alumnos a
			INNER JOIN ctrl_grados g
				ON a.cod_grado = g.id_gra
			INNER JOIN ctrl_doc2grado dg
				ON g.id_gra = dg.id_gra
			INNER JOIN ctrl_docentes d
				ON d.dcnt_id = dg.dcnt_id
			INNER JOIN ctrl_doc2materia dm
				ON d.dcnt_id = dm.dcnt_id
			INNER JOIN ctrl_materias m
                                ON m.id_mat = dm.id_mat
                        INNER JOIN ctrl_notasbachillerato n
				ON a.id_alumn = n.alumn_code 
                        
                        WHERE 
                                m.id_mat = n.id_mat 
                        AND 
                                g.id_gra = n.id_gra 
                        AND 
                                a.id_alumn = '{$id}'
                        AND
                                n.nbch_periodo = '{$_GET['period']}'
                        AND
                                n.nbch_fecha = '{$_GET['year']}'
                        GROUP BY 
                                m.id_mat";
        
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function getPpri($id, $idm, $per, $fech){
        
        $sql = "SELECT
                        n.ntpr_promedio As Promedio 
                FROM
                        ctrl_notasprimaria n
                WHERE
                        n.id_alumn = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.ntpr_periodo = '{$per}'
                AND
                        n.ntpr_fecha = '{$fech}'";
                        
        $stmt   = $this->obj->Query($this->db, $sql);
        $result = $this->obj->fetchAssoc($stmt);
        return (count($result)>0)?$result[0]['Promedio']:0;
        
    }
    
    public function getPpriFinal($id, $idm, $fech){
        
        $sql = "SELECT
                        n.ntpr_promedio As Promedio 
                FROM
                        ctrl_notasprimaria n
                WHERE
                        n.id_alumn = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.ntpr_fecha = '{$fech}'";
                        
		$stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
        
    }
    
    public function getPSec($id, $idm, $per, $fech){
        
        $sql = "SELECT
                        n.ntscn_promedio As Promedio 
                FROM
                        ctrl_notassecundaria n
                WHERE
                        n.alumn_code = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.ntscn_periodo= '{$per}'
                AND
                        n.ntscn_fecha = '{$fech}'";
                        
        $stmt   = $this->obj->Query($this->db, $sql);
        $result = $this->obj->fetchAssoc($stmt);
        return (count($result)>0)?$result[0]['Promedio']:0;
        
    }
    
     public function getPSecFinal($id, $idm, $fech){
        
        $sql = "SELECT
                        n.ntscn_promedio As Promedio 
                FROM
                        ctrl_notassecundaria n
                WHERE
                        n.alumn_code = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.ntscn_fecha = '{$fech}'";
                        
                       
		$stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
        
    }
    
    
    
    public function getPBach($id, $idm, $per, $fech){
        
        $sql = "SELECT
                        n.nbch_promedio_final As Promedio 
                FROM
                        ctrl_notasbachillerato n
                WHERE
                        n.alumn_code = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.nbch_periodo= '{$per}'
                AND
                        n.nbch_fecha = '{$fech}'";
                        
        $stmt   = $this->obj->Query($this->db, $sql);
        $result = $this->obj->fetchAssoc($stmt);
        return (count($result)>0)?$result[0]['Promedio']:0;
        
    }
    
     public function getPBachFinal($id, $idm, $fech){
        
        $sql = "SELECT
                        n.nbch_promedio_final As Promedio 
                FROM
                        ctrl_notasbachillerato n
                WHERE
                        n.alumn_code = '{$id}'
                AND
                        n.id_mat = '{$idm}'
                AND
                        n.nbch_fecha = '{$fech}'";
                        
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
        
    }
}
?>
