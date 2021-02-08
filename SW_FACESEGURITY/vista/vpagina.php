<?php
	
include ("controlador/cpagina.php");
?>
<h1>REGISTRAR PAGINA</h1>
<hr width="100%">
<br><br>
<?php
	form_registro($pagid);
?>
<br><br><!--Salto de Linea-->

<?php 
Form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
?>
