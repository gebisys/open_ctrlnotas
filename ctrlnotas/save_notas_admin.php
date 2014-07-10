<?php

include_once "includes/config.php";
include_once 'portal_docente/class/Generica.php';
__is__login();
$objGeneric = new Generica($db);
if ($_POST) {

    switch ($_SESSION["sys_glv"]) {
        case "primaria":
            if ($_POST["opt"] === "insert") {
                $objGeneric->insertNotasPrima();
            } else {
                $objGeneric->updateNotasPrima();
            }
            header("location:".SITE_URL."colector_notas.php?ok=yes");
            break;
        case "secundaria":
            if ($_POST["opt"] === "insert") {
                $objGeneric->insertNotasSecu();
            } else {
                $objGeneric->updateNotasSecu();
            }
            header("location:".SITE_URL."colector_notas.php?ok=yes");
            break;
        case "Bachillerato":
            if ($_POST["opt"] === "insert") {
                $objGeneric->insertNotasBachi();
            } else {
                $objGeneric->updateNotasBachi();
            }
            header("location:".SITE_URL."colector_notas.php?ok=yes");
            break;
    }
}

if($_GET['opt']==='clear'){
     switch ($_SESSION["sys_glv"]) {
        case "primaria":
            $objGeneric->clearNotesP();
            header("location:".SITE_URL."colector_notas.php?ok=clear");
            break;
        case "secundaria":
            $objGeneric->clearNotesS();
            header("location:".SITE_URL."colector_notas.php?ok=clear");
            break;
        case "Bachillerato":  
            $objGeneric->clearNotesB();
            header("location:".SITE_URL."colector_notas.php?ok=clear");
            break;
    }
}
?>
