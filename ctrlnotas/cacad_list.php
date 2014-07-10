<?php
include_once "includes/config.php";
__is__login();
define('SECTION', 'Listado de Carga Academica a Docentes');
$generic = new Generic($db);
$docnt = new Docente($db);
$mate = new Materias($db);
$asignacion = new Asignaciones($db);

$asignacion->totalAsignaciones();
#Verificamos las variables a almacenar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])):
    $asignacion->deleteAsignacion();
    header('location:'.$_SERVER["PHP_SELF"].'?ok=confirm&msg='. md5('token'));
endif;
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article id="dashboard">
                <h1><?php echo SECTION ?></h1>
                 <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ok"]) ) { ?>
                    <div class="success msg">Registro Eliminado Exitosamente!. Click para Cerrar</div>
                <?php } 
                
                if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["list"]) ) { ?>
                    <form id="myForm" class="uniform" method="GET">
                    <fieldset>
                        <legend>Sleccione el Docente</legend>
                        <dl class="inline">

                            <dt><label for="grade">Docente</label></dt>
                            <dd>
                                <?php
                                    $docnt = new Docente($db);
                                    $docente = $docnt->getDocentes(100);                        
                                ?>
                                <select size="1" id="grade" name="docente" class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($docente); $i++): ?>
                                        <option value="<?php echo $docente[$i]["dcnt_id"]; ?>"><?php echo $docente[$i]["dcnt_nom"] . ' ' . $docente[$i]["dcnt_ape"]; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </dd>                                            
                        <div class="buttons">
                            <input type="hidden" name="list" value="w"/>
                            <input type="hidden" name="token" value="<?php echo $_GET['token'];?>"/>
                            <button type="submit" name="find" value="se" class="button">Buscar</button>
                        </div>
                    </fieldset>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["find"]) ) {
                    $asignacion->totalAsignaciones(1);
                    $asig = $asignacion->getAsignaciones(20, 1);
                    $grade = new Generic($db);
                    ?>
                    <h2>Docente : <?php $nameDocent = $docnt->getDocente($_GET['docente']); echo $nameDocent[0]['dcnt_nom'] . ' ' . $nameDocent[0]['dcnt_ape']; ?> <br />Materias Asiganadas : <?php echo $asignacion->total->Total; ?></h2>

                    <table id="table1" class="gtable sortable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Materia</th>
                                <th>Grado</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            for ($i = 0; $i < count($asig); $i++):
                                ?>
                                <tr>
                                    <td><?php echo $asig[$i]['id_ug']; ?></td>
                                    <td><?php $nameMate = $mate->getMateria($asig[$i]['id_mat']); echo $nameMate[0]['nombre_mat']; ?></td>
                                    <td><?php $nameGrade = $grade->getNameGrade($asig[$i]['id_gra']); echo $nameGrade[0]['nombre_gra']; ?></td>
                                    <td>
                                        <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                        <a href="cacad_edit.php?cod=<?php echo $asig[$i]["code_asig"] ?>&token=<?php echo md5($asig[$i]["code_asig"]) ?>" id="edit" title="Editar Asignacion: <?php echo $asig[$i]["code_asig"] ?>"><img src="images/icons/edit.png" alt="Editar Asignacion <?php echo $asig[$i]["code_asig"] ?>" /></a>
                                        <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $asig[$i]["code_asig"] ?>&token=<?php echo md5($asig[$i]["code_asig"]) ?>')}else{return false;}" title="Eliminar Asignacion: <?php echo $asig[$i]["code_asig"] ?>"><img src="images/icons/cross.png" alt="Eliminar Asignacion <?php echo $asig[$i]["code_asig"] ?>" /></a>
                                    </td>
                                </tr>

                            <?php endfor; ?>

                        </tbody>
                    </table>
                <?php } ?>                    
        <?php } else { ?>
                <h2>Asignaciones Registradas : <?php echo $asignacion->total->Total;?></h2>

                <table id="table1" class="gtable sortable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Docente</th>
                            <th>Materia</th>
                            <th>Grado</th>
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $asig = $asignacion->getAsignaciones(20);
                        $grade = new Generic($db);
                        for ($i = 0; $i < count($asig); $i++):
                            ?>
                            <tr>
                                <td><?php echo $asig[$i]['id_ug']; ?></td>
                                <td><?php $nameDocent = $docnt->getDocente($asig[$i]['dcnt_id']); echo $nameDocent[0]['dcnt_nom'] . ' ' . $nameDocent[0]['dcnt_ape']; ?></td>
                                <td><?php $nameMate = $mate->getMateria($asig[$i]['id_mat']); echo $nameMate[0]['nombre_mat']; ?></td>
                                <td><?php $nameGrade = $grade->getNameGrade($asig[$i]['id_gra']); echo $nameGrade[0]['nombre_gra']; ?></td>
                                <td>
                                    <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                    <a href="cacad_edit.php?cod=<?php echo $asig[$i]["code_asig"] ?>&token=<?php echo md5($asig[$i]["code_asig"]) ?>" id="edit" title="Editar Asignacion: <?php echo $asig[$i]["code_asig"] ?>"><img src="images/icons/edit.png" alt="Editar Asignacion <?php echo $asig[$i]["code_asig"] ?>" /></a>
                                    <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $asig[$i]["code_asig"] ?>&token=<?php echo md5($asig[$i]["code_asig"]) ?>')}else{return false;}" title="Eliminar Asignacion: <?php echo $asig[$i]["code_asig"] ?>"><img src="images/icons/cross.png" alt="Eliminar Asignacion <?php echo $asig[$i]["code_asig"] ?>" /></a>
                                </td>
                            </tr>

                        <?php endfor; ?>

                    </tbody>
                </table>
                <div class="tablefooter clearfix">
                    <div class="pagination">
                    
                    	<?php echo $asignacion->paginator->showPaginator();?>
                    </div>
                </div>
                <?php } ?>
            </article>
        </section>

        <?php include_once 'templates/aside_cacademica.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


