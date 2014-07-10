<?php
include_once "includes/config.php";
__is__login();
$docnt = new Docente($db);
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod"])):
    $data = $docnt->getDocente($_GET["cod"]);
endif;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateDocente"])) {
    if (isset($_POST['changepwd'])) {
        $docnt->updateDocente(1);
    } else {
        $docnt->updateDocente();
    }
    header('location:' . $_SERVER["PHP_SELF"] . '?ok=confirm&msg=' . md5('token') . '&cod=' . $_POST['id']);
}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/blue.css" title="blue" />

        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/orange.css" title="orange" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/red.css" title="red" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/green.css" title="green" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/purple.css" title="purple" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/yellow.css" title="yellow" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/black.css" title="black" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/skins/gray.css" title="gray" />

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/superfish.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/uniform.default.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/jquery.wysiwyg.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/facebox.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/smoothness/jquery-ui-1.8.8.custom.css" />

        <!--[if lte IE 8]>
        <script type="text/javascript" src="js/html5.js"></script>
        <script type="text/javascript" src="js/selectivizr.js"></script>
        <script type="text/javascript" src="js/excanvas.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/Delicious_500.font.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.flot.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/facebox.js"></script>



        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/jquery.cookie.js"></script>

        <script type="text/javascript" src="<?php echo SITE_URL; ?>js/switcher.js"></script>

    </head>
    <body style="background-color: #fff;">

        <h1>Acualizar Registro</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"])) { ?>
            <div class="success msg">Registro Actualizado Exitosamente!. Click para Cerrar</div>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                        
                    setTimeout(function(){
                        jQuery("#fancybox-close").click();
                    }, 2500);

                });
            </script>
        <?php } ?>
        <form id="myForm" name="myForm" class="uniform" method="POST">
            <fieldset>
                <legend>Datos Principales</legend>
                <dl class="inline">
                    <dt><label for="name">Nombre</label></dt>
                    <dd>
                        <input type="hidden" name="id" value ="<?php echo $data[0]["dcnt_id"]; ?>" />
                        <input type="text" id="name" name="name" value ="<?php echo $data[0]["dcnt_nom"]; ?>" class="medium required" size="50" />
                    </dd>
                    <dt><label for="ape">Apellidos</label></dt>
                    <dd>
                        <input type="text" id="ape" name="ape" value ="<?php echo $data[0]["dcnt_ape"]; ?>" class="medium required" size="50" />
                    </dd>                          
                    <dt><label for="grade">Cargo</label></dt>
                    <dd>
                        <select size="1" id="grade" name="cargo"class="medium required">
                            <?php $cargo = ($data[0]["dcnt_cargo"] == 1)? "Guia":"Auxiliar"; ?>
                            <option value="<?php echo $data[0]["dcnt_cargo"]; ?>"><?php echo $cargo; ?></option>
                            <option value="1">Guia</option>
                            <option value="2">Auxiliar</option>
                        </select>
                    </dd>
                    <dt><label for="email">E-mail</label></dt>
                    <dd>
                        <input type="text" id="email" name="email" value ="<?php echo $data[0]["dcnt_email"]; ?>" class="medium required" size="50" />
                    </dd>
                </dl>
            </fieldset>
            <fieldset>
                <legend>Datos Portal</legend>
                <dl class="inline">
                    <dt><label for="user">Usuario</label></dt>
                    <dd>
                        <input type="text" id="user" name="user"  value ="<?php echo $data[0]["dcnt_user"]; ?>" class="medium required" size="50" />
                        <small>Nombre de Usuario para el portal</small>
                    </dd>
                    <dt><label for="password">Contrase&ntilde;a</label></dt>
                    <dd>
                         <small>Click para Cambiar Contrase&ntilde;a</small>
                        <input name="changepwd" type="checkbox" id="changepwd" onclick="document.myForm.password.disabled=!document.myForm.password.disabled" value="Cambiar Password">                        
                        <input type="password" id="password" name="password" class="medium required"  disabled/>
                    </dd>
                </dl>                    
                <div class="buttons">
                    <button type="submit" name="updateDocente" value="" class="button">Agregar</button>
                    <button type="button" class="button white">Cancelar</button>
                </div>
            </fieldset>
        </form>

    </body>    
</html>