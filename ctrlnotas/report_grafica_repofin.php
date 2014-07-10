<?php

    include_once 'includes/config.php';
    include_once 'fpdf/diag.php';
    include_once 'class/Report.php';
    include_once 'class/Docentes.php';
    $objDocnt = new Docente($db);

	$nameDocent = $objDocnt->getDocente($_GET['docnt']);
	$_SESSION['__name__Docente'] = $nameDocent[0]['dcnt_nom'] .' '. $nameDocent[0]['dcnt_ape'];
	
	
	class PDF extends PDF_Diag {
        public function Header(){
            $this->Image('images/logo.jpg', 10, 8, 24);
			$this->SetFont('Arial','',9);
			$this->Cell(0,0,date('g:i:s a'),0,0,'R');
			$this->SetFont('Arial','B',14);
			$this->Ln(5);
			$this->Cell(0, 0, utf8_decode(COMPANY), 0, 0, 'C');
			
			$this->SetFont('Arial', '', 9);
			$this->Cell(0, 0, date('d/m/Y'), 0, 0, 'R');
			$this->Ln(5);
			
			$this->SetFont('Arial', 'B', 12);
			$this->Cell(0, 0, 'Grafico Alumnas por Materia', 0, 0, 'C');
			$this->SetFont('Arial', '', 9);
			$this->Cell(0, 0, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');			
			$this->SetFont('Arial', '', 10);
			$this->Ln(5);
			$this->Cell(0, 0, 'Aprobadas y Reprobadas del '.date("Y"), 0, 0, 'C');
			$this->SetFont('Arial', '', 11);
			$this->Ln(15);

			$this->Cell(20, 6, 'Materia :', 0);
			$this->Cell(80, 6, utf8_decode($_GET['mat']), 0);
			$this->Cell(20, 6, 'Grado :', 0);
			$this->Cell(80, 6, utf8_decode($_GET['grade']), 0);
			$this->Ln();
			
			$this->Cell(20, 6, 'Maestro :', 0);
			$this->Cell(100, 6, utf8_decode($_SESSION['__name__Docente']), 0);
			$this->SetFont('Arial', '', 10);
			$this->Ln();
			
			
			
        
        }
		
		public function graficnotasfinal($db) {
			$objReport = new Reports($db);
			$year	= date("Y");
			$alumn = $objReport->getAlumxGraxNotas2($_GET['gr_id'], $year);			
			$aprov = 0;
			$reprov = 0;
			$totala = 0;
			$totaln = 0;
			
			$objGeneric = new Generic($db);
			$nameg = $objGeneric->getNameGrade($_GET['gr_id']);
			switch ($nameg[0]['nivel_gra']) {
				case "primaria":
					if (count($alumn) > 0) {
						$totala = count($alumn);
						for ($x = 0; $x < count($alumn); $x++):				
							$a = ($objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 1, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 1, $year);
							$b = ($objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 2, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 2, $year);
							$c = ($objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 3, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 3, $year);		
							$d = ($objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 4, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 4, $year);	
							$totaln = ($a + $b + $c + $d) / 4;
							if($totaln >= 7): $aprov ++; else: $reprov ++; endif;
							$totaln = 0;							
						endfor;
					}
					break;
				case "secundaria":
					if (count($alumn) > 0) {
						$totala = count($alumn);
						for ($x = 0; $x < count($alumn); $x++):				
							$a = ($objReport->getPSec($alumn[$x]["id"], $_GET['mat_id'], 1, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 1, $year);
							$b = ($objReport->getPSec($alumn[$x]["id"], $_GET['mat_id'], 2, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 2, $year);
							$c = ($objReport->getPSec($alumn[$x]["id"], $_GET['mat_id'], 3, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 3, $year);		
							$d = ($objReport->getPSec($alumn[$x]["id"], $_GET['mat_id'], 4, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 4, $year);	
							$totaln = ($a + $b + $c + $d) / 4;
							if($totaln >= 7): $aprov ++; else: $reprov ++; endif;
							$totaln = 0;							
						endfor;
					}
					break;
				case "Bachillerato":
					if (count($alumn) > 0) {
						$totala = count($alumn);
						for ($x = 0; $x < count($alumn); $x++):				
							$a = ($objReport->getPBach($alumn[$x]["id"], $_GET['mat_id'], 1, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 1, $year);
							$b = ($objReport->getPBach($alumn[$x]["id"], $_GET['mat_id'], 2, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 2, $year);
							$c = ($objReport->getPBach($alumn[$x]["id"], $_GET['mat_id'], 3, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 3, $year);		
							$d = ($objReport->getPBach($alumn[$x]["id"], $_GET['mat_id'], 4, $year)==0)?0:$objReport->getPpri($alumn[$x]["id"], $_GET['mat_id'], 4, $year);	
							$totaln = ($a + $b + $c + $d) / 4;
							if($totaln >= 7): $aprov ++; else: $reprov ++; endif;
							$totaln = 0;							
						endfor;
					}
					break;				
			}
			
			$this->Cell(18, 6, 'Alumnas :',0);
			$this->SetFont('Arial', 'B', 10);
			$this->Cell(20, 6, $totala,0);
			$this->SetFont('Arial', '', 10);
			$this->Cell(20, 6, 'Aprobadas :',0);
			$this->SetFont('Arial', 'B', 10);
			$this->Cell(20, 6, $aprov ,0);
			$this->SetFont('Arial', '', 10);
			$this->Cell(22, 6, 'Reprobadas:',0);
			$this->SetFont('Arial', 'B', 10);
			$this->Cell(20, 6, $reprov,0);
			$this->SetFont('Arial', '', 10);
						
			$data = array('Aprobadas' => $aprov, 'Reprobadas' => $reprov);
			$this->SetXY(70, 60);
                        $col1=array(77,102,128);
			$col2=array(153,204,255);
			
			$this->PieChart(100, 100, $data, '%l (%p)', array($col1,$col2));
		}

      
        
    }

    $pdf= new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->graficnotasfinal($db);
    $pdf->Output();
?> 
