<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Listado de Usuarios');
$login = new Login($db);
$login->totalUsers();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])):
    $login->deleteUser();
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
                <h2>Registros : <?php echo $login->total->Total; ?></h2>

                <table id="table1" class="gtable sortable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = $login->getUsers();
                        for ($i = 0; $i < count($user); $i++):
                            ?>
                            <tr>
                                <td><?php echo $user[$i]['id_usu']; ?></td>
                                <td><?php echo $user[$i]['usu_nomb']; ?></td>
                                <td><?php echo $user[$i]['usu_level']; ?></td>
                                <td>
                                    <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                    <a href="user_edit.php?cod=<?php echo $user[$i]['id_usu']; ?>&token=<?php echo md5($user[$i]['id_usu']) ?>" id="edit" title="Editar Usuario: <?php echo $user[$i]['id_usu']; ?>"><img src="images/icons/edit.png" alt="Editar Usuario  <?php echo $user[$i]['id_usu']; ?>" /></a>
                                    <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $user[$i]['id_usu']; ?>&token=<?php echo md5($user[$i]['id_usu']) ?>')}else{return false;}" title="Eliminar Docente: <?php echo $user[$i]['id_usu']; ?>"><img src="images/icons/cross.png" alt="Eliminar Usuario <?php echo $user[$i]['id_usu']; ?>" /></a>
                                </td>
                            </tr>

                        <?php endfor; ?>            
                    </tbody>
                </table>
                <div class="tablefooter clearfix">
                    <div class="pagination">
                       <?php echo $login->paginator->showPaginator(); ?>
                    </div>
                </div>
            </article>
        </section>

        <?php include_once 'templates/aside_user.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


