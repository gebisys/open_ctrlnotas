<?php
	session_start();
	unset($_SESSION["sys_alumno"]);
	session_destroy();
	header("location:index.php");
?>
