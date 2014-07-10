<?php

include_once "includes/config.php";
include_once "fpdf/fpdf.php";
include_once 'class/Report.php';

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
        $this->Cell(0, 0, 'Reporte Final de Notas', 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 0, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');
        
        $this->SetFont('Arial', '', 11);
        $this->Ln(15);
        
        if ($_GET['grade'] ==1) {$docente = "Prof."; $gradoo = "Primer Grado";}
		if ($_GET['grade'] ==2) {$docente = "Prof."; $gradoo = "Segundo Grado";}
		if ($_GET['grade'] ==3) {$docente = "Prof."; $gradoo = "Tercer Grado";}
		if ($_GET['grade'] ==4) {$docente = "Prof."; $gradoo = "Cuarto Grado";}
		if ($_GET['grade'] ==5) {$docente = "Prof."; $gradoo = "Quinto Grado";}
		if ($_GET['grade'] ==6) {$docente = "Prof."; $gradoo = "Sexto Grado";}


        $this->Cell(25, 6, 'Maestro Guia:', 0);
        $this->Cell(100, 6, utf8_decode($docente), 0);
        $this->Cell(20, 6, 'Grado :', 0);
        $this->Cell(30, 6, utf8_decode($gradoo), 0);
        $this->Cell(20, 6, utf8_decode('Año :'), 0);
        $this->Cell(50, 6, utf8_decode($_GET['year']), 0);
		$this->Ln(7);
    }
	
	public function notas_primaria($db){
		$this->SetFillColor(232,232,232);
        $this->SetFont('Arial', 'B', 9);

        $w = array(8, 80, 40, 70,8);
        $this->Cell($w[0], 10, 'No.', 1, 0, 'C',1);
        $this->Cell($w[1], 10, 'Alumnas', 1, 0, 'C',1);
        $this->Cell($w[2],5,utf8_decode('Matemáticas'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Lenguaje y Lit.'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Estudios Sociales'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ciencias Naturales'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ingles'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Educacion Fisica'),1,0,'C',1);

        $this->Ln();
        
        $this->Cell($w[0], 5,'');
        $this->Cell($w[1], 5, '');
        
        #Matematicas
        $this->SetFont('Arial', '', 9);
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Lenguaje
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Estudios Sociales
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9); 
        #ciencias Naturales
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Ingles
         $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Educacion Fisica
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        $this->Ln();
        $objReport = new Reports($db);
        $year = $_GET['year'];
        $grado = $_GET['grade'];
        $alumn = $objReport->getAlumxGraxNotas2( $grado, $year);
        $n = 1;
        $pff = 0;
        if (count($alumn) > 0 ){
            for ($x = 0; $x < count($alumn); $x++):
                $this->Cell($w[0], 4, $n, 1, 0, 'C');
                $this->Cell($w[1], 4,utf8_decode($alumn[$x]['apellido']) . ' ' . utf8_decode($alumn[$x]['nombre']), 1);
                #Matematicas
                $materia = 2;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Lenguaje
                $materia = 1;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Estudios Sociales
                $materia = 4;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #ciencias
                $materia = 3;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Imgles
                $materia = 5;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Fisica
                $materia = 6;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                $this->Ln();
                $n++;
            endfor;
        }
        
        $this->AddPage();
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 10, 'No.', 1, 0, 'C',1);
        $this->Cell($w[2],5,utf8_decode('Natación'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Educación Musical'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Educación Artistica'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Formación Cristiana'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Caligrafía'),1,0,'C',1);
        
        $this->Cell($w[2],5,utf8_decode('Computación'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Escuela de Padres'),1,0,'C',1);
		$this->Cell(15,5, 'Nota Final', 'TRL', 0, 'C',1);
		$this->SetFont('Arial', '', 9);
        $this->Ln();
        
        $this->Cell($w[0], 5,'');
        #Natación
        $this->SetFont('Arial', '', 9);
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Educación Musical
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Educación Artistica
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9); 
        #Formación Cristiana
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Caligrafía
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        
        #Computación
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Escuela de Padres
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);  
        $this->Cell(15,5, '', 'BRL', 0, 'C',1); 
        $this->Ln();
        $n = 1;
        $pff = 0;
        if (count($alumn) > 0 ){
            for ($x = 0; $x < count($alumn); $x++):
                $this->Cell($w[0], 4, $n, 1, 0, 'C');
                #Natacion
                $materia = 7;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Edu Musical
                $materia = 8;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Edu Artistica
                $materia = 9;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #Formacion Cristiana
                $materia = 10;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #CALIGRAFIA
                $materia = 12;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
               
                 #COMPUTACION
                $materia = 11;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                 #ESCUELA DE PADRES
                $materia = 13;
                $periodo = 1;
                $a = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $materia, $periodo, $year);
                $nf = ($a+$b+$c+$d)/4;
                $pff += $nf;                      
                $this->Cell($w[4],4,sprintf("%.1F",$a),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$b),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$c),1,0,'C');
                $this->Cell($w[4],4,sprintf("%.1F",$d),1,0,'C');
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[4],4,round(number_format(sprintf("%.1F",$nf),1)),1,0,'C');
                $this->SetFont('Arial', '', 9);
                $a = ''; $b=''; $c=''; $d=''; $nf='';
                
                #promedios de Fin anio
                $pfm = 0;
                $pfmat = 0;
                #matematica
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],2,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
                #lenguaje
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],1,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
                #Sociales
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],4,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#ciencias
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],3,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#ingles
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],5,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#edu fisica
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],6,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#natacion
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],7,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#musical
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],8,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#artistica
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],9,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#Form Cristiana
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],10,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#Caligarfia
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],12,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#computacion
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],11,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#padres
                $resultFinal = $objReport->getPpriFinal($alumn[$x]["id"],13,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				 if($grado == 6){ $pfanual = $pfmat / 14 ; }
				
				$pfanual = $pfmat / 13;
				$this->SetFont('Arial', 'B', 9);
				$this->Cell(15,4,round(number_format(sprintf("%.1F",$pfanual),1)),1,0,'C',1);
				$this->SetFont('Arial', '', 9);
				 $pfmat=""; $pfanual="";
                $this->Ln();
                $n++;
            endfor;
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
$pdf = new PDF('L', 'mm', 'Legal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->notas_primaria($db);
$pdf->Output();
?>
