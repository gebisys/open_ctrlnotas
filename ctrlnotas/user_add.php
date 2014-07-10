<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Registrar Usuarios');
#Verificamos las variables a almacenar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveuser"]) ) {
    $login = new Login($db);
    if($login->saveUser()){
        header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token'));
    }
    
}
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Registar Usuario</h1>
                <?php if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Usuario Registrada Exitosamente!. Click para Cerrar</div>
                <?php }?>
                <form id="myForm" class="uniform" method="POST">
                    <fieldset>
                        <legend>Datos Principales</legend>
                        <dl class="inline">
                            <dt><label for="user">Usuario</label></dt>
                            <dd>
                                <input type="text" id="user" name="user" class="medium required" size="50" />
                                <small>Usuario para entrar al sistema</small>
                            </dd>
                            <dt><label for="password">Contrase&ntilde;a</label></dt>
                            <dd>
                                <input type="password" id="password" name="pwd" class="medium required" />
                                <small>Contrase&ntilde;a con la que ingresara</small>
                            </dd>
                            <dt><label for="tipo">Tipo</label></dt>
                            <dd>
                                <select size="1" id="tipo" name="tipo"class="medium required">
                                    <option value="1">Administrador</option>
                                    <option value="2">Registro Academico</option>
                                </select>
                                <small>Tipo de Acceso para el sistema</small>
                            </dd>
                            <dt><label for="emple">Empleado</label></dt>
                            <dd>
                                <input type="text" id="emple" name="emple" class="medium required" size="50" />
                                <small>Codigo del Empleado</small>
                            </dd>
                        </dl>                    
                        <div class="buttons">
                            <button type="submit" name="saveuser" value="" class="button">Agregar</button>
                            <button type="button" class="button white">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
                
            </article>
        </section>

        <?php include_once 'templates/aside_user.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


