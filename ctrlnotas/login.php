<?php 
include_once "includes/config.php";
$msg_error = null;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["loginbtn"])) {
    $login = new Login($db);
    if($login->access()) {
         header("location:".SITE_URL."index.php");
    }else{
        $msg_error = "<div class='error msg'>Nombre de usuario y contrase&ntilde;a invalidos</div>";
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>       
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 	
        
    
         <title><?php echo TITLE_SITE; ?> - Inicio de Session</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/style.css">
        <!--[if lte IE 8]>
        <script type="text/javascript" src="js/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL;?>js/Delicious_500.font.js"></script>
        <script type="text/javascript">
            
        </script>

    </head>
    <body>

        <header id="top">
            <div class="container_12 clearfix">
                <div id="logo" class="grid_12">
                    <!-- replace with your website title or logo -->
                    <a id="site-title" href="<?php echo SITE_URL;?>login.php"><span><?php echo TITLE_SITE . '</span> ' . COMPANY ; ?></a>
                </div>
            </div>
        </header>
        
       <!-- <div id="login" class="box">
            <h2>Inicio de Sessi&oacute;n</h2>
            <section>
                <?php echo $msg_error; ?>
                <form name="login" action="" method="POST">
                    <dl>
                        <dt><label for="username">Usuario</label></dt>
                        <dd><input id="username" name="username" type="text" /></dd>

                        <dt><label for="adminpassword">Contrase&ntilde;a</label></dt>
                        <dd><input id="adminpassword" name="adminpassword" type="password" /></dd>
                    </dl>
                    <p>
                        <button type="submit" class="button gray" name ="loginbtn" id="loginbtn">Enviar</button>
                        
                    </p>
                </form>
            </section>
        </div>-->
       <div id="" class="box" style="width: 430px; margin-left: -215px; margin-top: -150px; position: absolute; top: 50%; left: 50%;">
            <h2>Inicio de Sesi&oacute;n</h2>
            <section>
                <img src="images/logo2.jpg"style="float: right;">
                <?php echo $msg_error; ?>
                <form name="login" action="" method="POST">
                    <dl>
                        <dt><label for="username">Usuario</label></dt>
                        <dd><input id="username" name="username" type="text" /></dd>

                        <dt><label for="adminpassword">Contrase&ntilde;a</label></dt>
                        <dd><input id="adminpassword" name="adminpassword" type="password" /></dd>
                    </dl>
                    <p>
                        <button type="submit" class="button gray" name ="loginbtn" id="loginbtn">Enviar</button>
                        <!--<a id="forgot" href="#">Forgot Password?</a>-->
                    </p>
                </form>
            </section>
        </div>
    </body>
</html>
