<?php
class GenericaA {

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
    
    public function getNotes($opt) {
         switch ($opt):
            case 'primaria':
                $grado = "Reporte de primera";
                $sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, n.observ As observacion,
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
                                a.id_alumn = '{$_SESSION['sys_alumno_id']}'
                        AND
                                n.ntpr_periodo = '{$_POST['periodo']}'
                        AND
                                n.ntpr_fecha = '{$_POST['anio']}'
                        GROUP BY 
                                m.id_mat";
                break;
            case 'secundaria':
                $grado = "Reporte de Secundaria";
                $sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, n.observ As observacion,
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
                                a.id_alumn = '{$_SESSION['sys_alumno_id']}' 
                        AND
                                n.ntscn_periodo = '{$_POST['periodo']}'
                        AND
                                n.ntscn_fecha = '{$_POST['anio']}'
                        GROUP BY 
                                m.id_mat";
                break;
            case 'Bachillerato':
                $grado = "Reporte de Bachillerato";
                $sql = "SELECT 
			a.alumn_code As Codigo_alumno, a.alumn_nomb As Nombre_alumno, a.alumn_apell As Apellido_alumno, n.observ As observacion,
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
                                a.id_alumn = '{$_SESSION['sys_alumno_id']}'
                        AND
                                n.nbch_periodo = '{$_POST['periodo']}'
                        AND
                                n.nbch_fecha = '{$_POST['anio']}'
                        GROUP BY 
                                m.id_mat";
        
       
                break;
        endswitch;

         $stmt 	= $this->obj->Query($this->db, $sql); 
        return $this->obj->fetchAssoc($stmt);
    }
}
    
?>
