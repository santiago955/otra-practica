<?php
	
include ("controlador/cdependencia.php");
?>
<center>
<h1>REGISTRO Y LISTADO DE DEPENDENCIA(S)</h1>
<hr width="100%"><!--Linea inferior-->
<br><br><!--Salto de Linea-->
<!--Lamamdo nuestra funcion de la vista que tiene el form-->
<?php
	form_registro($id_dependencia);
?>
<br><br><!--Salto de Linea-->
<?php
	form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
?>
</center>
