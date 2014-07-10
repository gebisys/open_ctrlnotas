<?php

include_once "includes/config.php";
include_once "fpdf/fpdf.php";
include_once 'class/Report.php';
include_once 'class/Docentes.php';
$objDocnt = new Docente($db);

$nameDocent = $objDocnt->getDocente($_GET['docnt']);
$_SESSION['__name__Docente__report'] = $nameDocent[0]['dcnt_nom'] .' '. $nameDocent[0]['dcnt_ape'];
$objReport = new Reports($db);

class PDF extends FPDF {

    public function Header() {
        $this->Image('images/logo.jpg', 10, 8, 24);
        $this->SetFont('Arial','',9);
        $this->Cell(0,0,date('g:i:s a'),0,0,'R');
        $this->SetFont('Arial','B',15);
        $this->Ln(5);
        $this->Cell(0, 0, utf8_decode(COMPANY), 0, 0, 'C');
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 0, date('d/m/Y'), 0, 0, 'R');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 0, 'Notas Finales', 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 0, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');
        
        $this->SetFont('Arial', '', 11);
        $this->Ln(15);

        $this->Cell(20, 6, 'Materia :', 0);
        $this->Cell(100, 6, $_GET['mat'], 0);

        $this->Cell(20, 6, 'Periodo :', 0);
        $this->Cell(10, 6, $_GET['period'], 0);
        $this->Cell(20, 6, date('Y'), 0);

      

        $this->Ln();

