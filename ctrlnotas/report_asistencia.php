<?php

include_once "includes/config.php";
include_once "fpdf/fpdf.php";
include_once 'class/Report.php';
include_once 'class/Docentes.php';
$objDocnt = new Docente($db);

$nameDocent = $objDocnt->getDocente($_POST['docnt']);
$_SESSION['__name__Docente__Assiten'] = $nameDocent[0]['dcnt_nom'] .' '. $nameDocent[0]['dcnt_ape'];
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
        $this->Cell(0, 0, 'Asistencia Alumnas', 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 0, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');
        
        $this->SetFont('Arial', '', 11);
        $this->Ln(15);

        $this->Cell(20, 6, 'Periodo :', 0);
        $this->Cell(10, 6, $_POST['period'], 0);
        $this->Cell(100, 6, date('Y'), 0);

        $this->Cell(20, 6, 'Grado :', 0);
        $this->Cell(50, 6, utf8_decode($_POST['grade']), 0);

        $this->Cell(15, 6, 'Mes :', 0);
        $this->Cell(35, 6, utf8_decode($_POST['mes']), 0);

        $this->Ln();

        $this->Cell(20, 6, 'Materia :', 0);
        $this->Cell(110, 6, $_POST['mat'], 0);
        $this->Cell(20, 6, 'Maestro :', 0);
        $this->Cell(100, 6, utf8_decode($_SESSION['__name__Docente__Assiten']), 0);

        $this->Ln(6);
        $this->SetFont('Arial', '', 10);

        $w = array(12, 100, 9, 70);
        //$this->SetFont('Arial','',10);
        //Encabezado de la tabla de comisiones
        $this->Cell($w[0], 5, 'No.', 1, 0, 'C');
        $this->Cell($w[1], 5, 'Alumnas', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, '', 1, 0, 'C');
        $this->Cell($w[3], 5, 'Observaciones', 1, 0, 'C');

        $this->Ln();
    }
    
    public function table($obj) {
        $w = array(12, 100, 9, 70);
        $alumn = $obj->getAlumxGraxNotas($_POST['gradeid']);
        $n = 1;
        for ($i = 0; $i < count($alumn); $i++):
            $this->Cell($w[0], 4, $n, 1, 0 , 'C');
            $this->Cell($w[1], 4, $alumn[$i]['code'] .  ' ' . utf8_decode($alumn[$i]['apellido']) . ' ' . utf8_decode($alumn[$i]['nombre']) , 1);
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[2], 4, '', 1, 0, 'C');
            $this->Cell($w[3], 4, '', 1, 0, 'C');
            $this->Ln();
            $n ++;
        endfor;
        
    } 

}

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->table($objReport);
$pdf->Output();

?>
