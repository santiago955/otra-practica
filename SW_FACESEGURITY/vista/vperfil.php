<?php
	
include ("controlador/cperfil.php");
?>
<center>

<h1>REGISTRAR PERFIL</h1>
<hr width="100%">
<br>
<?php
	form_registro($pefid);
?>
<?php 
form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
?>
</center>