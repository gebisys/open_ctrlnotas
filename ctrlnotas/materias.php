<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulos de Materias');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article>
                <h1>Modulo | Materias</h1>
                <p>En este Modulo podras registar, modificar y eliminar Materias</p>
            </article>
        </section>

        <?php include_once 'templates/aside_materias.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>

