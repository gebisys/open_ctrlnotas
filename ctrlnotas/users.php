<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulos Usuarios');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1>Modulo | Usuarios</h1>
            </article>
        </section>

        <?php include_once 'templates/aside_user.php';?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>

