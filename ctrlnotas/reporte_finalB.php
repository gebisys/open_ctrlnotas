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
        $this->Cell(0, 0, 'Reporte Final de Notas - Tercer Ciclo', 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 0, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');
        
        $this->SetFont('Arial', '', 11);
        $this->Ln(15);
        
		if ($_GET['grade'] ==10) {$docente = "Prof."; $gradoo = "Primer Año";}
		if ($_GET['grade'] ==11) {$docente = "Prof."; $gradoo = "Segundo Año";}
		
        $this->Cell(25, 6, 'Maestro Guia :', 0);
        $this->Cell(100, 6, utf8_decode($docente), 0);
        $this->Cell(15, 6, 'Grado :', 0);
        $this->Cell(30, 6, utf8_decode($gradoo), 0);
         $this->Cell(20, 6, utf8_decode('Año :'), 0);
        $this->Cell(50, 6, utf8_decode($_GET['year']), 0);
		$this->Ln(7);
    }
	
	public function notas($db){
		$this->SetFillColor(232,232,232);
        $this->SetFont('Arial', 'B', 9);

        $w = array(8, 80, 40, 70,8);
        $this->Cell($w[0], 10, 'No.', 1, 0, 'C',1);
        $this->Cell($w[1], 10, 'Alumnas', 1, 0, 'C',1);
        $this->Cell($w[2],5,utf8_decode('Matemáticas'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Lenguaje y Lit.'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ciencias Biológicas'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ciencias Quimicas'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ciencias Fisicas'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Estudios Sociales'),1,0,'C',1);

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
        #Ciencias Biologicas
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9); 
        #ciencias Quimicas
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #ciencias Fisicas
         $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #Estudios sociales
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
        $alumn = $objReport->getAlumxGraxNotas2($grado, $year);
        $n = 1;
        $pff = 0;
        if (count($alumn) > 0 ){
            for ($x = 0; $x < count($alumn); $x++):
                $this->Cell($w[0], 4, $n, 1, 0, 'C');
                $this->Cell($w[1], 4,utf8_decode($alumn[$x]['apellido']) . ' ' . utf8_decode($alumn[$x]['nombre']), 1);
                #Matematicas
                $materia = 2;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #ciencias Biologicas
                $materia = 16;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #ciencias quimicas
                $materia = 17;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #ciencias fisicas
                $materia = 14;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
        $this->Cell($w[2],5,utf8_decode('Inglés'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Informática'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Seminario'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Ori. para la Vida'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Cálculo'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Contabilidad'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Edu. en la Fe'),1,0,'C',1);  
        $this->Cell($w[2],5,utf8_decode('Escuela de Padres'),1,0,'C',1);		
		$this->SetFont('Arial', '', 9);
        $this->Ln();
        
        $this->Cell($w[0], 5,'');
        #ingles
                    
		$this->SetFont('Arial', '', 9);
		$this->Cell($w[4],5,'P1',1,0,'C',1);
		$this->Cell($w[4],5,'P2',1,0,'C',1);
		$this->Cell($w[4],5,'P3',1,0,'C',1);
		$this->Cell($w[4],5,'P4',1,0,'C',1);
		$this->SetFont('Arial', 'B', 9);
		$this->Cell($w[4],5,'PF',1,0,'C',1);
		$this->SetFont('Arial', '', 9);
		
        #informatica
        
		$this->Cell($w[4],5,'P1',1,0,'C',1);
		$this->Cell($w[4],5,'P2',1,0,'C',1);
		$this->Cell($w[4],5,'P3',1,0,'C',1);
		$this->Cell($w[4],5,'P4',1,0,'C',1);
		$this->SetFont('Arial', 'B', 9);
		$this->Cell($w[4],5,'PF',1,0,'C',1);
		$this->SetFont('Arial', '', 9);
		
        #seminario
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9); 
        #ori para la vida
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #calculo
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #contabilidad
     		
		$this->Cell($w[4],5,'P1',1,0,'C',1);
		$this->Cell($w[4],5,'P2',1,0,'C',1);
		$this->Cell($w[4],5,'P3',1,0,'C',1);
		$this->Cell($w[4],5,'P4',1,0,'C',1);
		$this->SetFont('Arial', 'B', 9);
		$this->Cell($w[4],5,'PF',1,0,'C',1);
		$this->SetFont('Arial', '', 9);
		#Edu. en la fe
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
        $this->Ln();
        $n = 1;
        $pff = 0;
        if (count($alumn) > 0 ){
            for ($x = 0; $x < count($alumn); $x++):
                $this->Cell($w[0], 4, $n, 1, 0, 'C');
                #ingles
                
                $materia = 5;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
             
                #informatica
               
                $materia = 27;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
				
                #seminario
                $materia = 19;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #orientacion para la vida
                $materia = 18;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #calculo 
                $materia = 21;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #contabilidad
               
                $materia = 22;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
               
                
                
                 #edu en lafe
                $materia = 25;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
        $this->Cell($w[2],5,utf8_decode('Conducta'),1,0,'C',1);
        $this->Cell($w[2],5,utf8_decode('Orientación'),1,0,'C',1);
        $this->Cell(15,5, 'Nota Final', 'TRL', 0, 'C',1);
        $this->Ln();
        
         $this->Cell($w[0], 5,'');
        #conducta
        $this->SetFont('Arial', '', 9);
        $this->Cell($w[4],5,'P1',1,0,'C',1);
        $this->Cell($w[4],5,'P2',1,0,'C',1);
        $this->Cell($w[4],5,'P3',1,0,'C',1);
        $this->Cell($w[4],5,'P4',1,0,'C',1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[4],5,'PF',1,0,'C',1);
        $this->SetFont('Arial', '', 9);
        #orientacion
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
                #conducta
                $materia = 28;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                
                #orientacion
                $materia = 20;
                $periodo = 1;
                $a = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 2;
                $b = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 3;
                $c = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
                $periodo = 4;
                $d = ($objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year)==0)?0:$objReport->getPBach($alumn[$x]["id"], $materia, $periodo, $year);
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
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],2,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
                #lenguaje
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],1,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
                #ciencias biologicas
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],16,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#ciencias quimicas
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],17,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#ciencias fisicas 	
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],14,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#sociales
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],4,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#ingles
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],5,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#informatica
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],27,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#seminario
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],19,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#orientacion para la vida
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],18,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				#calculo
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],21,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#contabilidad
				$resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],22,$year);
				for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#edu en la fe
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],25,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#padres
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],13,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#conducta
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],28,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
				
				#orientacion
                $resultFinal = $objReport->getPBachFinal($alumn[$x]["id"],20,$year);
                for ($i = 0; $i < count($resultFinal); $i++){ $pfm += $resultFinal[$i]['Promedio']; } $pfmat += $pfm / 4;
				$pfm = "";
							
				$pfanual = $pfmat / 16;
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
$pdf->notas($db);
$pdf->Output();
?>
