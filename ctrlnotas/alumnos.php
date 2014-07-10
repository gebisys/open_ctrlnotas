<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulo | Alumnos');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article>
                <h1><?php echo SECTION ?></h1>
                <p>En este Modulo podras registar, modificar y eliminar alumnos</p>
            </article>
        </section>

        <?php include_once 'templates/aside_alumnos.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>

