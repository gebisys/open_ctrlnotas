<?php

include_once "includes/config.php";
__is__login();
$objGen 	= new Generica($db);
$objGeneric	= new Generic($db);

if(!isset($_SESSION["sys_continue"])) $_SESSION["sys_continue"] = false;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['periodo'])){
	if( isset($_POST["continue"]) ){
		$_SESSION["sys_continue"] = true;
		$objMaterias = new Materias($db); 
		$mt = $objMaterias->getMateria($_POST["materia"]);
		$_SESSION["sys_mt"] 	= $mt[0]["nombre_mat"]; //Nombre de la materia
		$_SESSION["sys_pe"] 	= $_POST["periodo"];
		$gr = $objGeneric->getNameGrade($_POST["grado"]);
		$_SESSION["sys_gr_id"] 	= $gr[0]["id_gra"];
		$_SESSION["sys_mt_id"]	= $mt[0]["id_mat"];
		$_SESSION["sys_gr"] 	= $gr[0]["nombre_gra"];
		$_SESSION["sys_glv"]	= $gr[0]["nivel_gra"];
		$_SESSION["enabled"]	= $objGen->getEnabledNotes($_POST["periodo"]);
	}
}

define('SECTION', 'Modulos de Registro Academico');
include_once '../templates/site_top_docente.php';

include_once "templates/tables.php";
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article id="dashboard">
                <h1>Ingreso de notas</h1>
                
                <form id="myForm" class="uniform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                    $mats = $objGen->getMats($_SESSION['sys_docente_id']);                        
                                ?>
                                <select size="1" id="grade" name="materia" class="medium required" onchange="javascript:selectgrade(this.value);">
                                        <option value="">Seleccionar materia</option>
                                    <?php for ($i = 0; $i < count($mats); $i++): ?>
                                        <option value="<?php echo $mats[$i]["idm"]; ?>"><?php echo utf8_encode($mats[$i]["nombrem"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                            	<select style="width: 150px; margin-left: 20px;  margin-right: 20px;" id="grado" name="grado" class="medium required">
                                        <option value="">Seleccionar grado</option>
                                </select>
                            </td>
                            <td>
                                 <?php
                                    $periodos = $objGen->enabledPeriod();                        
                                ?>
                                <select style="width: 150px; margin-right: 20px;" id="grade" name="periodo" class="medium required">
                                        <option value="">Seleccionar periodo</option>
                                    <?php for ($i = 0; $i < count($periodos); $i++): ?>
                                        <option value="<?php echo $periodos[$i]["idp"]; ?>"><?php echo utf8_encode($periodos[$i]["nombrep"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        
                        	<td>
                            		<button type="submit" name="continue" value="1" class="button">Continuar</button>
                            	</td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </article>
        </section><!--Fin-->
        
        <?php if($_SESSION["sys_continue"]):?>
        <section id="main" class="grid_12 ">
            <script type="text/javascript">
                jQuery(function(){
                     jQuery("#none").click();
                });
            </script>
               
        	<article>
                     <a href="#" onclick="javascript:jQuery.scrollTo('#notas',800);" style="display: none;" id="none">none</a>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Notas Almacenadas Exitosamente!. Click para Cerrar</div>
                <?php } ?>
        		<p style="font-size: 14px;">Usted est&aacute; ingresando notas para la materia:<b> <?php echo $_SESSION["sys_mt"];?></b>, para el : <b><?php echo $_SESSION["sys_gr"];?></b>, del  <b><?php echo $_SESSION["sys_pe"];?></b> periodo:</p>
        		<form name="saveNotes" id="saveNotes" action="save_notes.php" method="post">   
        		<div  id="notas"style="width: 100%; height: 400px; overflow: auto;">
                        <?php GetTable($objGen); ?>
                        </div>  
                        <button type="submit" name="save_notes" value="ok" class="button" style="margin-top:10px;">Guardar</button>
                        <?php 
                        $url_report = ($_SESSION["sys_glv"] == "primaria")? "report_nxpp.php" : "report_nxp.php"; 
                        ?>
        		
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL . $url_report;?>?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION['sys_docente_id']; ?>"id="report" title="Notas por Periodo" class="button">Notas por Periodo</a> 
						<a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_nfp.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION["sys_docente_id"];?>"id="report" title="Notas Finales" class="button">Notas Finales</a> 
						<a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_grafica_repoxp.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION['sys_docente_id'];?>"id="report" title="Grafico por Periodo" class="button">Grafico por Periodo</a> 
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_grafica_repofin.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION['sys_docente_id'];?>"id="report" title="Grafico Final" class="button">Grafico Final</a> 
                      
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>select_month.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gradeid=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION['sys_docente_id'];?>" id="report" title="Generar Asistencia" class="button">Asistencia</a> 
                       
                        </form>
                        
        	</article>
        </section>
        <?php endif;?>
        
    </section>
</section>

<?php

include_once '../templates/site_bottom.php';
?>
