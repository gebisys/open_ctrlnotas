<?php
include_once "includes/config.php";
__is__login();
$alumn = new Alumno($db);
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod"])):
    $data = $alumn->getAlumn($_GET["cod"]);
endif;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateAlumn"])) {
    if (isset($_POST['changepwd'])) {
        $alumn->updateAlumn(1);
    } else {
        $alumn->updateAlumn();
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
        <form id="myForm" name="myForm" class="uniform" action="" method="POST">
            <fieldset >
                <legend>Datos Principales</legend>
                <dl class="inline">
                    <dt><label for="name">Nombre</label></dt>
                    <dd>
                        <input type="hidden" name="id" value="<?php echo $data[0]["id_alumn"] ?>"/>
                        <input type="text" id="name" name="name" value ="<?php echo $data[0]["alumn_nomb"]; ?>" class="medium required" size="50" />
                    </dd>
                    <dt><label for="ape">Apellidos</label></dt>
                    <dd>
                        <input type="text" id="ape" name="ape"value ="<?php echo $data[0]["alumn_apell"]; ?>" class="medium required" size="50" />
                    </dd>                          
                    <dt><label for="grade">Grado</label></dt>
                    <dd>
                        <?php
                        $grade = new Generic($db);
                        $grades = $grade->GetGrades();
                        ?>
                        <select size="1" id="grade" name="grade"class="medium required">
                            <option value="<?php echo $data[0]["cod_grado"]; ?>"><?php $nameGrade = $grade->getNameGrade($data[0]["cod_grado"]); echo $nameGrade[0]['nombre_gra']; ?></option>
                            <?php for ($i = 0; $i < count($grades); $i++): ?>
                                <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo $grades[$i]["nombre_gra"]; ?></option>
                            <?php endfor; ?>
								<option value="0">No Activa</option>
                        </select>
                    </dd>
                    <dt><label for="matricul">Matricula</label></dt>
                    <dd>
                        <input type="text" id="matricul" name="matricula" class="medium required" maxlength="4" value="<?php echo $data[0]["matricula"]; ?>" />
                    </dd>
                    <dt><label for="emple">NIE</label></dt>
                    <dd>
                        <input type="text" id="emple" name="nie" value ="<?php echo $data[0]["alumn_code"]; ?>" class="medium required" size="50" />
                        <small>Codigo de la Alumna</small>
                    </dd>
                    <dt><label for="password">Contrase&ntilde;a</label></dt>
                    <dd>                        
                        <small>Click para Cambiar Contrase&ntilde;a</small>
                        <input name="changepwd" type="checkbox" id="changepwd" onclick="document.myForm.password.disabled=!document.myForm.password.disabled" value="Cambiar Password">                        
                        <input type="password" id="password" name="password" class="medium required"  disabled/>
                    </dd>
                </dl>                    
                <div class="buttons">
                    <button type="submit" name="updateAlumn" value="" class="button">Actualizar</button>
                </div>
            </fieldset>
        </form>

    </body>    
</html>
