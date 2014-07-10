<?php
session_start();


include_once "../config/constants.php"; #Constantes de conexion
#		Clases
#----------------------------------------------
include_once "../class_db/DBInterface.php"; #Clase de base de datos generica
#		Objeto base de datos
#----------------------------------------------
$db = DBInterface::getInterface('mysql');

function __is__login() {
    if (!isset($_SESSION["sys_docente"])) {
        $header = header("location:login.php");
    }
}

#----------------------------------------------
#      Incluimos las clases

include_once "../class/Paginator.php";
include_once "class/Login.php";
include_once "class/Generica.php";
include_once "../class/Alumnos.php";
include_once "../class/Docentes.php";
include_once "../class/Materias.php";
include_once "../class/Generic.php";
include_once "../class/Asignaciones.php";


#Cerramos sesion
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["logout"])) {
    unset($_SESSION["sys_docente"]);
    unset($_SESSION["sys_docente_nom"]);
    unset($_SESSION["sys_docente_id"]);
    unset($_SESSION["sys_continue"]);
    unset($_SESSION["sys_mt"] );
    unset($_SESSION["sys_pe"]);
    unset($_SESSION["sys_gr_id"]);
    unset($_SESSION["sys_mt_id"]);
    unset($_SESSION["sys_gr"]);
    unset($_SESSION["sys_docente_nom"]);
    unset($_SESSION["sys_glv"]);
    session_destroy();
    header("location:login.php");
}

function messages() {
    if (isset($_SESSION['message']) && is_array($_SESSION['message'])):
        echo <<<message
                    <div id="messages" class="{$_SESSION['message'][0]} msg">{$_SESSION['message'][1]}</div>
message;
    endif;
}
?>
