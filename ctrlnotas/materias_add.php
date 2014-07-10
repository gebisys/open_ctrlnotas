<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Registro de Materias');
#Verificamos las variables a almacenar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"]) ) {
    $mate = new Materias($db);
    $mate->insertMateria();
    header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token')); 
    
}
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Registro de Materias</h1>
                 <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Docente Registrado Exitosamente!. Click para Cerrar</div>
                <?php } ?>
                <form id="myForm" class="uniform" method="POST">
                    <fieldset>
                        <legend>Datos Principales</legend>
                        <dl class="inline">
                            <dt><label for="mat">Materia</label></dt>
                            <dd>
                                <input type="text" id="mat" name="mat" class="medium required" size="50" />
                                <small>Nombre de la Materia a Registrar</small>
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

        <?php include_once 'templates/aside_materias.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


