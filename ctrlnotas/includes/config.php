<?php
session_start();


define('SITE_ROOT', dirname(dirname(__FILE__))); #Constante almacena la ruta de la aplicacion */var/www/...

include_once "config/constants.php"; #Constantes de conexion
#		Clases
#----------------------------------------------
include_once "class_db/DBInterface.php"; #Clase de base de datos generica
#		Objeto base de datos
#----------------------------------------------
$db = DBInterface::getInterface('mysql');

function __is__login() {
    if (!isset($_SESSION["sys_user"])) {
        $header = header("location:login.php");
    }
}

#----------------------------------------------
#      Incluimos las clases

include_once SITE_ROOT . "/class/Paginator.php";
include_once SITE_ROOT . "/class/Login.php";
include_once SITE_ROOT . "/class/Alumnos.php";
include_once SITE_ROOT . "/class/Docentes.php";
include_once SITE_ROOT . "/class/Materias.php";
include_once SITE_ROOT . "/class/Generic.php";
#include_once SITE_ROOT . "/class/Generica.php";
include_once SITE_ROOT . "/class/Asignaciones.php";


#Cerramos sesion
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["logout"])) {
    unset($_SESSION["sys_user"]);
    unset($_SESSION["sys_continue"]);
    unset($_SESSION["sys_mt"] );
    unset($_SESSION["sys_pe"]);
    unset($_SESSION["sys_gr_id"]);
    unset($_SESSION["sys_mt_id"]);
    unset($_SESSION["sys_gr"]);
    unset($_SESSION["sys_glv"]);
    unset($_SESSION["sys_docente_nom"]);
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
