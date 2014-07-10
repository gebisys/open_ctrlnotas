<?php
include_once "includes/config.php";
__is__login();
$generic = new Generic($db);
define('SECTION', ' Periodos');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12">
            <article id="dashboard">
                <h1><?php echo SECTION ?></h1>
                 <section class="icons">
                    <ul>
                         <?php
                        $dato = $generic->getPeriodos();
                        for ($i = 0; $i < count($dato); $i++): ?>
                       <li>
                            <a href="periodo_edit.php?cod=<?php echo $dato[$i]['prdo_id'];?>&token=<?php echo md5($dato[$i]['prdo_id']); ?>" id="edit" title="Periodo :<?php echo $dato[$i]['prdo_id']; ?>" >
                                <img src="images/eleganticons/calendar.png" />
                                <span><?php echo $dato[$i]['prdo_nom']; ?></span>
                            </a>
                        </li>
                 <?php endfor;?>
                    </ul>
                </section>
            </article>
        </section>


    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>
