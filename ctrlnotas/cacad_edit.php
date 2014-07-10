<?php
include_once "includes/config.php";
__is__login();
$generic = new Generic($db);
$asignacion = new Asignaciones($db);
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod"])):
    $data = $asignacion->getAsignacion($_GET["cod"]);
endif;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $asignacion->updateAsignacion();
    header('location:' . $_SERVER["PHP_SELF"] . '?ok=confirm&msg=' . md5('token') . '&cod=' . $_POST['code']);
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
                    <dt><label for="grade">Docente</label></dt>
                    <dd>
                        <?php
                        $docnt = new Docente($db);
                        $docente = $docnt->getDocentes(100);
                        ?>
                        <select size="1" id="grade" name="docente" class="medium required">
                            <option value="<?php echo $data[0]['dcnt_id']; ?>"><?php $nameDocent = $docnt->getDocente($data[0]['dcnt_id']);  echo $nameDocent[0]['dcnt_nom'] . ' ' . $nameDocent[0]['dcnt_ape']; ?></option>
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
                            <option value="<?php echo $data[0]['id_mat']; ?>"><?php $nameMate = $mate->getMateria($data[0]['id_mat']); echo $nameMate[0]['nombre_mat']; ?></option>
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
                             <option value="<?php echo $data[0]['id_gra']; ?>"><?php $nameGrade = $generic->getNameGrade($data[0]['id_gra']); echo ($nameGrade[0]['nombre_gra']); ?></option>
                            <?php for ($i = 0; $i < count($grades); $i++): ?>
                                <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo ($grades[$i]["nombre_gra"]); ?></option>
                            <?php endfor; ?>
                        </select>
                    </dd>
                </dl>                    
                <div class="buttons">
                    <input type="hidden" name="code" value="<?php echo $data[0]["code_asig"] ?>"/>
                    <button type="submit" name="update" value="" class="button">Agregar</button>
                    <button type="button" class="button white">Cancelar</button>
                </div>
            </fieldset>
        </form>

    </body>                                         
</html>