<style>
    body {font-size: 12px; 
          /*font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Verdana, Tahoma, sans-serif;*/
    
    font-family: 'KlavikaBold', Helvetica, Verdana, sans-serif;
	background: #efeff4;
	color: #2c4e8e;
    
    }
</style>
<?php 
/*
include_once "includes/config.php";
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die(mysqli_error());
$alumn = new Alumno($db);
$docnt = new Docente($db);
$grados = new Generic($db);
#utf8_encode
echo "<pre>";
#print_r($alumn->getAlumns());
echo "</pre>";
$alum = $alumn->getAlumns(500);

for ($i = 0; $i < count($alum); $i++):
    $nom = $alum[$i]['alumn_nomb']; $nom = utf8_encode($nom);  
    $ape = $alum[$i]['alumn_apell']; $ape = utf8_encode($ape);
    $pwd = $alum[$i]['contrasena_alum']; $pwd = md5($pwd);
    $sql = "UPDATE `ctrl_alumnos` SET `alumn_nomb`='{$nom}', `alumn_apell`='{$ape}', `contrasena_alum`='{$pwd}' WHERE `id_alumn` = '{$alum[$i]['id_alumn']}';";
    
    echo $sql."<br />";
endfor;



echo "<br/ > Docentes<br/ >";
$docente = $docnt->getDocentes(100);
for ($i = 0; $i < count($docente); $i++):
    $nom = $docente[$i]['dcnt_nom']; $nom = utf8_encode($nom);  
    $ape = $docente[$i]['dcnt_ape']; $ape = utf8_encode($ape);
    $sql = "UPDATE `ctrl_docentes` SET `dcnt_nom`='{$nom}', `dcnt_ape`='{$ape}' WHERE `dcnt_id` = '{$docente[$i]['dcnt_id']}'; ";
    
    echo $sql."<br />";
endfor;


echo "<br/ > Grados<br/ >";
$gra = $grados->GetGrades();
for ($i = 0; $i < count($gra); $i++):
    $nom = $gra[$i]['nombre_gra']; $nom = utf8_encode($nom);  
    $sql = "UPDATE `ctrl_grados` SET `nombre_gra`='{$nom}' WHERE `id_gra` = '{$gra[$i]['id_gra']}'; ";
    
    echo $sql."<br />";
endfor;
*/
/*function redondear_dos_decimal($valor) {
   $float_redondeado=round($valor * 100) / 100;
   return $float_redondeado;
}
$act1 = (float)10;
$act2 = (float)10;
$act3 = (float)5;
$promact =   round( ( ( ($act1 + $act2 + $act3) / 3 ) * 0.5 ), 1);
 $exam = (float)7.9;
            $promexam =  round( ($exam * 0.5), 1 );
            $promfinal = $promact + $promexam; 
$total = 3.50 + 3.2 + 3.3;
echo redondear_dos_decimal($total);
echo "<br />";
#$promact = number_format($promact, 2, ',', ' ');
echo $promact .' promedio activades<br />';
#$promexam = number_format($promexam, 2, ',', ' ');
echo $promexam .' promedio exam<br />';
#$promfinal = number_format($promfinal, 2, ',', ' ');
echo $promfinal .'<br />';
*/
$number = 362525200;
$money1 = 68.75;
$money2 = 54.65;
$money = $money1 + $money2;
echo sprintf("%.1f", $money); // produce 3.625e+8
 ?>
 
