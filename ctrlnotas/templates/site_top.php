<?php $main_cur=""; $cur = basename(str_replace(".php", "", $_SERVER['SCRIPT_NAME'])); $sub=substr($cur,0,4);?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title><?php echo TITLE_SITE . ' | ' . SECTION ; ?></title>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/blue.css" title="blue" />

        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/orange.css" title="orange" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/red.css" title="red" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/green.css" title="green" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/purple.css" title="purple" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/yellow.css" title="yellow" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/black.css" title="black" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/skins/gray.css" title="gray" />

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/superfish.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/uniform.default.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery.wysiwyg.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/facebox.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/smoothness/jquery-ui-1.8.8.custom.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery.fancybox-1.3.4.css" />

        <!--[if lte IE 8]>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/html5.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/selectivizr.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/excanvas.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/Delicious_500.font.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.flot.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.scrollTo.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/facebox.js"></script>
        
        <!--FancyBox-->
        
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.fancybox-1.3.4.pack.js"></script>
        <!--/End FacyBox-->
        
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.cookie.js"></script>
        
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/switcher.js"></script>
         <!--URL del sitio-->
	<script type="text/javascript">var url = "<?php echo SITE_URL;?>";</script>
        <!--/URL-->
        <!--Main Script-->
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/script.js"></script>
        <!--End Main Script-->
      
    </head>
    <body>

        <header id="top">
            <div class="container_12 clearfix">
                <div id="logo" class="grid_5">
                    <!--<img src="images/logo64.png" >-->
                    <!-- replace with your website title or logo -->
                    <a id="" href="<?php echo SITE_URL;?>index.php"><?php echo  COMPANY ; ?></a>
                </div>

                <div class="grid_4" id="colorstyle">
                    <div>Cambiar Color</div>
                    <a href="#" rel="blue"></a>
                    <a href="#" rel="green"></a>
                    <a href="#" rel="red"></a>
                    <a href="#" rel="purple"></a>
                    <a href="#" rel="orange"></a>
                    <a href="#" rel="yellow"></a>
                    <a href="#" rel="black"></a>
                    <a href="#" rel="gray"></a>
                </div>

                <div id="userinfo" class="grid_3">
			Bienvenido, <a href="#"><?php echo  $_SESSION['sys_user'];?></a>
                </div>
            </div>
        </header>

        <nav id="topmenu">
            <div class="container_12 clearfix">
                <div class="grid_12">
                    <ul id="mainmenu" class="sf-menu">
                        <li class="<?php $main_cur =($sub=="inde")?'current':''; echo $main_cur;?>"><a href="<?php echo SITE_URL;?>index.php">Inicio</a></li>
                        <li class="<?php $main_cur =($sub=="modu")?'current':''; echo $main_cur;?>"><a href="<?php echo SITE_URL;?>modules.php">Modulos</a>
                             <ul>
                                <li><a href="<?php echo SITE_URL;?>alumnos.php">Alumnas</a></li>
                                <li><a href="<?php echo SITE_URL;?>docentes.php">Docentes</a></li>
                                <?php if($_SESSION['sys_user_level']==='1'): ?>
                                <li><a href="<?php echo SITE_URL;?>users.php">Usuarios</a></li>
                                <!--<li><a href="#<?php echo SITE_URL;?>settings.php">Configuracion</a></li>-->
                                 <?php endif ?>
                            </ul>
                        </li>
                        <li class="<?php $main_cur =($sub=="reg_")?'current':''; echo $main_cur;?>"><a href="<?php echo SITE_URL;?>reg_acad.php">Registro Academico</a>
                             <ul>
                             	  <?php if($_SESSION['sys_user_level']==='1'): ?>
                                <li><a href="<?php echo SITE_URL;?>period.php">Periodos</a></li>
                             	  <?php endif ?>
                                <li><a href="<?php echo SITE_URL;?>materias.php">Materias</a></li>
                                <li><a href="<?php echo SITE_URL;?>asignaciones.php">Carga Academica</a></li>
                                <li><a href="<?php echo SITE_URL;?>notas.php ">Boletas de Notas</a></li>
                                <li><a href="<?php echo SITE_URL;?>report_final.php">Reporte Final</a></li>
                                <?php if($_SESSION['sys_user_level']==='1'): ?>
                                    <li><a href="<?php echo SITE_URL;?>colector_notas.php ">Colector Notas</a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                        <li><a href="#">Dise&ntilde;o</a>
                            <ul id="layoutwidth">
                                <li><a href="#" rel="fixed">Fijo</a></li>
                                <li><a href="#" rel="fluid">Automatico</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul id="usermenu">
                        <li><a href="kill-session.php">Cerrar Sesi&oacute;n</a></li>
                    </ul>
                </div>
            </div>
        </nav>
