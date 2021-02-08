<?php
	
include ("controlador/ctipo_documento.php");
?>
<center>
<h1>REGISTRAR TIPO DOCUMENTO</h1>
<hr width="100%">
<br><br>
<?php
	form_registro($id_tpdoc);
?>
<br><br><!--Salto de Linea-->

<?php 
Form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc);
?>
</center>
