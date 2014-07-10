<?php
include_once "includes/config.php";
__is__login();
$alumn = new Alumno($db);
$result = $alumn->createDefaultScore();
if($result){

}

 ?>
