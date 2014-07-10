<?php
/* Configuracion de errores y region */
ini_set("display_errors", '1');
ini_set('memory_limit', '256M');
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
error_reporting(30719);

/* Fin de configuracion */

define('DB_HOST', 'localhost'); 					/* Servidor de base de datos */
define('DB_USER', 'root');							/* Usuario de la base de datos */
define('DB_PASS', '');								/* Clave de la base de datos */
define('DB_NAME', 'ctrlnotas'); 					/* Nombre de la base de datos */
define("SITE_URL", "http://localhost/ctrlnotas/"); 	/* URL donde se aloja el sistema (http://example.com) */


define("TITLE_SITE", "Sistema Control de Notas"); 	/* Nombre del sistema */
define("TITLE_SITE_DOC", "Portal Docente");
define("TITLE_SITE_ALU", "Portal Alumno");

# Name 
define('COMPANY', "ctrlNotas");  					/* Nombre que quiera darle a la aplicacion 
													 -( Este se vera reflejado en los reportes PDF )- */
?>