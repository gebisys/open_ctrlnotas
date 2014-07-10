<?php

include_once "includes/config.php";
__is__login();
define('SECTION', 'Modulos de Registro Academico');
include_once 'templates/site_top.php';
?>

<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_12 ">
            <article id="dashboard">
                <h1>Notas</h1>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                 <?php
                                    $docnt = new Docente($db);
                                    $docente = $docnt->getDocentes(100);                        
                                ?>
                                <select size="1" id="grade" name="docente" class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($docente); $i++): ?>
                                        <option value="<?php echo $docente[$i]["dcnt_id"]; ?>"><?php echo utf8_encode($docente[$i]["dcnt_nom"]) . ' ' . utf8_encode($docente[$i]["dcnt_ape"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                                 <?php
                                    $docnt = new Docente($db);
                                    $docente = $docnt->getDocentes(100);                        
                                ?>
                                <select size="1" id="grade" name="docente" class="medium required">
                                        <option value="">Seleccione</option>
                                    <?php for ($i = 0; $i < count($docente); $i++): ?>
                                        <option value="<?php echo $docente[$i]["dcnt_id"]; ?>"><?php echo utf8_encode($docente[$i]["dcnt_nom"]) . ' ' . utf8_encode($docente[$i]["dcnt_ape"]); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </article>
        </section>
    </section>
</section>

<?php

include_once 'templates/site_bottom.php';
?>
