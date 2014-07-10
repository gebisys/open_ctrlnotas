<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Carga Academica a Doncentes');
$generic = new Generic($db);
$asignacion = new Asignaciones($db);
#Verificamos las variables a almacenar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"]) ) {
    $asignacion->saveAsignacion();
    header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token'));
}
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Carga Academica a Docentes</h1>
                 <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Alumna Registrada Exitosamente!. Click para Cerrar</div>
                <?php } ?>
                <form id="myForm" class="uniform" method="POST">
                    <fieldset>
                        <legend>Datos Principales</legend>
                        <dl class="inline">

                            <dt><label for="grade">Docente</label></dt>
                            <dd>
                                <?php
                                    $docnt = new Docente($db);
                                    $docente = $docnt->getDocentes(100);                        
                                ?>
                                <select size="1" id="grade" name="docente" class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($docente); $i++): ?>
                                        <option value="<?php echo $docente[$i]["dcnt_id"]; ?>"><?php echo ($docente[$i]["dcnt_nom"]) . ' ' . ($docente[$i]["dcnt_ape"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </dd>
                            <dt><label for="grade">Materia</label></dt>
                            <dd>
                                <?php 
                                    $mate = new Materias($db);
                                    $dat = $mate->getMaterias(100);
                                ?>
                                <select size="1" id="grade" name="mate"class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($dat); $i++): ?>
                                        <option value="<?php echo $dat[$i]["id_mat"]; ?>"><?php echo utf8_encode($dat[$i]["nombre_mat"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </dd>
                            <dt><label for="grade">Grado</label></dt>
                            <dd>
                                <?php                                     
                                    $grades = $generic->GetGrades();                                   
                                ?>
                                <select size="1" id="grade" name="grade"class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($grades); $i++): ?>
                                        <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo ($grades[$i]["nombre_gra"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </dd>
                        </dl>                    
                        <div class="buttons">
                            <button type="submit" name="save" value="" class="button">Agregar</button>
                            <button type="button" class="button white">Cancelar</button>
                        </div>
                    </fieldset>
                </form>

            </article>
        </section>

        <?php include_once 'templates/aside_cacademica.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


