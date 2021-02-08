<?php
	//1.2. Incluimos nuestro controlador (cusu.php)
include ("controlador/cadministrador.php");
?>
<center>
<h1>REGISTRO Y LISTADO DE ADMIN(S)</h1>
<hr width="100%"><!--Linea inferior-->
<br><br><!--Salto de Linea-->
<!--Lamamdo nuestra funcion de la vista que tiene el form-->
<?php
	form_registro($id_admi);
?>
<br><br><!--Salto de Linea-->
<?php
	form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
?>
</center>
