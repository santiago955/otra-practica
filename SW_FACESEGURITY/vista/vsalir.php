
<?php 
//Inicializando la sesion y destruyendola
session_start();
session_destroy();
//Direcccionamos el index.php (inicio de SI)
echo "<script type='text/javascript'>window.location='index.php';</script>";
//Salimos del Sistema
exit();
?>
