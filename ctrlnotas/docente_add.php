<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Registro de Docentes');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveDocente"]) ) {
    $docnt = new Docente($db);
    $docnt->insertDocente();
    header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token'));
}
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Registar Docente</h1>
                <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Docente Registrado Exitosamente!. Click para Cerrar</div>
                <?php } ?>
                <form id="myForm" class="uniform" method="POST">
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
                            <dt><label for="grade">Cargo</label></dt>
                            <dd>
                                <select size="1" id="grade" name="cargo"class="medium required">
                                    <option value="1">Guia</option>
                                    <option value="2">Auxiliar</option>
                                </select>
                            </dd>
                            <dt><label for="email">E-mail</label></dt>
                            <dd>
                                <input type="text" id="email" name="email" class="medium required" size="50" />
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Datos Portal</legend>
                        <dl class="inline">
                             <dt><label for="user">Usuario</label></dt>
                            <dd>
                                <input type="text" id="user" name="user" class="medium required" size="50" />
                                <small>Nombre de Usuario para el portal</small>
                            </dd>
                            <dt><label for="password">Contrase&ntilde;a</label></dt>
                            <dd>
                                <input type="password" id="password" name="pwd" class="medium required" />
                                <small>Contrase&ntilde;a para el portal de notas</small>
                            </dd>
                        </dl>                    
                        <div class="buttons">
                            <button type="submit" name="saveDocente" value="" class="button">Agregar</button>
                            <button type="button" class="button white">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
                
            </article>
        </section>

        <?php include_once 'templates/aside_docente.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


