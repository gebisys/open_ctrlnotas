<?php
include_once "includes/config.php";
__is__login();
$alumn = new Alumno($db);
if (isset($_GET['idg'])) {
    $alumn->totalAlumnosByGrade();
} elseif (isset($_GET['findA'])) {
    $alumn->totalAlumnosByNom();
} else {
    $alumn->totalAlumnos();
}
define('SECTION', 'Listado de Alumnos');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del"])):
    $alumn->deleteAlumn();
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
                <h2>Registros : <?php echo $alumn->total->Total; ?></h2>
                <table>
                    <tr>
                        <td>
                            <form name="search" action="" method="GET" style="margin-bottom:10px;">
                                <?php
                                $grade = new Generic($db);
                                $grades = $grade->GetGrades();
                                ?>
                                <select size="1" id="grade" name="idg"class="medium required">
                                    <option value="">Seleccione Grado</option>
                                    <?php for ($i = 0; $i < count($grades); $i++): ?>
                                        <option value="<?php echo $grades[$i]["id_gra"]; ?>"><?php echo $grades[$i]["nombre_gra"]; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <button type="submit" name="saveAlumn" value="" class="button">Filtrar</button>
                            </form>
                        </td>
                        <td>
                            <form name="findA" action="" method="GET">
                                <input type="text" name="findA" style="margin-left: 10px; width: 200px;">
                                <button type="submit" name="saveAlumn" value="" class="button">Buscar</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <div style="width: 100%;overflow: auto;">
                    <table id="table1" class="gtable sortable" style="width: 1000px;">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Acciones</th> 
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Grado</th>
                                <th>NIE</th>
                                <th>Matricula</th>                         
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['idg'])) {
                                $alum = $alumn->getAlumnByGrade(10);
                            } elseif (isset($_GET['findA'])){ 
                                $alum = $alumn->getAlumnByNom(15);
                            } else {
                                
                                $alum = $alumn->getAlumns(15);
                            }
                            $grade = new Generic($db);
                            for ($i = 0; $i < count($alum); $i++):
                                ?>
                                <tr>
                                    <td>
                                        <img class="move" src="images/icons/arrow-move.png" alt="Move" title="Move" />
                                        <a href="Alunm_edit.php?cod=<?php echo $alum[$i]["id_alumn"] ?>&token=<?php echo md5($alum[$i]["id_alumn"]) ?>" id="edit" title="Editar Alumna: <?php echo $alum[$i]["alumn_code"] ?>"><img src="images/icons/edit.png" alt="Editar Alumna <?php echo $alum[$i]["alumn_code"] ?>" /></a>
                                        <a href="javascript:void(0);" onclick="javascript:if(confirm('Desea eliminar el registro? \n Processo Irreversible')){location.replace('<?php echo $_SERVER["PHP_SELF"] ?>?del=<?php echo $alum[$i]["id_alumn"] ?>&token=<?php echo md5($alum[$i]["id_alumn"]) ?>')}else{return false;}" title="Eliminar Alumna: <?php echo $alum[$i]["id_alumn"] ?>"><img src="images/icons/cross.png" alt="Eliminar Alumna <?php echo $alum[$i]["id_alumn"] ?>" /></a>
                                        <?php if($alum[$i]['cod_grado'] !== 0){ $alumn->VerifyNotasAlumn($alum[$i]['id_alumn'], $alum[$i]['cod_grado'], $alum[$i]['matricula']);} ?>
                                    </td>
                                    <td><?php echo $alum[$i]['id_alumn']; ?></td>
                                    <td><?php echo $alum[$i]['alumn_nomb'] . ' ' . $alum[$i]['alumn_apell']; ?></td>
                                    <td><?php $nameGrade = $grade->getNameGrade($alum[$i]['cod_grado']);
                                        echo $nameGrade[0]['nombre_gra']; ?></td>
                                    <td><?php echo $alum[$i]['alumn_code']; ?></td>
                                    <td><?php echo $alum[$i]['matricula']; ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>    
                <div class="tablefooter clearfix">
                    <div class="pagination">
                        <?php echo $alumn->paginator->showPaginator(); ?>
                    </div>
                </div>
            </article>
        </section>

        <?php include_once 'templates/aside_alumnos.php'; ?>
    </section>
</section>

<?php
include_once 'templates/site_bottom.php';
?>


