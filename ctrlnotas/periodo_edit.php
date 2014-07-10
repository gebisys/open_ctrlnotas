<?php
include_once "includes/config.php";
__is__login();
$generic = new Generic($db);
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod"])):
    $data = $generic->getPeriodo($_GET["cod"]);
endif;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
    $generic->updatePeriodo();
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
            <fieldset>
            <legend>Datos Principales</legend>
            <dl class="inline">
                <dt><label for="mat">Periodo</label></dt>
                <dd>
                    <input type="hidden" name="id" value="<?php echo $data[0]['prdo_id'];?>"/>
                    <input type="text" id="mat" name="nom" value="<?php echo $data[0]['prdo_nom'];?>" class="medium required" size="50" />
                    <small>Nombre del Periodo</small>
                </dd>
                 <dt><label for="tipo">Estado</label></dt>
                    <dd>
                        <select size="1" id="tipo" name="status"class="medium required">
                            <?php $cargo = ($data[0]["prdo_status"] == 1)? "Habilitado":"Deshabilitado"; ?>
                            <option value="<?php echo $data[0]["prdo_status"]; ?>"><?php echo $cargo; ?></option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                        <small>Para habilitar el ingreso de notas al sistema</small>
                    </dd>
                 <dt><label for="tipo">Activar Ingreso</label></dt>
                    <dd>
                        <select size="1" id="tipo" name="enable"class="medium required">
                            <?php 
                            	if($data[0]["enabled_period"] == 1){ $enable = "Primer 50%";}elseif($data[0]["enabled_period"] == 2) {$enable = "Segundo 50%";}else{$enable="Completo";} 
                            
                            ?>
                            <option value="<?php echo $data[0]["prdo_status"]; ?>"><?php echo $enable; ?></option>
                            <option value="1">Primer 50%</option>
                            <option value="2">Segundo 50%</option>
                            <option value="0">Completo</option>
                        </select>
                        <small>Para habilitar el ingreso de notas al sistema seleccionado el porcentaje a ingresar</small>
                    </dd>
            </dl>                    
            <div class="buttons">
                <button type="submit" name="save" value="" class="button">Guardar</button>
                <!--<button type="button" class="button white">Cancelar</button>-->
            </div>
        </fieldset>
    </form>

</body>    
</html>