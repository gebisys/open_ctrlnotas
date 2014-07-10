<?php
include_once "includes/config.php";
$mate = new Materias($db);
$Mat = $mate->getMateria($_GET['mat']);
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

        <h1>Seleccione Mes</h1>
    
        <form id="myForm" name="myForm" class="uniform" action="report_asistencia.php" method="POST">
            <fieldset>
            <legend>MES</legend>
            <dl class="inline">
                <dt><label for="mat">Mes</label></dt>
                <dd>
                    <input type="hidden" name="docnt" value="<?php echo $_GET['docnt'];?>"/>
                    <input type="hidden" name="mat" value="<?php echo $_GET['mat'];?>"/>
                    <input type="hidden" name="gradeid" value="<?php echo $_GET['gradeid'];?>"/>
                    <input type="hidden" name="period" value="<?php echo $_GET['period'];?>"/>
                    <input type="hidden" name="grade" value="<?php echo $_GET['grade'];?>"/>
                    <select size="1" id="grade" name="mes"class="medium required">
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                    </select>
                </dd>
            </dl>                    
            <div class="buttons">
                <button type="submit" name="generate" value="ok" class="button">Generar</button>
            </div>
        </fieldset>
    </form>

</body>    
</html>