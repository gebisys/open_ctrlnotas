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
        $this->Cell(0, 0, 'Colector de Notas', 0, 0, 'C');
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
        $this->SetFont('Arial', '', 9);

        $w = array(9, 90, 9, 70);
        $this->Cell($w[0], 5, 'No.', 1, 0, 'C');
        $this->Cell($w[1], 5, 'Alumnas', 1, 0, 'C');
        $this->Cell($w[2], 5, 'Act 1', 1, 0, 'C');
        $this->Cell($w[2], 5, 'Act 2', 1, 0, 'C');
        $this->Cell($w[2], 5, 'Act 3', 1, 0, 'C');
        $this->Cell($w[2], 5, '50%', 1, 0, 'C');
        $this->Cell($w[2], 5, 'Exam', 1, 0, 'C');
        $this->Cell($w[2], 5, '50%', 1, 0, 'C');
        $this->Cell($w[2], 5, 'NF', 1, 0, 'C');
        $this->Cell($w[3], 5, 'Observaciones', 1, 0, 'C');

        $this->Ln();
    }

    public function table($obj) {
        $w = array(9, 90, 9, 70);
        $year	= date("Y");
        $alumn = $obj->getAlumxGra($_GET['opt'], $_GET['mat_id'], $_GET['gr_id'], $_GET['period'], $year);
        $n = 1;
        if (count($alumn) > 0 ){
            for ($i = 0; $i < count($alumn); $i++):
                $this->Cell($w[0], 4, $n, 1, 0, 'C');
                $this->Cell($w[1], 4, $alumn[$i]['code'] . ' ' . utf8_decode($alumn[$i]['apellido']) . ' ' . utf8_decode($alumn[$i]['nombre']), 1);
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['ac1']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['ac2']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['ac3']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['acPr']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['exam']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['exampro']), 1, 0, 'C');
                $this->Cell($w[2], 4, sprintf("%.1F",$alumn[$i]['promedio']), 1, 0, 'C');
                $this->Cell($w[3], 4, $alumn[$i]['observacion'], 1, 0, 'C');
                $this->Ln();
                $n++;
            endfor;
        } else {
            $this->SetFont('Arial', '', 16);
            $this->Ln(20);
            $this->Cell(0, 5,'No Hay Registros de Notas Ingresadas',1,0,'C');
            $this->Cell(0, 5,'N',1,0,'R');
            $this->SetFont('Arial', '', 9);
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

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->table($objReport);
$pdf->Output();

$_SESSION['__name__Docente__report']='';
?>
