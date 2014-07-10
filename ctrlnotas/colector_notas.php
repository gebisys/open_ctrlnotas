<?php
include_once "includes/config.php";
include_once 'portal_docente/class/Generica.php';
__is__login();
$objGen = new Generica($db);
$objGeneric = new Generic($db);
define('SECTION', 'Modulos de Registro Academico');

if(!isset($_SESSION["sys_continue"])) $_SESSION["sys_continue"] = false;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['periodo'])){
	if( isset($_POST["colectorNotas"]) ){
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
		$_SESSION["sys_docente_nom"]	= $_POST["docente"];                
	}
}
include_once "templates/tables.php";
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article >
                <h1>Colector Notas</h1>
                <form id="myForm" class="uniform" action="" method="POST">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    $docnt = new Docente($db);
                                    $docente = $docnt->getDocentes(100);
                                    ?>
                                    <select size="1" id="docente" name="docente" class="medium required" onchange="javascript:selectMat(this.value);" style=" width: 220px; margin-right: 10px;">
                                        <option value="">Seleccione Docente</option>
                                        <?php for ($i = 0; $i < count($docente); $i++): ?>
                                            <option value="<?php echo $docente[$i]["dcnt_id"]; ?>"><?php echo $docente[$i]["dcnt_nom"] . ' ' . $docente[$i]["dcnt_ape"]; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $mats = $objGen->getMats(1);
                                    ?>
                                    <select size="1" id="materia" name="materia" class="medium required" onchange="javascript:selectgradeA(this.value);" style=" width: 220px;">
                                        <option value="">Seleccionar Materia</option>

                                    </select>
                                </td>
                                <td>
                                    <select style="width: 150px; margin-left: 20px;  margin-right: 20px;" id="grado" name="grado" class="medium required">
                                        <option value="">Seleccionar Grado</option>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    #$periodos = $objGen->enabledPeriod();
                                    ?>
                                    <select style="width: 150px; margin-right: 20px;" id="grade" name="periodo" class="medium required">
                                        <option value="">Seleccionar Periodo</option>
                                        <?php #for ($i = 0; $i < count($periodos); $i++): ?>
                                            <!--<option value="<?php #echo $periodos[$i]["idp"]; ?>"><?php #echo utf8_encode($periodos[$i]["nombrep"]); ?></option>-->
                                        <?php #endfor; ?>
                                            <option value="1">Primero Periodo</option>
                                            <option value="2">Segundo Periodo</option>
                                            <option value="3">Tercer Periodo</option>
                                            <option value="4">Cuarto Periodo</option>
                                    </select>
                                </td>

                                <td>
                                    <button type="submit" name="colectorNotas" value="1" class="button">Continuar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </article>
        </section>
       
        <?php if($_SESSION["sys_continue"]): ?>
        <section id="main" class="grid_12 ">
            <script type="text/javascript">
                jQuery(function(){
                     jQuery("#none").click();
                });
            </script>
               
        	<article>
                     <a href="#" onclick="javascript:jQuery.scrollTo('#notas',800);" style="display: none;" id="none">none</a>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { 
                            switch ($_GET["ok"]) {
                            case "yes":
                                echo "<div class='success msg'>Notas Almacenadas Exitosamente!. Click para Cerrar</div>";
                                break;
                            case "clear":
                                echo "<div class='success msg'>Notas Limpiadas Exitosamente!. Click para Cerrar</div>";
                                break;
                        }
                    } ?>
        		<p style="font-size: 14px;">Usted est&aacute; ingresando notas para la materia:<b> <?php echo $_SESSION["sys_mt"];?></b>, para el : <b><?php echo $_SESSION["sys_gr"];?></b>, del  <b><?php echo $_SESSION["sys_pe"];?></b> periodo:</p>
        		<form name="saveNotes" id="saveNotes" action="save_notas_admin.php" method="post">   
        		<div  id="notas"style="width: 100%; height: 400px; overflow: auto;">
                        <?php GetTable($objGen); ?>
                        </div>  
                        <button type="submit" name="save_notes" value="ok" class="button" style="margin-top:10px;">Guardar</button>
                        <?php 
                        $url_report = ($_SESSION["sys_glv"] == "primaria")? "report_nxpp.php" : "report_nxp.php"; 
                        ?>        		
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL . $url_report;?>?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION["sys_docente_nom"];?>"id="report" title="Notas por Periodo" class="button">Notas por Periodo</a> 
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_nfp.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_SESSION["sys_docente_nom"];?>"id="report" title="Notas Finales" class="button">Notas Finales</a> 
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_grafica_repoxp.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_POST['docente'];?>"id="report" title="Grafico por Periodo" class="button">Grafico por Periodo</a> 
                        <a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>report_grafica_repofin.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&opt=<?php  echo $_SESSION["sys_glv"];?>&mat_id=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gr_id=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_POST['docente'];?>"id="report" title="Grafico Final" class="button">Grafico Final</a> 
						<a style="padding: 8px 10px;"href="<?php echo SITE_URL;?>select_month.php?mat=<?php echo $_SESSION["sys_mt"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr"];?>&gradeid=<?php  echo $_SESSION["sys_gr_id"];?>&docnt=<?php  echo $_POST['docente']; ?>" id="report" title="Generar Asistencia" class="button">Asistencia</a> 	
                        <button type="button" name="clearnotas" onClick="javascript:if(confirm('Usted esta a punto de Limpiar la Base de Datos de notas para esta materia ? \n Processo Irreversible. los datos no se podran recuperar .! Desea Continuar ? ')){location.replace('save_notas_admin.php?opt=clear&mat=<?php echo $_SESSION["sys_mt_id"]; ?>&period=<?php echo $_SESSION["sys_pe"]; ?>&grade=<?php  echo $_SESSION["sys_gr_id"];?>')}else{return false;}" value="ok" class="button">Limpiar Notas</button>
                        
                       
                        </form>
                        
        	</article>
        </section>
        <?php endif;?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>
