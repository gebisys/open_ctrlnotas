<?php

include_once "includes/config.php";
include_once "../class/Report.php";
include_once "../class/Generic.php";

$objGen = new Generic($db);
$objGeneric = new GenericaA($db);

__is__login();
define('SECTION', 'Portal Alumno | Consulta de Notas');
include_once '../templates/site_top_alumno.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article id="dashboard">
                <h1>Consulta de Notas</h1>
                   <?php 
                    $grade = $objGen->getNameGrade($_SESSION['sys_alumno_cod_gs']);
                    
                   #print_r($objGeneric->getNotes($grade[0]['nivel_gra']));
                   
                   ?>
                    <form name="buscar" action="" method="POST">
                        <table style="margin-bottom: 10px;">
                            <tr>
                                <td style="width: 30px;">A&ntilde;o</td>
                                <td style="width: 70px;"><input type="text" name="anio" size="5" maxLength="4" ></td>
                                <td style="width: 60px;">Periodo</td>
                                <td style="width: 100px;">
                                    <select name="periodo">
                                        <option value="">Seleccione</option>
                                        <option value="1">Primer Periodo</option>
                                        <option value="2">Segundo Periodo</option>
                                        <option value="3">Tercer Periodo</option>
                                        <option value="4">Cuarto Periodo</option>
                                    </select>
                                </td>
                                <td style=""><button type="submit" style="margin-left: 10px;" name="find" value="se" class="button">Mostrar</button></td>
                            </tr>
                        </table>
                    </form>
                    <?php if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anio"]) ) { ?>
                
                    <table id="table1" class="gtable sortable" style="">
                    <thead>
                        <tr>
                            <th style="">Materia</th>
                            <th>ACT1</th>
                            <th>ACT2</th>
                            <th>ACT3</th>
                            <th>50%</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $notas = $objGeneric->getNotes($grade[0]['nivel_gra']);
                        for ($i = 0; $i < count($notas); $i++):
                            ?>
                            <tr>
                               
                                <td><?php echo $notas[$i]['Nombre_materia']; ?></td>
                                <td><?php echo $notas[$i]['Act1']; ?></td>
                                <td><?php echo $notas[$i]['Act2']; ?></td>
                                <td><?php echo $notas[$i]['Act3']; ?></td>
                                <td><b><?php echo $notas[$i]['PO']; ?></b></td>
                                <td><b><?php echo $notas[$i]['observacion']; ?></b></td>                                
                            </tr>

                        <?php endfor; ?>

                    </tbody>
                </table>
                <?php } ?>
            </article>
        </section>
    </section>
</section>

<?php

include_once '../templates/site_bottom.php';
?>
