<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<div class="container">
		<div class="img">
			<img src="img/bg3.svg">
		</div>
		<div class="login-content">
			<form name="frm1" action="modelo/valida.php" method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Bienvenidos</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="user" required="">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input" name="pass" required="">
            	   </div>
                 
            	</div>
            	<a href="#">Olvidaste tu Contraseña?</a>
              <?php 
              //Capturamos la variable php(URL-GET) - errorusuario
              $erroru = isset($_GET["errorusuario"]) ? $_GET["errorusuario"]:NULL;
              if($erroru=="si"){ ?>
              <tr>
                <td colspan="2" style="text-align: center;">
                  Usuario y/o Contraseña Incorrectos...
                </td>
              </tr>
            <?php } ?>

              <tr>
            	<input type="submit" class="btn" value="Login">
            </tr>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>