        $this->Cell(20, 6, 'Maestro :', 0);
        $this->Cell(100, 6, utf8_decode($_SESSION['__name__Docente__report']), 0);
        $this->Cell(20, 6, 'Grado :', 0);
        $this->Cell(50, 6, utf8_decode($_GET['grade']), 0);
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 10);

        $w = array(9, 110, 10, 70);
        $this->Cell($w[0], 5, 'No.', 1, 0, 'C');
        $this->Cell($w[1], 5, 'Alumnas', 1, 0, 'C');
        $this->Cell($w[2], 5, 'P1', 1, 0, 'C');
        $this->Cell($w[2], 5, 'P2', 1, 0, 'C');
        $this->Cell($w[2], 5, 'P3', 1, 0, 'C');
        $this->Cell($w[2], 5, 'P4', 1, 0, 'C');
        $this->Cell($w[2], 5, 'NF', 1, 0, 'C');
        $this->Cell(15, 5, 'Estado', 1, 0, 'C');

        $this->Ln();
        $this->SetFont('Arial', '', 10);
    }

    public function table($obj, $db) {
        $w = array(9, 110, 10, 70);
        $year	= date("Y");
        $alumn = $obj->getAlumxGra($_GET['opt'], $_GET['mat_id'], $_GET['gr_id'], $_GET['period'], $year);
        $n = 1;
        $p1=0;$p2=0;$p3=0;$p4=0;$pf=0;
        $objGeneric = new Generic($db);
			$nameg = $objGeneric->getNameGrade($_GET['gr_id']);
			switch ($nameg[0]['nivel_gra']) {
				case "primaria":
					if (count($alumn) > 0 ){
						for ($i = 0; $i < count($alumn); $i++):
							$this->Cell($w[0], 6, $n, 1, 0, 'C');
							$this->Cell($w[1], 6, $alumn[$i]['code'] . ' ' . utf8_decode($alumn[$i]['apellido']) . ' ' . utf8_decode($alumn[$i]['nombre']) , 1);
							$p1 = ($obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 1, $year)==0)?0:$obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 1, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p1), 1, 0, 'C');
							$p2 = ($obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 2, $year)==0)?0:$obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 2, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p2), 1, 0, 'C');
							$p3 = ($obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 3, $year)==0)?0:$obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 3, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p3), 1, 0, 'C');
							$p4 = ($obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 4, $year)==0)?0:$obj->getPpri($alumn[$i]["id"], $_GET['mat_id'], 4, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p4), 1, 0, 'C');
							$pf = (sprintf("%.1F",$p1) + sprintf("%.1F",$p2)+ sprintf("%.1F",$p3) + sprintf("%.1F",$p4)) / 4;
							$this->SetFont('Arial', 'B', 10);
							//$this->Cell($w[2], 6, sprintf("%.1F",$pf), 1, 0, 'C'); //muestra los datos exactos               
							$this->Cell($w[2], 6, round(number_format($pf,1)), 1, 0, 'C');//se redondea segun exijencias
                                                        $this->Cell(15, 6, $result = ($pf >= 7)?'A':'R', 1, 0, 'C');
							$this->SetFont('Arial', '', 10);
							$this->Ln();
							$n++;
                                                        $p1=0;$p2=0;$p3=0;$p4=0;$pf=0;$result=0;
						endfor;
					}
					break;
				case "secundaria":
					if (count($alumn) > 0 ){
						for ($i = 0; $i < count($alumn); $i++):
							$this->Cell($w[0], 6, $n, 1, 0, 'C');
							$this->Cell($w[1], 6, $alumn[$i]['code'] . ' ' . utf8_decode($alumn[$i]['apellido']) . ' ' . utf8_decode($alumn[$i]['nombre']), 1);
							$p1 = ($obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 1, $year)==0)?0:$obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 1, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p1), 1, 0, 'C');
							$p2 = ($obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 2, $year)==0)?0:$obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 2, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p2), 1, 0, 'C');
							$p3 = ($obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 3, $year)==0)?0:$obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 3, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p3), 1, 0, 'C');
							$p4 = ($obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 4, $year)==0)?0:$obj->getPSec($alumn[$i]["id"], $_GET['mat_id'], 4, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p4), 1, 0, 'C');
							$pf = (sprintf("%.1F",$p1) + sprintf("%.1F",$p2)+ sprintf("%.1F",$p3) + sprintf("%.1F",$p4)) / 4;
							$this->SetFont('Arial', 'B', 10);
							//$this->Cell($w[2], 6, sprintf("%.1F",$pf), 1, 0, 'C'); //muestra los datos exactos               
							$this->Cell($w[2], 6, round(number_format($pf,1)), 1, 0, 'C');//se redondea segun exijencias
                                                        $this->Cell(15, 6, $result = ($pf >= 7)?'A':'R', 1, 0, 'C');
							$this->SetFont('Arial', '', 10);
							$this->Ln();
							$n++;
                                                        $p1=0;$p2=0;$p3=0;$p4=0;$pf=0;$result=0;
						endfor;
					}
					break;
				case "Bachillerato":
					if (count($alumn) > 0 ){
						for ($i = 0; $i < count($alumn); $i++):
							$this->Cell($w[0], 6, $n, 1, 0, 'C');
							$this->Cell($w[1], 6, $alumn[$i]['code'] . ' ' . utf8_decode($alumn[$i]['apellido']) . ' ' . utf8_decode($alumn[$i]['nombre']), 1);
							$p1 = ($obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 1, $year)==0)?0:$obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 1, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p1), 1, 0, 'C');
							$p2 = ($obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 2, $year)==0)?0:$obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 2, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p2), 1, 0, 'C');
							$p3 = ($obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 3, $year)==0)?0:$obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 3, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p3), 1, 0, 'C');
							$p4 = ($obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 4, $year)==0)?0:$obj->getPBach($alumn[$i]["id"], $_GET['mat_id'], 4, $year);
							$this->Cell($w[2], 6, sprintf("%.1F",$p4), 1, 0, 'C');
							$pf = (sprintf("%.1F",$p1) + sprintf("%.1F",$p2)+ sprintf("%.1F",$p3) + sprintf("%.1F",$p4)) / 4;
							$this->SetFont('Arial', 'B', 10);
							//$this->Cell($w[2], 6, sprintf("%.1F",$pf), 1, 0, 'C'); //muestra los datos exactos               
							$this->Cell($w[2], 6, round(number_format($pf,1)), 1, 0, 'C');//se redondea segun exijencias            
							$this->Cell(15, 6, $result = ($pf >= 7)?'A':'R', 1, 0, 'C');
							$this->SetFont('Arial', '', 10);
							$this->Ln();
							$n++;
                                                        $p1=0;$p2=0;$p3=0;$p4=0;$pf=0;$result=0;
						endfor;
					}
					break;
			}
    }

    //Pie de página
    public function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-17);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 9);
        //Número de página
        #$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(50, 6, '_____________________________',0 , 0,'C');
        $this->Ln();
        $this->Cell(50, 6, 'Firma Maestro',0, 0,'C');
    }

}

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->table($objReport, $db);
$pdf->Output();

$_SESSION['__name__Docente__report']='';
?>
