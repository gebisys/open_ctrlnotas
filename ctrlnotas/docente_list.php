<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Listado de Docentes');
$docnt = new Docente($db);
$docnt->totalDocentes();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])):
    $docnt->deleteDocente();
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
                <h2>Registros : <?php echo $docnt->total->Total; ?></h2>
                <div style="width: 100%;overflow: auto;">
                <table id="table1" class="gtable sortable" style="width: 1000px;">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Acciones</th>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Cargo</th>
                            <th>E-mail</th>
                            <th>Estado</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $docente = $docnt->getDocentes(13);
                        for ($i = 0; $i < count($docente); $i++):
                            ?>
                            <tr>
                                <td>
                                    <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                    <a href="docente_edit.php?cod=<?php echo $docente[$i]["dcnt_id"] ?>&token=<?php echo md5($docente[$i]["dcnt_id"]) ?>" id="edit" title="Editar Docente: <?php echo $docente[$i]["dcnt_id"] ?>"><img src="images/icons/edit.png" alt="Editar Docente <?php echo $docente[$i]["dcnt_id"] ?>" /></a>
                                    <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $docente[$i]["dcnt_id"] ?>&token=<?php echo md5($docente[$i]["dcnt_id"]) ?>')}else{return false;}" title="Eliminar Docente: <?php echo $docente[$i]["dcnt_id"] ?>"><img src="images/icons/cross.png" alt="Eliminar Docente <?php echo $docente[$i]["dcnt_id"] ?>" /></a>
                                </td>
                                <td><?php echo $docente[$i]['dcnt_id']; ?></td>
                                <td><?php echo $docente[$i]['dcnt_nom'] . ' ' . $docente[$i]['dcnt_ape']; ?></td>
                                <td><?php echo $docente[$i]['dcnt_cargo']; ?></td>
                                <td><?php echo $docente[$i]['dcnt_email']; ?></td>
                                <td><?php echo $docente[$i]['dcnt_id']; ?></td>
                                
                            </tr>

                        <?php endfor; ?>

                    </tbody>
                </table>
                </div>
                <div class="tablefooter clearfix">
                    <div class="pagination">

                        <?php echo $docnt->paginator->showPaginator(); ?>
                    </div>
                </div>
            </article>
        </section>

        <?php include_once 'templates/aside_docente.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


