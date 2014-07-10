<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Listado de Materias');
$mate = new Materias($db);
$mate->totalMaterias();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])):
    $mate->deleteMateria();
    header('location:' . $_SERVER["PHP_SELF"] . '?ok=confirm&msg=' . md5('token'));
endif;
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article>
                <h1><?php echo SECTION ?></h1>
                <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"])) { ?>
                    <div class="success msg">Registro Eliminado Exitosamente!. Click para Cerrar</div>
                <?php } ?>
                <h2>Registros : <?php echo $mate->total->Total; ?></h2>

                <table id="table1" class="gtable sortable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Materia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dat = $mate->getMaterias(10);
                        for ($i = 0; $i < count($dat); $i++):
                            ?>
                            <tr>
                                <td><?php echo $dat[$i]['id_mat']; ?></td>
                                <td><?php echo $dat[$i]['nombre_mat']; ?></td>
                                <td>
                                    <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                    <a href="materia_edit.php?cod=<?php echo $dat[$i]['id_mat']; ?>&token=<?php echo md5($dat[$i]['id_mat']) ?>" id="edit" title="Editar Materia: <?php echo $dat[$i]['id_mat']; ?>"><img src="images/icons/edit.png" alt="Editar Materia <?php echo $dat[$i]['id_mat']; ?>" /></a>
                                    <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $dat[$i]['id_mat']; ?>&token=<?php echo md5($dat[$i]['id_mat']) ?>')}else{return false;}" title="Eliminar Materia: <?php echo $dat[$i]['id_mat']; ?>"><img src="images/icons/cross.png" alt="Eliminar Docente <?php echo $dat[$i]['id_mat']; ?>" /></a>
                                </td>
                            </tr>

                        <?php endfor; ?>

                    </tbody>
                </table>
                <div class="tablefooter clearfix">
                    <div class="pagination">

                        <?php echo $mate->paginator->showPaginator(); ?>
                    </div>
                </div>
            </article>
        </section>

        <?php include_once 'templates/aside_materias.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


