<?php
include_once "includes/config.php";
__is__login();

define('SECTION', 'Bienvenido al Sistema | Portal Docente');
include_once '../templates/site_top_docente.php';
?>

        <section id="content">
            <section class="container_12 clearfix">
                <section id="main" class="grid_12">
                    <article id="dashboard">
                        <h1><?php echo SECTION ?></h1>
                               
			</article>
                </section>

               
            </section>
        </section>

<?php
include_once '../templates/site_bottom.php';
?>
