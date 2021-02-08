<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/style.css"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<title>Facesegurity</title>
</head>
<body>
	<div id="contendor">
			<div id="contenido">
				<div id="section1">
					<center>
					<img src="img/logo1.png" height="9%" width="9%">
					</center>
				</div>
				<header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list"></span>Menu</a>
		</div>
 
		<nav>
			<ul>
		
				<li><a href="#"><span class="icon-home"></span>Inicio</a></li>
				<li><a href="#"><span class="icon-stats-bars2"></span>Producto</a></li>
				<li><a href="#"><span class="icon-earth"></span>Servicios</a></li>
				<li><a href="#"><span class="icon-office"></span>Empresas</a></li>
				<li><a href="#"><span class="icon-briefcase"></span>Empleado</a></li>
				<li><a href="login.php"><span class="icon-user"></span>Ingreso</a></li>
			</ul>
		</nav>
	</header>
			</div>
				<div id="header">
				<center>
					<img src="img/logo2.png" width="9%" height="9%">
					</center>

				</div>
	<div id="nav">

		<center>
					<br>
					<br>
				 <h2> PLANES </h2>
				 <br>
				 <br>

				 <P > En FACESEGURITY tenemos los iguientes planes para ti
				 </P>
				Gestiona facilmente los contenidos, simplifica tu trabajo e incrementa la eficiencia

				</center>
			</P>
					<br>
					<br>
					<center>		
						<div class="articulo11">	
							<img class="" src="img/img9.jpg" alt=""/>
							<pre>5 a 8 personas<br/> Planificacion<br/>150.000 Pesos<br/>Precio por persona
							</pre>		
						</div>
						<div class="articulo12">
							<img class="" src="img/img8.jpg" alt=""/>
							<pre>8 a 10 personas<br/>Organizacion<br/>150.000 Pesos<br/>Precio por persona
							</pre>		
						</div>
					<div class="articulo13">
						<img class="" src="img/img10.jpg" alt=""/>
							<pre>10 a 15 personas<br/>Cordinacion<br/>150.000 Pesos<br/>Precio por persona
							</pre>			
					</div>
					</center>	
		<br>
	</div>
	<div id="footer"></div>
	<div id="somos">
					<div id="section3">
				<img src="img/img11.jpg">
				<p><b>MODULOS:</b></p><p>Nuestro sistema otimo y funcional nos permite haceder a diferentes modulos de trabajo para facilitar tu rendimiento y productividad con un amplio sistema de eleccion para que puedas elegir a tu gusto y no solo eso nuestros sistema te permite guardar  cada uno de tus modulos abquiridos posteriormente.</P>
				</div>
			<div id="section4">
				<img src="img/img12.jpg">
				<h3><b>DOCUMENTO:</b></h3><p>El tener muchos trabajos en diferentes sitios o formatos siempre es complicado y suele producirnos muchos problemas por eso con nuestro sistema de documento podras mantener el orden en todos tus trabajos y poder llevarlos a todos lados sin problema de preocuparte por tus documentos. </P>
				<br>
				</div>
				<div id="section5">
				<img src="img/img13.jpg">
				<p><b>REGISTROS:</b></p><p>No tendras que preocuparte por tener grandes formularios que llenar para poder registrarate nuestro sistema de registro cuenta con una interfas muy facil y clara a la hora de ser manejada y a la hora de ingresar solo tendras que colocar tu usuario y contraseña y listo podras entrar a  disfrutar de nuestro sistema.</P>
				<br>
				</div>
				<div id="section6">
				<img src="img/img14.jpg">
				<br>
				<br>
				<h3><b>NOSOTROS:</b></h3>
				<p>Nosotros es la herramienta que te ayudara a saber mas de nuestra empresa, conocer nuestro proceso todo lo que paso en el proceso de creacion de facesegurity y poder saber de los diseñadores, tambien podras comunicarte con algunos de los diseñadores de forma personal si lo deseas, nosotros es todo lo que necesitas para enterder nuestro trabajo.</P>
				<br>
				</div>
				</div>
			<div id="casi"></div>
			<div id="yacasi"></div>
			<div id="llege">
				<div class="pie1">
					<br>
					<h2 class="titulo">¡SIGUENOS!</h2>
					<br>
					<br>
				<li span class="icon-facebook2">&nbspFacesegurity_20</li>
				<br>
				<li span class="icon-instagram">&nbsp@facesegurity</li>
				<br>
				<li span class="icon-google2">&nbspfacesegurity</li>
				<br>
				<li span class="icon-twitter">&nbsp@facesegurityoficial</li>
				<br>
				</div>
				<div class="pie2">
					<br>
					<br>
					<center>
					<p>Contactanos</p>
					<p>Linea gratuita 01800-00001</p>
					<p>Facessegurity &copy;Todos los derechos reservados </p>
					<p>2020</p>
					</center>


				</div>
				<div class="pie3">
					<center>
					<img src="img/logo2.png" width="60%" height="60%">
					</center>
				</div>
			</div>
		</div>
	</div>
					</div>
			</div>
	</div>
</div>


<script src="http://code.jquery.com/jquery-latest.js"> </script>
<script src="menu.js"> </script>
<script >
	$(document).ready(main);
 
var contador = 1;
 
function main(){
	$('.menu_bar').click(function(){
		//$('nav').toggle(); 
 
		if(contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
		}
 
	});
 
};
</script>

</body>
</html>
