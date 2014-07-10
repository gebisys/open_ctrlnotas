<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulos del Sistema');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article id="dashboard">
                <h1>Modulos</h1>
                <section class="icons">
                    <ul>
                        <!--<li>
                            <a href="admin.php">
                                <img src="images/eleganticons/administrador.png" />
                                <span>Administrador</span>
                            </a>
                        </li>-->
                        <li>
                            <a href="users.php">
                                <img src="images/eleganticons/Person-group.png" />
                                <span>Usuarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="alumnos.php">
                                <img src="images/eleganticons/alumnos.png" />
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="docentes.php">
                                <img src="images/eleganticons/docentes.png" />
                                <span>Docentes</span>
                            </a>
                        </li>                                
                        <li>
                            <a href="#">
                                <img src="images/eleganticons/Config.png" />
                                <span>Config</span>
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
