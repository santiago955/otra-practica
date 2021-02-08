<?php
	
include ("controlador/cempleado.php");
?>
<center>
<h1>REGISTRAR Y LISTAR EMPLEADOS</h1>
<hr width="100%">
<br><br>
<?php
	form_registro($id_emp);
?>
<br><br><!--Salto de Linea-->

<?php 
Form_mostrar($id_emp,$conp,$nreg,$pg,$bo,$filtro,$arc);
?>
</center>