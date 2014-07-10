<?php
include_once "includes/config.php";
__is__login();
#titulo de la seccion
define('SECTION', 'Registro de Alumnos');
#Verificamos las variables a almacenar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveAlumn"]) ) {
    $alumn = new Alumno($db);
    $alumn->insertAlumn();
    header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token'));
}
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Registar Alumna</h1>
                <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Alumna Registrada Exitosamente!. Click para Cerrar</div>
                <?php } ?>
                <form id="myForm" class="uniform" action="" method="POST">
                    <fieldset>
                        <legend>Datos Principales</legend>
                        <dl class="inline">
                            <dt><label for="name">Nombre</label></dt>
                            <dd>
                                <input type="text" id="name" name="name" class="medium required" size="50" />
                            </dd>
                            <dt><label for="ape">Apellidos</label></dt>
                            <dd>
                                <input type="text" id="ape" name="ape" class="medium required" size="50" />
                            </dd>                          
                            <dt><label for="grade">Grado</label></dt>
                            <dd>
                                <?php 
                                    $grade = new Generic($db);
                                    $grades = $grade->GetGrades();                                   
                                ?>
                                <select size="1" id="grade" name="grade"class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($grades); $i++): ?>
                                        <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo $grades[$i]["nombre_gra"]; ?></option>
                                    <?php endfor; ?>                                    
                                        <option value="0">No Activa</option>
                                </select>
                            </dd>
                            <dt><label for="matricul">Matricula</label></dt>
                            <dd>
                                <input type="text" id="matricul" name="matricula" class="medium required" maxlength="4" />
                            </dd>
                            <dt><label for="emple">NIE</label></dt>
                            <dd>
                                <input type="text" id="emple" name="nie" class="medium required" size="50" />
                                <small>Codigo de la Alumna</small>
                            </dd>
                            <dt><label for="password">Contrase&ntilde;a</label></dt>
                            <dd>
                                <input type="password" id="password" name="pwd" class="medium required" />
                                <small>Contrase&ntilde;a para el portal de notas</small>
                            </dd>
                        </dl>                    
                        <div class="buttons">
                            <button type="submit" name="saveAlumn" value="" class="button">Agregar</button>
                            <button type="button" class="button white">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
 <?php
                   # messages();
		?>
            </article>
        </section>

        <?php include_once 'templates/aside_alumnos.php'; ?>
    </section>
</section>

<?php



include_once 'templates/site_bottom.php';
?>


