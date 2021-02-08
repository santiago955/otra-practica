
<?PHP
    require_once('modelo/mseguridad.php');
?>

<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/homeestilos.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/tablas.css"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Modulo Administrador</title>
</head>
<body>
	<div id="contendor">
				<div id="section1">
					<center>
					<img src="img/logo1.png" height="150px" width="150px">
					</center>
				</div>
            <div id="section2">
                    <center>
                    <ul>
                <li class="botton"><a href="home.php">Inicio</a></li>
                <li class="botton"><a href="#">Perfil</a></li>
                <li class="botton"><a href="#">Estados</a></li>
                <li class="botton"><a href="#">Recursos</a></li>
                <li class="botton"><a href="#">Contacto</a></li>
                <li class="botton"><a href="#">ingreso</a></li>
                </ul>

                </center>

                </div>
	<?PHP require_once("vista/main.php") ?>
	</header>
				</div>

				<?PHP require_once("vista/aside.php") ?>

				<?PHP 
            $pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
            if(!$pg OR $pg=="101") 
                require_once("vista/vhome.php");
            if($pg=="1") 
                require_once("vista/vadministrador.php");
            if($pg=="2") 
                require_once("vista/vempresa.php");
            if($pg=="3") 
                require_once("vista/vempleado.php");
            if($pg=="4") 
                require_once("vista/vdependencia.php"); 
            if($pg=="5") 
                require_once("vista/vdocumento.php"); 
            if($pg=="6") 
            	require_once("vista/vcargo.php");
            if($pg=="7") 
            	require_once("vista/vpagina.php");
            if($pg=="8") 
            	require_once("vista/vperfil.php");
            if($pg=="9") 
            	require_once("vista/vtipoempresa.php");
            if($pg=="10") 
            	require_once("vista/vtipo_documento.php");
            if($pg=="105") 
                require_once("vista/vart.php"); 
            if($pg=="150") 
                require_once("vista/vsalir.php");
            ?>

			</div>
            <div id="relle">
            
    </div>
<div id="articulos">

        <center>
                 <h2>¡ RECUERDA ! </h2>
            <br>

                 <P > En FACESEGURITY tenemos las iguientes Funciones para ti que te ayudaran a
                 </P>
                Gestiona facilmente los contenidos, simplificar tu trabajo e incrementa la eficiencia de tu empresa.

                </center>
            </P>
                <br>
                <br>
                   
                    <center>        
                        <div class="articulo11">    
                            <img class="" src="img/img9.jpg" alt=""/>
                             
                        </div>
                        <div class="articulo12">
                            <img class="" src="img/img8.jpg" alt=""/>
                            

                        </div>
                    <div class="articulo13">
                        <img class="" src="img/img10.jpg" alt=""/>
                                     
                    </div>
                    <div class="articulo14">
                        <img class="" src="img/img12.jpg" alt=""/>
                                      
                    </div>

                    </center>   
        <br>          

		<?PHP require_once("vista/pie.php") ?>
			</div>	    
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
	</body>
</html>