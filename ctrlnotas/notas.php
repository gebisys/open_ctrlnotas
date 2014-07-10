<?php
include_once "includes/config.php";
include_once 'portal_docente/class/Generica.php';

__is__login();
$objGen = new Generica($db);
$objGeneric = new Generic($db);
define('SECTION', 'Modulos de Registro Academico');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">        
        <section id="main" class="grid_12 ">
            <article >
                <h1>Boletas por Periodo</h1>
                <form name="bnotas" id="bnotas" action="" method="POST" >
                    <table>
                        <tbody>
                            <tr>                                
                                <td>
                                     <?php 
                                    $grades = $objGeneric->GetGrades();                                   
                                ?>
                                <select size="1" id="grade" name="grade"class="medium required" style=" width: 150px; margin-right: 20px;">
                                        <option value="">Seleccionar Grado</option>
                                    <?php for ($i = 0; $i < count($grades); $i++): ?>
                                        <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo $grades[$i]["nombre_gra"]; ?></option>
                                    <?php endfor; ?>
                                </select>
                                </td>
                                <td>
                                    <?php
                                    #$periodos = $objGen->enabledPeriod();
                                    ?>
                                    <select style="width: 150px; margin-right: 20px;" id="periodo" name="periodo" class="medium required">
                                        <option value="">Seleccionar Periodo</option>
                                        <?php #for ($i = 0; $i < count($periodos); $i++): ?>
                                           <!-- <option value="<?php #echo $periodos[$i]["idp"]; ?>"><?php #echo utf8_encode($periodos[$i]["nombrep"]); ?></option>-->
                                        <?php #endfor; ?>
                                            <option value="1">Primero Periodo</option>
                                            <option value="2">Segundo Periodo</option>
                                            <option value="3">Tercer Periodo</option>
                                            <option value="4">Cuarto Periodo</option>
                                    </select>
                                </td>
                                 <td>
                                     <input type="text" name="year" maxlenght="4" title="a&ntilde;o"style="width: 50px; margin-right: 20px;">
                                </td>
                                <td>
                                    <button type="submit" name="bnotarsub" value="1" class="button">Generar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </article>
        </section>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bnotarsub"]) ) { ?>
        <script type="text/javascript">
                jQuery(function(){
                     jQuery("#none").click();
                });
            </script>
        <section id="main" class="grid_12 ">
            <article> 
                <a href="#" onclick="javascript:jQuery.scrollTo('#notas',800);" style="display: none;" id="none">none</a>
                <?php echo " <iframe id='notas' src='report_boletas.php?grade=".$_POST['grade']."&period=".$_POST['periodo']."&year=".$_POST['year']."' width='100%' height='500'></iframe>";  ?>
            </article>
        </section>
        <?php        
            }
        ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>
