	<?php

	//1.2. Incluimos nuestro controlador (cusu.php)
	include ("controlador/ccargo.php");
	?>
	<center>
	<h1>REGISTRO Y LISTADO DE CARGOS</h1>
	<hr width="100%"><!--Linea inferior-->
	<br><br><!--Salto de Linea-->
	<!--Lamamdo nuestra funcion de la vista que tiene el form-->
	<?php
		form_registro($id_cargo);
	?>
	<br><br><!--Salto de Linea-->
	<?php
		form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
	?>
	</center>