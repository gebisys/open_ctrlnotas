<?php
	include_once "includes/config.php";
        include_once 'portal_docente/class/Generica.php';
        $objGen 	= new Generica($db);
	$objAsignaciones = new Asignaciones($db);
	if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["mat"])) {
		$grados = $objAsignaciones->getGradesxMat();
		echo json_encode($grados);
	}
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["admin_gd"])) {
		$grados = $objAsignaciones->getGradesxMatid($_SESSION['sys_docente_id'],$_GET['mat_id']);
                
		echo json_encode($grados);
	}
        
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["admin_mat"])) {
		$mats = $objGen->getMats($_GET['docnt_id']);
                $_SESSION['sys_docente_id'] = $_GET['docnt_id'];
		echo json_encode($mats);
	}
?>