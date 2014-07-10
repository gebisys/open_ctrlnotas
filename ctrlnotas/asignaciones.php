<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Asingaciones de Materias a Docentes');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article>
                <h1>Modulo | Carga Academica</h1>
                <p>En este Modulo podras registar, modificar y eliminar la Carga Academica de los Docentes</p>
            </article>
        </section>

        <?php include_once 'templates/aside_cacademica.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>

