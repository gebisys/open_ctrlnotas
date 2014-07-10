<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulos de Registro Academico');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article id="dashboard">
                <h1>Modulos</h1>
                <section class="icons">
                    <ul>
                       <li>
                            <a href="<?php echo SITE_URL;?>notas.php">
                                <img src="images/eleganticons/notas.png" />
                                <span>Notas</span>
                            </a>
                        </li>
                <?php if($_SESSION['sys_user_level']==='1'): ?>
                         <li>
                            <a href="<?php echo SITE_URL;?>colector_notas.php">
                                <img src="images/eleganticons/notas.png" />
                                <span>Colector Notas</span>
                            </a>
                        </li>
                <?php endif ?>
                        <li>
                            <a href="<?php echo SITE_URL;?>materias.php">
                                <img src="images/eleganticons/materias.png" />
                                <span>Materias</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>period.php">
                                <img src="images/eleganticons/notes.png" />
                                <span>Periodos</span>
                            </a>
                        </li>                                                       
                        <!--<li>
                            <a href="#<?php echo SITE_URL;?>news.php">
                                <img src="images/eleganticons/news.png" />
                                <span>Avisos</span>
                            </a>
                        </li>-->
                         <li>
                            <a href="<?php echo SITE_URL;?>asignaciones.php">
                                <img src="images/eleganticons/Paper-pencil.png" />
                                <span>Carga Academica</span>
                            </a>
                        </li>
                    </ul>
                </section>

            </article>
            
        </section>


    </section>
</section>

<?php

include_once 'templates/site_bottom.php';
?>
