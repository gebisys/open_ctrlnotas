<?php
class Generica {

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
    
    public function getMats($id) {
    	$sql 	= "SELECT m.id_mat As idm, m.nombre_mat As nombrem,
    			d.dcnt_id As idd
    		   FROM ctrl_materias m
    		   INNER JOIN ctrl_doc2materia dm
    		   	ON m.id_mat = dm.id_mat
    		   INNER JOIN ctrl_docentes d
    		   	ON d.dcnt_id = dm.dcnt_id
    		   WHERE d.dcnt_id='{$id}' GROUP BY m.id_mat";
    		   
    	$stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function enabledPeriod(){
    	$sql	= 	"SELECT 
    				prdo_id As idp, 
    				prdo_nom As nombrep, 
    				prdo_status As status 
    			FROM ctrl_periodos
    			WHERE prdo_status = 1";
    			
    	$stmt	= $this->obj->Query($this->db, $sql);
    	return $this->obj->fetchAssoc($stmt); 
    }
    
    public function getAlumxGra(){
    	
    	$year	= date("Y");
    	$sql	= "";
    	
    	switch($_SESSION["sys_glv"]){
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
		    				m.id_mat = '{$_SESSION['sys_mt_id']}' AND  n.id_gra = '{$_SESSION['sys_gr_id']}' 
		    				AND n.ntpr_periodo = '{$_SESSION['sys_pe']}' AND n.ntpr_fecha = '{$year}'
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
		    				m.id_mat = '{$_SESSION['sys_mt_id']}' AND  n.id_grad = '{$_SESSION['sys_gr_id']}' 
		    				AND n.ntscn_periodo = '{$_SESSION['sys_pe']}' AND n.ntscn_fecha = '{$year}'
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
		    				m.id_mat = '{$_SESSION['sys_mt_id']}' AND  n.id_gra = '{$_SESSION['sys_gr_id']}' 
		    				AND n.nbch_periodo = '{$_SESSION['sys_pe']}' AND n.nbch_fecha = '{$year}'
		    			 ORDER BY a.alumn_apell ASC 
		    			";
		    			break;
    	}
    	
    	
    	
    			
    	
    	$stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
        
    }
    
    
    public function getAlumxGraxNotas() {
        $year	= date("Y");
        $sql = "SELECT  `id_alumn` As `id`, `alumn_code` As `code`, `alumn_nomb` As `nombre`, `alumn_apell` As `apellido` FROM `ctrl_alumnos` WHERE `cod_grado` = '{$_SESSION['sys_gr_id']}' AND `matricula` = '{$year}'   ORDER BY alumn_apell ASC ";
        $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
    
    public function insertNotasBachi(){
        $year	= date("Y");
		$total = count($_POST["ida"]);
		$bandera = 0;
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact_nr =  ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5;
            $promact = number_format($promact_nr,'2', '.', ' ');
            #$promact = round( ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5, 1 );

            $auto = $_POST['auto'][$x];
            $hetero = $_POST['hete'][$x];
            $promauto_nr =  ( ( $auto + $hetero ) / 2 ) * 0.2;
            $promauto = number_format($promauto_nr,'2');
            #$promauto = round( ( ( $auto + $hetero ) / 2 ) * 0.2, 1 );

            $pobj = $_POST['pobj'][$x];
            $prompo_nr =  ( $pobj * 0.3 );
            $prompo = number_format($prompo_nr,'2');
            #$prompo = round( ( $pobj * 0.3 ), 1 );

            $promfinal = ($promact + $promauto + $prompo);
            $promfinal = number_format($promfinal,'2');
            $sql = "INSERT INTO 
                        `ctrl_notasbachillerato` 
                    SET 
                         `nbch_act1` = '{$act1}',
                        `nbch_act2` = '{$act2}',
                        `nbch_act3` = '{$act3}',
                        `nbch_actprom` = '{$promact}',
                        `nbch_auto` = '{$auto}',
                        `nbch_hetero` = '{$hetero}',
                        `nbch_promedio` = '{$promauto}',
                        `nbch_prbobjetiva` = '{$pobj}',
                        `nbch_prbobjetiva_prom` = '{$prompo}',
                        `nbch_promedio_final` = '{$promfinal}',
                        `alumn_code` = '{$_POST['ida'][$x]}',
                        `id_mat` = '{$_SESSION["sys_mt_id"]}', 
                        `id_gra` = '{$_SESSION["sys_gr_id"]}', 
                        `nbch_periodo` = '{$_SESSION["sys_pe"]}', 
                        `nbch_fecha` = '{$year}',
                        `observ` = '{$_POST['obser'][$x]}'
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
    public function updateNotasBachi(){
        $year	= date("Y");
	$total = count($_POST["ida"]);
	$bandera = 0;
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact_nr =  ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5;
            $promact = number_format($promact_nr,'2', '.', ' ');
            #$promact = round( ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5, 1 );

            $auto = $_POST['auto'][$x];
            $hetero = $_POST['hete'][$x];
            $promauto_nr =  ( ( $auto + $hetero ) / 2 ) * 0.2;
            $promauto = number_format($promauto_nr,'2');
            #$promauto = round( ( ( $auto + $hetero ) / 2 ) * 0.2, 1 );

            $pobj = $_POST['pobj'][$x];
            $prompo_nr =  ( $pobj * 0.3 );
            $prompo = number_format($prompo_nr,'2');
            #$prompo = round( ( $pobj * 0.3 ), 1 );

            $promfinal = ($promact + $promauto + $prompo);
            $promfinal = number_format($promfinal,'2');
            $sql = "UPDATE 
                        `ctrl_notasbachillerato` 
                    SET 
                        `nbch_act1` = '{$act1}',
                        `nbch_act2` = '{$act2}',
                        `nbch_act3` = '{$act3}',
                        `nbch_actprom` = '{$promact}',
                        `nbch_auto` = '{$auto}',
                        `nbch_hetero` = '{$hetero}',
                        `nbch_promedio` = '{$promauto}',
                        `nbch_prbobjetiva` = '{$pobj}',
                        `nbch_prbobjetiva_prom` = '{$prompo}',
                        `nbch_promedio_final` = '{$promfinal}',
                        `observ` = '{$_POST['obser'][$x]}'
                    WHERE
                        `alumn_code` = '{$_POST['ida'][$x]}'AND 
                        `id_mat` = '{$_SESSION["sys_mt_id"]}'AND 
                        `id_gra` = '{$_SESSION["sys_gr_id"]}'AND 
                        `nbch_periodo` = '{$_SESSION["sys_pe"]}'AND 
                        `nbch_fecha` = '{$year}'                            
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
    public function insertNotasSecu(){
        $year	= date("Y");
	$total = count($_POST["ida"]);
	$bandera = 0;
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact =  ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5;
			$promact = number_format($promact,'2', '.', ' ');
			
            $auto = $_POST['auto'][$x];
            $hetero = $_POST['hete'][$x];
            $promauto = ( ( $auto + $hetero ) / 2 ) * 0.2;
			$promauto = number_format($promauto,'2', '.', ' ');
			
            $pobj = $_POST['pobj'][$x];
            $prompo =  ( $pobj * 0.3 );
			$prompo = number_format($prompo,'2', '.', ' ');
			
            $promfinal = ($promact + $promauto + $prompo);
			$promfinal = number_format($promfinal,'2', '.', ' ');
			
            $sql = "INSERT INTO 
                        `ctrl_notassecundaria` 
                    SET 
                        `ntscn_act1` = '{$act1}',
                        `ntscn_act2` = '{$act2}',
                        `ntscn_act3` = '{$act3}',
                        `ntscn_act_prom` = '{$promact}',
                        `ntscn_auto` = '{$auto}',
                        `ntscn_hetero` = '{$hetero}',
                        `ntscn_evaluacion_prom` = '{$promauto}',
                        `ntscn_prueba_obj` = '{$pobj}',
                        `ntscn_prueba_obj_prom` = '{$prompo}',
                        `ntscn_promedio` = '{$promfinal}',
                        `alumn_code` = '{$_POST['ida'][$x]}',
                        `id_mat` = '{$_SESSION["sys_mt_id"]}', 
                        `id_grad` = '{$_SESSION["sys_gr_id"]}', 
                        `ntscn_periodo` = '{$_SESSION["sys_pe"]}', 
                        `ntscn_fecha` = '{$year}',
                        `observ` = '{$_POST['obser'][$x]}'
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
    public function updateNotasSecu(){
        $year	= date("Y");
	$total = count($_POST["ida"]);
	$bandera = 0;
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact =  ( ( $act1 + $act2 + $act3 ) / 3 ) * 0.5;
			$promact = number_format($promact,'2', '.', ' ');
			
            $auto = $_POST['auto'][$x];
            $hetero = $_POST['hete'][$x];
            $promauto = ( ( $auto + $hetero ) / 2 ) * 0.2;
			$promauto = number_format($promauto,'2', '.', ' ');
			
            $pobj = $_POST['pobj'][$x];
            $prompo =  ( $pobj * 0.3 );
			$prompo = number_format($prompo,'2', '.', ' ');
			
            $promfinal = ($promact + $promauto + $prompo);
			$promfinal = number_format($promfinal,'2', '.', ' ');
            
            $sql = "UPDATE 
                        `ctrl_notassecundaria` 
                    SET 
                        `ntscn_act1` = '{$act1}',
                        `ntscn_act2` = '{$act2}',
                        `ntscn_act3` = '{$act3}',
                        `ntscn_act_prom` = '{$promact}',
                        `ntscn_auto` = '{$auto}',
                        `ntscn_hetero` = '{$hetero}',
                        `ntscn_evaluacion_prom` = '{$promauto}',
                        `ntscn_prueba_obj` = '{$pobj}',
                        `ntscn_prueba_obj_prom` = '{$prompo}',
                        `ntscn_promedio` = '{$promfinal}',
                        `observ` = '{$_POST['obser'][$x]}'
                    WHERE
                         `alumn_code` = '{$_POST['ida'][$x]}' AND
                        `id_mat` = '{$_SESSION["sys_mt_id"]}' AND
                        `id_grad` = '{$_SESSION["sys_gr_id"]}' AND
                        `ntscn_periodo` = '{$_SESSION["sys_pe"]}' AND
                        `ntscn_fecha` = '{$year}'                            
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
    
    public function insertNotasPrima(){
        $year	= date("Y");
	$total = count($_POST["ida"]);
	$bandera = 0;
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact = ( ( ($act1 + $act2 + $act3) / 3 ) * 0.5 );
            $promact = number_format($promact,'2', '.', ' ');
			
            $exam = $_POST['exam'][$x];
            $promexam = round( ($exam * 0.5 ), 1 );
            $promexam = number_format($promexam,'2', '.', ' ');
			
            $promfinal = ($promact + $promexam); 
            $promfinal = number_format($promfinal,'2', '.', ' ');
			
            $sql = "INSERT INTO 
                        `ctrl_notasprimaria` 
                    SET 
                        `ntpr_act1` = '{$act1}',
                        `ntpr_act2` = '{$act2}',
                        `ntpr_act3` = '{$act3}',
                        `ntpr_actprom` = '{$promact}',
                        `ntpr_examen` = '{$exam}',
                        `ntpr_examen_pro` = '{$promexam}',
                        `ntpr_promedio` = '{$promfinal}',
                        `id_alumn` = '{$_POST['ida'][$x]}',
                        `id_mat` = '{$_SESSION["sys_mt_id"]}', 
                        `id_gra` = '{$_SESSION["sys_gr_id"]}', 
                        `ntpr_periodo` = '{$_SESSION["sys_pe"]}', 
                        `ntpr_fecha` = '{$year}',
                        `observ` = '{$_POST['obser'][$x]}'
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
    public function updateNotasPrima(){
        $year	= date("Y");
	$total = count($_POST["ida"]);
	$bandera = 0;
        
        for ($x = 0; $x < count($_POST['ida']); $x++){
            $act1 = $_POST['act1'][$x];
            $act2 = $_POST['act2'][$x];
            $act3 = $_POST['act3'][$x];
            $promact = ( ( ($act1 + $act2 + $act3) / 3 ) * 0.5 );
            $promact = number_format($promact,'2', '.', ' ');
			
            $exam = $_POST['exam'][$x];
            $promexam = round( ($exam * 0.5 ), 1 );
            $promexam = number_format($promexam,'2', '.', ' ');
			
            $promfinal = ($promact + $promexam); 
            $promfinal = number_format($promfinal,'2', '.', ' ');
            $sql = "UPDATE 
                        `ctrl_notasprimaria` 
                    SET 
                        `ntpr_act1` = '{$act1}',
                        `ntpr_act2` = '{$act2}',
                        `ntpr_act3` = '{$act3}',
                        `ntpr_actprom` = '{$promact}',
                        `ntpr_examen` = '{$exam}',
                        `ntpr_examen_pro` = '{$promexam}',
                        `ntpr_promedio` = '{$promfinal}',
                        `observ` = '{$_POST['obser'][$x]}'
                    WHERE
                        `id_alumn` = '{$_POST['ida'][$x]}' AND
                        `id_mat` = '{$_SESSION["sys_mt_id"]}' AND 
                        `id_gra` = '{$_SESSION["sys_gr_id"]}' AND
                        `ntpr_periodo` = '{$_SESSION["sys_pe"]}' AND 
                        `ntpr_fecha` = '{$year}'                             
                    ";
            $this->obj->Query($this->db, $sql);
            if($bandera == $total){
                    break;
            }
            $bandera ++;
        }
    }
    
}
?>
