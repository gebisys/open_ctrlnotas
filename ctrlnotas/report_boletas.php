<?php

include_once "includes/config.php";
include_once "fpdf/fpdf.php";
include_once 'class/Report.php';

$objReport = new Reports($db);
$objGeneric = new Generic($db);
$nameg = $objGeneric->getNameGrade($_GET['grade']);

if ($_GET['period'] == 1) {
    $pperiod = "PRIMER PERIODO";
} elseif ($_GET['period'] == 2) {
    $pperiod = "SEGUNDO PERIODO";
} elseif ($_GET['period'] == 3) {
    $pperiod = "TERCER PERIODO";
} elseif ($_GET['period'] == 4) {
    $pperiod = "CUARTO PERIODO";
}

class PDF extends FPDF {

    public function boletaP($obj, $nom_grade, $periodo) {
        
        $alumn = $obj->getAlumxGraxNotas2($_GET['grade'], $_GET['year']);
        
        //Acumuladores
        $paf = 0;
        $pbf = 0;
        $pcf = 0;
        $ppftotal = 0;
		$aprov = 0;
		$reprov = 0;
        
        /*Definiendo Docentes Guias Esto es Temporal */
        
        if ($_GET['grade'] ==1) {$docente = "Zoila Abigaíl Hernández  Franco";}
        if ($_GET['grade'] ==2) {$docente = "Vilma Elizabeth Cortez Hernández"; }
        if ($_GET['grade'] ==3) {$docente = "Yamileth Lourdes Alvarenga Amaya";}
        if ($_GET['grade'] ==4) {$docente = "Angela de la Paz Martínez de Aguilar";}
        if ($_GET['grade'] ==5) {$docente = "Hilda Gutierrez de Portillo"; }
        if ($_GET['grade'] ==6) {$docente = "Yanira Patricia Portillo de Hernández"; }
        
        if (count($alumn) > 0) {
            $boleta = 1;
            for ($x = 0; $x < count($alumn); $x++):
                $this->SetMargins(20, 10);
                $this->Rect(15, 9, 190, 120, 'D');
                $this->Image('images/logo.jpg', 170, 10, 22);

                $this->SetFont('Arial', '', 9);
                $this->Ln();
                $this->Cell(0, 5, 'AA', 0, 0, 'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Ln();
                $this->Cell(0, 5, utf8_decode(COMPANY), 0, 0, 'C');
                $this->Ln();
                $this->Cell(0, 5, utf8_decode('BOLETA DE NOTAS PERIODO : ' . $_GET['period']), 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '');
                $this->Cell(15, 4, 'Alumna :');
                $this->Cell(60, 4, utf8_decode($alumn[$x]["nombre"]) . ' ' . utf8_decode($alumn[$x]["apellido"]));
                $this->Ln();
                $this->Cell(15, 4, 'Grado :');

                $this->Cell(20, 4, utf8_decode($nom_grade));
                $this->Ln();
                $this->Cell(15, 4, 'Docente :');
                $this->Cell(60, 4, utf8_decode($docente));
                $this->Ln();

                $this->SetFillColor(232, 232, 232);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(60);
                $this->Cell(80, 4, $periodo, 0, 0, 'C', 1);
                $this->Ln(4);


                $this->Cell(60, 8, 'ASIGNATURA', 1, 0, 'C', 1);
                $this->Cell(40, 4, 'ACTIVIDAD', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P.O', 1, 0, 'C', 1);
                $this->Cell(20, 8, 'Promedio', 1, 0, 'C', 1);
                $this->Cell(40, 4, 'N. Anteriores', 1, 0, 'C', 1);
                $this->Ln();
                $this->Cell(60, 4, '', 0, 0, 'L');
                $this->Cell(10, 4, 'Act1', 1, 0, 'C', 1);
                $this->Cell(10, 4, 'Act2', 1, 0, 'C', 1);
                $this->Cell(10, 4, 'Act3', 1, 0, 'C', 1);
                $this->Cell(10, 4, '50%', 1, 0, 'C', 1);
                $this->Cell(10, 4, 'Exam', 1, 0, 'C', 1);
                $this->Cell(10, 4, '50%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '', 0, 0, 'C');
                
                switch($_GET['period']):
                    case '1':
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '2':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '3':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '4':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        break;
                endswitch;
                
                $this->Cell(10, 4, 'NF', 1, 0, 'C', 1);
                $this->Ln();
                $this->SetFillColor(255, 255, 255);
                $this->SetFont('Arial', '', 9);
                $w = array(9, 60, 10, 20);
                $nota_mat = $obj->boletanotasprim($alumn[$x]["id"]);
                $n = 0;
                $prom_mats = 0;
                if (count($nota_mat) > 0) {
                    for ($i = 0; $i < count($nota_mat); $i++):
                        $this->Cell($w[1], 4, ucwords(strtolower(utf8_decode($nota_mat[$i]['Nombre_materia']))), 1);
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['Act1']), 1, 0, 'C');
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['Act2']), 1, 0, 'C');
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['Act3']), 1, 0, 'C');
                        $this->SetFont('Arial', 'B', 9);
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['PO']), 1, 0, 'C');
                        $this->SetFont('Arial', '', 9);
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['Exam']), 1, 0, 'C');
                        $this->SetFont('Arial', 'B', 9);
                        $this->Cell($w[2], 4, sprintf("%.1F",$nota_mat[$i]['Promedio_exam']), 1, 0, 'C');
                        $this->Cell($w[3], 4, sprintf("%.1F",$nota_mat[$i]['Promedio_total']), 1, 0, 'C');
                        $this->SetFont('Arial', '', 9);
                        $a = 0; $b = 0; $c = 0;
                        switch($_GET['period']):
                            case '1':
                                $a = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $b = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $c = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                            case '2':
                                $a = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $c = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                            case '3':
                                $a = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $c = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                            case '4':
                                $a = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $c = ($obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPpri($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                        endswitch;
                        if($nota_mat[$i]['Promedio_total'] >= 7):	$aprov ++; else: $reprov ++; endif;
						$paf += sprintf("%.1F",$a); $pbf += sprintf("%.1F",$b); $pcf += sprintf("%.1F",$c); 
                        $pftotal = (($nota_mat[$i]['Promedio_total']+sprintf("%.1F",$a)+sprintf("%.1F",$b)+sprintf("%.1F",$c)) / 4);
                        
                        $ppftotal += $pftotal;
                        //$this->Cell($w[2], 4, sprintf("%.1F",$pftotal), 1, 0, 'C');//muesta los datos exactos
                        $this->Cell($w[2], 4, round(number_format($pftotal,1)), 1, 0, 'C');//muesta los datos redondeados                       
                        $this->Ln();
                        $n++;
                        $prom_mats += $nota_mat[$i]['Promedio_total'];
                    endfor;
                } else {
                    $this->SetFont('Arial', '', 16);
                    $this->Ln(20);
                    $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
                    $this->Cell(0, 5, 'N', 1, 0, 'R');
                    $this->SetFont('Arial', '', 9);
                }
                $this->SetFillColor(232, 232, 232);
                
				$this->Cell(100,4,'MATERIAS :'. $n .' '. ' APROBADAS: '.$aprov.' REPROBADAS: '.$reprov ,1,0,'L',1);
                $this->Cell(20, 4, 'PROMEDIOS', 1, 0, 'C', 1);
                
                //Promedios
                $prom_matsF = $prom_mats / $n;
                $paf        = $paf / $n;
                $pbf        = $pbf / $n;
                $pcf        = $pcf / $n;
                $ppftotal   = $ppftotal / $n;
                
                $this->Cell(20, 4, sprintf("%.1F",$prom_matsF), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$paf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pbf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pcf), 1, 0, 'C');
                //$this->Cell(10, 4, sprintf("%.1F",$ppftotal), 1, 0, 'C'); // dato exacto
                $this->Cell(10, 4, round(number_format($ppftotal,1)), 1, 0, 'C'); // dato redondeado
                $this->Ln(10);

                $this->SetFont('Arial', 'I', 9);
                $this->Cell(50, 6, '_____________________________', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 6, '_____________________________', 0, 0, 'C');
                $this->Ln();
                $this->Cell(50, 6, 'Direccion', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 6, 'Registro Academico', 0, 0, 'C');
                if (($boleta / 2) == 0) {
                    $this->Ln();
                    $this->AddPage();
                } else {
                    if($n === 13) {$this->Ln(20);}else{  $this->Ln(15);}
                    $this->Rect(15, 142, 190, 120, 'D');
                    $this->Image('images/logo.jpg', 170, 144, 22);
                }
                $boleta++;
                $aprov = 0;
                $reprov = 0;
				$paf = 0;
				$pbf = 0;
				$pcf = 0;
            endfor;
        } else {
            $this->SetFont('Arial', '', 16);
            $this->Ln(20);
            $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
            $this->Cell(0, 5, 'N', 1, 0, 'R');
            $this->SetFont('Arial', '', 9);
        }
    }
    
    public function boletaS($obj, $nom_grade, $periodo) {
        
        $alumn = $obj->getAlumxGraxNotas2($_GET['grade'], $_GET['year']);
        
        /* Definiendo Docentes guias esto es Temporal */
        if ($_GET['grade'] ==7) {$docente = "Kathy  Melany Guardado Rivas";}
        if ($_GET['grade'] ==8) {$docente = "Kenia Magali Perla Romero"; }
        if ($_GET['grade'] ==9) {$docente = "Nury Janet Ríos de Cortez"; }
        
        //Acumuladores
        $paf = 0;
        $pbf = 0;
        $pcf = 0;
        $ppftotal = 0;
        $aprov = 0;
        $reprov = 0;
        
        if (count($alumn) > 0) {
            $boleta = 1;
            for ($x = 0; $x < count($alumn); $x++):
                $this->SetMargins(20, 10);
                $this->Rect(15, 9, 190, 118, 'D');
                $this->Image('images/logo.jpg', 170, 10, 22);

                $this->SetFont('Arial', '', 9);
                $this->Ln();
                $this->Cell(0, 5, 'TODO POR LA GLORIA DE JESUS MARIA Y JOSE', 0, 0, 'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Ln();
                $this->Cell(0, 5, utf8_decode('COLEGIO JOSEFINO NUESTRA SEÑORA DE LA PAZ'), 0, 0, 'C');
                $this->Ln();
                $this->Cell(0, 5, utf8_decode('BOLETA DE NOTAS PERIODO : ' . $_GET['period']), 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '');
                $this->Cell(15, 4, 'Alumna :');
                $this->Cell(60, 4, utf8_decode($alumn[$x]["nombre"]) .  ' ' . utf8_decode($alumn[$x]["apellido"]));
                $this->Ln();
                $this->Cell(15, 4, 'Grado :');

                $this->Cell(20, 4, utf8_decode($nom_grade));
                $this->Ln();
                $this->Cell(15, 4, 'Docente :');
                $this->Cell(60, 4, utf8_decode($docente));
                $this->Ln();

                $this->SetFillColor(232, 232, 232);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(60);
                $this->Cell(80, 4, $periodo, 0, 0, 'C', 1);
                $this->Ln(4);


                $this->Cell(60, 8, 'ASIGNATURA', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P1A', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P2A', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P.O', 1, 0, 'C', 1);
              
                $this->Cell(20, 8, 'Promedio', 1, 0, 'C', 1);
                $this->Cell(40, 4, 'N. Anteriores', 1, 0, 'C', 1);
                $this->Ln();
                $this->Cell(60, 4, '', 0, 0, 'L');
                $this->Cell(20, 4, '50%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '20%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '30%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '', 0, 0, 'C');
                switch($_GET['period']):
                    case '1':
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '2':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '3':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '4':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        break;
                endswitch;
                $this->Cell(10, 4, 'NF', 1, 0, 'C', 1);
                $this->Ln();
                $this->SetFillColor(255, 255, 255);
                $this->SetFont('Arial', '', 9);
                $w = array(9, 60, 10, 20);
                $nota_mat = $obj->boletanotassecond($alumn[$x]["id"]);
                $n = 0;
                $prom_mats = 0;
                if (count($nota_mat) > 0) {
                    for ($i = 0; $i < count($nota_mat); $i++):
                        $this->Cell($w[1], 4, ucwords(strtolower(utf8_decode($nota_mat[$i]['Nombre_materia']))), 1);
                        
                        $a = 0; $b = 0; $c = 0; $d = 0;
                        if($nota_mat[$i]['IDM'] == 15){
                            
                            $a = convert($nota_mat[$i]['PO']); #50%
                            $b = convert_20($nota_mat[$i]['POE']);#20%
                            $c = convert_30($nota_mat[$i]['POBP']);#30%
                            $d = convert_dos($nota_mat[$i]['Promedio_total']);
                            $promedioIDM15 = $nota_mat[$i]['Promedio_total'];
                        } else {
                            
                            $a = sprintf("%.1F",$nota_mat[$i]['PO']);
                            $b = sprintf("%.1F",$nota_mat[$i]['POE']);
                            $c = sprintf("%.1F",$nota_mat[$i]['POBP']);
                            $d = sprintf("%.1F",$nota_mat[$i]['Promedio_total']);
                        }
                        $this->Cell($w[3], 4, $a, 1, 0, 'C');
                        $this->Cell($w[3], 4, $b, 1, 0, 'C');
                        $this->Cell($w[3], 4, $c, 1, 0, 'C');                        
                        $this->Cell($w[3], 4, $d, 1, 0, 'C');
                        $this->SetFont('Arial', '', 9);
                        $a = 0; $b = 0; $c = 0;
                        switch($_GET['period']):
                            case '1':
                                if($nota_mat[$i]['IDM'] == 15){
                                    
                                    $pa = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                    $pb = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                    $pc = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                    
                                    
                                    $a  = ($pa > 0) ? convert_dos($pa) : 0;
                                    $b  = ($pb > 0) ? convert_dos($pb) : 0;
                                    $c  = ($pc > 0) ? convert_dos($pc) : 0;
                                    
                                } else{
                                    
                                    $a = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']));
                                    $b = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']));
                                    $c = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']));
                                    
                                }
                                
                                $this->Cell($w[2], 4, $a, 1, 0, 'C');
                                $this->Cell($w[2], 4, $b, 1, 0, 'C');
                                $this->Cell($w[2], 4, $c, 1, 0, 'C');
                                break;
                                
                            case '2':
                                if($nota_mat[$i]['IDM'] == 15){
                                    
                                    $pa = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                    $pb = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                    $pc = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                    
                                    $a  = ($pa > 0) ? convert_dos($pa) : 0;
                                    $b  = ($pb > 0) ? convert_dos($pb) : 0;
                                    $c  = ($pc > 0) ? convert_dos($pc) : 0;
                                    
                                } else {
                                    
                                     $a = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']));
                                     $b = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']));
                                     $c = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']));
                                    
                                }
                                
                                $this->Cell($w[2], 4, $a, 1, 0, 'C');
                                $this->Cell($w[2], 4, $b, 1, 0, 'C');
                                $this->Cell($w[2], 4, $c, 1, 0, 'C');
                                
                                break;
                                
                                
                            case '3':
                                
                                 if($nota_mat[$i]['IDM'] == 15){
                                     
                                    $pa = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                    $pb = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                    $pc = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                     
                                    $a  = ($pa > 0) ? convert_dos($pa) : 0;
                                    $b  = ($pb > 0) ? convert_dos($pb) : 0;
                                    $c  = ($pc > 0) ? convert_dos($pc) : 0;
                                     
                                 } else {
                                    $a = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']));
                                    $b = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']));
                                    $c = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']));
                                 }
                                 
                                $this->Cell($w[2], 4, $a, 1, 0, 'C');
                                $this->Cell($w[2], 4, $b, 1, 0, 'C');
                                $this->Cell($w[2], 4, $c, 1, 0, 'C');
                                
                                break;
                                
                            case '4':
                                if($nota_mat[$i]['IDM'] == 15){
                                    $pa = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                    $pb = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                    $pc = ($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                    
                                    $a  = ($pa > 0) ? convert_dos($pa) : 0;
                                    $b  = ($pb > 0) ? convert_dos($pb) : 0;
                                    $c  = ($pc > 0) ? convert_dos($pc) : 0;
                                } else {
                                    $a = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']));
                                    $b = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']));
                                    $c = sprintf("%.1F",($obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPSec($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']));
                                }
                                $this->Cell($w[2], 4, $a, 1, 0, 'C');
                                $this->Cell($w[2], 4, $b, 1, 0, 'C');
                                $this->Cell($w[2], 4, $c, 1, 0, 'C');
                                break;
                        endswitch;
                        if($nota_mat[$i]['Promedio_total'] >= 7): $aprov ++; else: $reprov ++; endif;
                        
                        $paf += sprintf("%.1F",$a); $pbf += sprintf("%.1F",$b); $pcf += sprintf("%.1F",$c); 
                        $pftotal = (($nota_mat[$i]['Promedio_total']+sprintf("%.1F",$a)+sprintf("%.1F",$b)+sprintf("%.1F",$c)) / 4);
                        
                        // fin materia valores $pftotaltemp = ($nota_mat[$i]['IDM'] == 15) ? convert_dos($pftotal) : sprintf("%.1F",$pftotal);
                        
                        if($nota_mat[$i]['IDM'] == 15){
                            $pftotaltemp = (($nota_mat[$i]['Promedio_total']+sprintf("%.1F",$pa)+sprintf("%.1F",$pb)+sprintf("%.1F",$pc)) / 4);
                        }
                        $ppftotal += $pftotal;
                        //$this->Cell($w[2], 4, $pftotaltemp, 1, 0, 'C'); //muestra datos exactos
                       // $this->Cell($w[2], 4, round(number_format($pftotaltemp,1)), 1, 0, 'C'); //muestra datos redondeados
                        /**
                         * FIX PARA QUE NO IMPRIMA LA MATERIA DE VALORES
                         */
                        if($nota_mat[$i]['IDM'] == 15){
                            $this->Cell($w[2], 4, convert_dos(round(number_format($pftotaltemp))), 1, 0, 'C');
                        }else{
                            $this->Cell($w[2], 4, round(number_format($pftotal,1)), 1, 0, 'C'); 
                        }
                        $this->Ln();
                        
                        if ($nota_mat[$i]['IDM'] != 15) $n++;
                        
                        $prom_mats += $nota_mat[$i]['Promedio_total'];
                    endfor;
                } else {
                    $this->SetFont('Arial', '', 16);
                    $this->Ln(20);
                    $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
                    $this->Cell(0, 5, 'N', 1, 0, 'R');
                    $this->SetFont('Arial', '', 9);
                }
                $this->SetFillColor(232, 232, 232);
                
                //Vergon
                
				$this->Cell(100,4,'MATERIAS :'. ($n + 1) .' '. ' APROBADAS: '.$aprov.'  REPROBADAS:  '.$reprov ,1,0,'L',1);
                $this->Cell(20, 4, 'PROMEDIOS', 1, 0, 'C', 1);
                
                //Promedios
                if(!isset($promedioIDM15)){ //solucion temporal para el caso que no esten ingresada las notas de la materia formacion en valores
                $prom_matsF = ($prom_mats) / $n;
                }else{
                    $prom_matsF = ($prom_mats - $promedioIDM15) / $n;
                }
				$paf        = $paf / $n;
                $pbf        = $pbf / $n;
                $pcf        = $pcf / $n;
                $ppftotal   = $ppftotal / $n;
                
                $this->Cell(20, 4, sprintf("%.1F",$prom_matsF), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$paf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pbf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pcf), 1, 0, 'C');
                //$this->Cell(10, 4, sprintf("%.1F",$ppftotal), 1, 0, 'C'); // dato exacto
                $this->Cell(10, 4, round(number_format($ppftotal,1)), 1, 0, 'C'); // dato redondeado
                
                if(($n + 1) === 15) {$this->Ln(6);}else{  $this->Ln(10);} #reporte de 15 materias para noveno fix salto de linea

                $this->SetFont('Arial', 'I', 9);
                $this->Cell(50, 6, '_____________________________', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 6, '_____________________________', 0, 0, 'C');
                $this->Ln();
                $this->Cell(50, 6, 'Direccion', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 6, 'Registro Academico', 0, 0, 'C');
                if (($boleta / 2) == 0) {
                    $this->Ln();
                    $this->AddPage();
                } else {
                    #if($n === 15) {$this->Ln(10);}else{  $this->Ln(10);}
                    $this->Ln(10);
                    $this->Rect(15, 136, 190, 118, 'D');
                    $this->Image('images/logo.jpg', 170, 138, 22);
                }
                $boleta++;
                $aprov = 0;
                $reprov = 0;
				$paf        = 0;
                $pbf        = 0;
                $pcf        = 0;
                $ppftotal   = 0;
            endfor;
        } else {
            $this->SetFont('Arial', '', 16);
            $this->Ln(20);
            $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
            $this->Cell(0, 5, 'N', 1, 0, 'R');
            $this->SetFont('Arial', '', 9);
        }
    }
    
    public function boletaB($obj, $nom_grade, $periodo) {
        
        $alumn = $obj->getAlumxGraxNotas2($_GET['grade'], $_GET['year']);
        
        /* Definiendo Docentes Guias */
        if ($_GET['grade'] ==10) {$docente = "Roberto Antonio Méndez Girón"; }
        if ($_GET['grade'] ==11) {$docente = "Sor  María Trinidad Ramos Miranda"; }
        
        //Acumuladores
        $paf = 0;
        $pbf = 0;
        $pcf = 0;
        $ppftotal = 0;
        $prom_matsF = 0;
        $aprov = 0;
        $reprov = 0;
        
        if (count($alumn) > 0) {
            $boleta = 1;
            for ($x = 0; $x < count($alumn); $x++):
                $this->SetMargins(20, 10);
                $this->Rect(15, 9, 190, 118, 'D');
                $this->Image('images/logo.jpg', 170, 10, 22);

                $this->SetFont('Arial', '', 9);
                $this->Ln();
                $this->Cell(0, 5, 'TODO POR LA GLORIA DE JESUS MARIA Y JOSE', 0, 0, 'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Ln();
                $this->Cell(0, 5, utf8_decode('COLEGIO JOSEFINO NUESTRA SEÑORA DE LA PAZ'), 0, 0, 'C');
                $this->Ln();
                $this->Cell(0, 5, utf8_decode('BOLETA DE NOTAS PERIODO : ' . $_GET['period']), 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '');
                $this->Cell(15, 4, 'Alumna :');
                $this->Cell(60, 4, utf8_decode($alumn[$x]["nombre"]) .  ' ' .  utf8_decode($alumn[$x]["apellido"]));
                $this->Ln();
                $this->Cell(15, 4, 'Grado :');

                $this->Cell(20, 4, utf8_decode($nom_grade));
                $this->Ln();
                $this->Cell(15, 4, 'Docente :');
                $this->Cell(60, 4, utf8_decode($docente));
                $this->Ln();

                $this->SetFillColor(232, 232, 232);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(60);
                $this->Cell(80, 4, $periodo, 0, 0, 'C', 1);
                $this->Ln();


                $this->Cell(60, 8, 'ASIGNATURA', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P1A', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P2A', 1, 0, 'C', 1);
                $this->Cell(20, 4, 'P.O', 1, 0, 'C', 1);
              
                $this->Cell(20, 8, 'Promedio', 1, 0, 'C', 1);
                $this->Cell(40, 4, 'N. Anteriores', 1, 0, 'C', 1);
                $this->Ln();
                $this->Cell(60, 4, '', 0, 0, 'L');
                $this->Cell(20, 4, '50%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '20%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '30%', 1, 0, 'C', 1);
                $this->Cell(20, 4, '', 0, 0, 'C');
                
                
                
                 switch($_GET['period']):
                    case '1':
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '2':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '3':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P4', 1, 0, 'C', 1);
                        break;
                    case '4':
                        $this->Cell(10, 4, 'P1', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P2', 1, 0, 'C', 1);
                        $this->Cell(10, 4, 'P3', 1, 0, 'C', 1);
                        break;
                endswitch;
                $this->Cell(10, 4, 'NF', 1, 0, 'C', 1);
                $this->Ln();
                $this->SetFillColor(255, 255, 255);
                $this->SetFont('Arial', '', 9);
                $w = array(9, 60, 10, 20);
                $nota_mat = $obj->boletanotasbach($alumn[$x]["id"]);
                $n = 0;
                $prom_mats = 0;
                if (count($nota_mat) > 0) {
                    for ($i = 0; $i < count($nota_mat); $i++):
                        $this->Cell($w[1], 4, ucwords(strtolower(utf8_decode($nota_mat[$i]['Nombre_materia']))), 1);
                        $this->Cell($w[3], 4, sprintf("%.1F",$nota_mat[$i]['PO']), 1, 0, 'C');
                        $this->Cell($w[3], 4, sprintf("%.1F",$nota_mat[$i]['POE']), 1, 0, 'C');
                        $this->Cell($w[3], 4, sprintf("%.1F",$nota_mat[$i]['POBP']), 1, 0, 'C');
                        $this->Cell($w[3], 4, sprintf("%.1f",$nota_mat[$i]['Promedio_total']), 1, 0, 'C');
                        $this->SetFont('Arial', '', 9);
                        $a = 0; $b = 0; $c = 0;
                        switch($_GET['period']):
                            case '1':
                                $a = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $b = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $c = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1f",$c), 1, 0, 'C');
                                break;
                            case '2':
                                $a = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $c = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                            case '3':
                                $a = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $c = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 4, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                            case '4':
                                $a = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 1, $_GET['year']);
                                $b = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 2, $_GET['year']);
                                $c = ($obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year'])==0)?0:$obj->getPBach($alumn[$x]["id"], $nota_mat[$i]['IDM'], 3, $_GET['year']);
                                $this->Cell($w[2], 4, sprintf("%.1F",$a), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$b), 1, 0, 'C');
                                $this->Cell($w[2], 4, sprintf("%.1F",$c), 1, 0, 'C');
                                break;
                        endswitch;
                        if($nota_mat[$i]['Promedio_total'] >= 7):	$aprov ++; else: $reprov ++; endif;
                        $paf += sprintf("%.1F",$a); $pbf += sprintf("%.1F",$b); $pcf += sprintf("%.1F",$c); 
                        $pftotal = (($nota_mat[$i]['Promedio_total']+sprintf("%.1F",$a)+sprintf("%.1F",$b)+sprintf("%.1F",$c)) / 4);
                        $ppftotal += $pftotal;
                        //$this->Cell($w[2], 4, sprintf("%.1f",$pftotal), 1, 0, 'C'); //muestra los datos exactos
                        $this->Cell($w[2], 4, round(number_format($pftotal,1)), 1, 0, 'C');//se redondea segun exijencias
                        $this->Ln();
                        $n++;
                        $prom_mats += $nota_mat[$i]['Promedio_total'];
                    endfor;
                } else {
                    $this->SetFont('Arial', '', 16);
                    $this->Ln(20);
                    $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
                    $this->Cell(0, 5, 'N', 1, 0, 'R');
                    $this->SetFont('Arial', '', 9);
                }
                $this->SetFillColor(232, 232, 232);
                
                
                $this->Cell(100,4,'MATERIAS :'. $n .' '. ' APROBADAS: '.$aprov.' REPROBADAS: '.$reprov ,1,0,'L',1);
                $this->Cell(20, 4, 'PROMEDIOS', 1, 0, 'C', 1);
                 //Promedios
                $prom_matsF = $prom_mats / $n;
                $paf        = $paf / $n;
                $pbf        = $pbf / $n;
                $pcf        = $pcf / $n;
                $ppftotal   = $ppftotal / $n;
                
                $this->Cell(20, 4, sprintf("%.1F",$prom_matsF), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$paf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pbf), 1, 0, 'C');
                $this->Cell(10, 4, sprintf("%.1F",$pcf), 1, 0, 'C');
                //$this->Cell(10, 4, sprintf("%.1F",$ppftotal), 1, 0, 'C'); // dato exacto
                $this->Cell(10, 4, round(number_format($ppftotal,1)), 1, 0, 'C'); // dato redondeado
                $this->Ln();

                $this->SetFont('Arial', 'I', 9);
                $this->Cell(50, 5, '_____________________________', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 5, '_____________________________', 0, 0, 'C');
                $this->Ln();
                $this->Cell(50, 5, 'Direccion', 0, 0, 'C');
                $this->Cell(80);
                $this->Cell(50, 5, 'Registro Academico', 0, 0, 'C');
                if (($boleta / 2) == 0) {
                    $this->Ln();
                    $this->AddPage();
                } else {
                    $this->Ln(7);
                    $this->Rect(15, 132, 190, 120, 'D');
                    $this->Image('images/logo.jpg', 170, 135, 22);
                }
                $boleta++;
                $aprov = 0;
                $reprov = 0;
				$prom_matsF = 0;
                $paf        = 0;
                $pbf        = 0;
                $pcf        = 0;
                $ppftotal   = 0;
            endfor;
        } else {
            $this->SetFont('Arial', '', 16);
            $this->Ln(20);
            $this->Cell(0, 5, 'No Hay Registros de Notas Ingresadas', 1, 0, 'C');
            $this->Cell(0, 5, 'N', 1, 0, 'R');
            $this->SetFont('Arial', '', 9);
        }
    }

}

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
switch ($nameg[0]['nivel_gra']) {
    case "primaria":
        $pdf->boletaP($objReport, $nameg[0]['nombre_gra'], $pperiod);
        break;
    case "secundaria":
        $pdf->boletaS($objReport, $nameg[0]['nombre_gra'], $pperiod);
        break;
    case "Bachillerato":
        $pdf->boletaB($objReport, $nameg[0]['nombre_gra'], $pperiod);
        break;
}
        $pdf->Output();
        
function convert($var){
    
    switch($var):
        #case    "5":
        #case     "4.5":
		case     ($var >= 4.5 && $var <= 5):
            return "E";
            break;
        #case     "4":
        #case     "3.5":
		case     ($var >= 3.5 && $var <= 4.4):
            return "MB";
            break;
        #case     "3":
        #case     "2.5":
		case     ($var >= 2.5 && $var <= 3.4):
            return "B";
            break;
        default:
            return "B";
            break;
    endswitch;
    
}

function convert_20($var){ 
    
    switch($var):
        #case    "2.0":
        #case     "1.8":
		case     ($var >= 1.8 && $var <= 2.0):
            return "E";
            break;
        #case     "1.6":
        #case     "1.4":
		case     ($var >= 1.4 && $var <= 1.7):
            return "MB";
            break;
        #case     "1.2":
        #case     "0":
		case     ($var >= 0 && $var <= 1.3):
            return "B";
            break;
        default:
            return "B";
            break;
    endswitch;
    
}

function convert_30($var){
    
    switch($var):
        #case    "3":
        #case     "2.7":
		case     ($var >= 2.5 && $var <= 3):
            return "E";
            break;
        #case     "2.4":
        #case     "2.1":
		case     ($var >= 2.1  && $var <= 2.4):
            return "MB";
            break;
        #case     "1.8":
        #case     "0":
		case     ($var >= 0 && $var <= 2.0):
            return "B";
            break;
        default:
            return "B";
            break;
    endswitch;
    
}

function convert_dos($var){
    
    switch($var):
        #case    "10":
        #case     "9":
        case     ($var > 8.1 && $var <= 10): //Modificado para reparar el formato por que no se tomaron en cuenta los reciduos 17/04/2012
            return "E";
            break;
        #case     "8":
        #case     "7":
		case     ($var > 7 && $var <= 8):
            return "MB";
            break;
        #case     "6":
        #case     "5":
		case     ($var > 5 && $var <= 6.9):
            return "B";
            break;
        default:
            return "B";
            break;
    endswitch;
    
}
?>
