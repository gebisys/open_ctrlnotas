<?php

include_once "includes/config.php";
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
            header("location:".SITE_URL."portal_docente/add_notas.php?ok=yes");
            break;
        case "secundaria":
            if ($_POST["opt"] === "insert") {
                $objGeneric->insertNotasSecu();
            } else {
                $objGeneric->updateNotasSecu();
            }
            header("location:".SITE_URL."portal_docente/add_notas.php?ok=yes");
            break;
        case "Bachillerato":
            if ($_POST["opt"] === "insert") {
                $objGeneric->insertNotasBachi();
            } else {
                $objGeneric->updateNotasBachi();
            }
            header("location:".SITE_URL."portal_docente/add_notas.php?ok=yes");
            break;
    }
}
?>
