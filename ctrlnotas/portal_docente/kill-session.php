<?php
	session_start();
	unset($_SESSION["sys_docente"]);
	session_destroy();
	header("location:index.php");
?>
