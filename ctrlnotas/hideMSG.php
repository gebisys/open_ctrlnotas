<?php

include_once "includes/config.php";
__is__login();


//Para esconder mensajes
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $_SESSION['message'] = '';
endif;
?>