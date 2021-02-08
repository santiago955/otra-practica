<?PHP
	//2.1.2. Activo la varible de Sesion y invocamos nuestra conexio
	session_start();
	require_once('conexion.php');
	//2.1.3. Captura de dato (POST) en variables PHP

	$user= isset($_POST["user"])? $_POST["user"]:NULL;
	$pass= isset($_POST["pass"])? $_POST["pass"]:NULL;
	insper($user,$pass);
	//2.1.4. Creamos la funcion validacion de usuario y contraseña

	function insper($user,$pass){
	  if($user && $pass){
			//Incriptamos el campo ($pass en $pp)
			$pp = sha1(md5($pass));
			//Llamamos nuestro procedimiento almacenado
			$sql = "CALL valida_usu(:user,:pass);";
			$modelo=new conexion();
			$conexion=$modelo->get_conexion();
			$result=$conexion->prepare($sql);
			//Enviamos los parametros de nuestra consulta
			$result->bindparam(':user',$user);
			$result->bindparam(':pass',$pp);
			if($result)
			//Ejecutamos la consulta
				$result->execute();
			while($f=$result->fetch()){
				$res[]=$f;
			}
			$res= isset($res) ? $res:NULL;
			//Verificamos la cant de registros encontrados
			$coutR = count($res);
			if($coutR==1){
				//Capturamos en variables de sesion los datos de nuestro usuario
				$_SESSION["id_admi"] = $res[0]['id_admi'];
				$_SESSION["nom"] = $res[0]['nom'];
				$_SESSION["pefid"] = $res[0]['pefid'];
				$_SESSION["pefnom"] = $res[0]['pefnom'];
				$_SESSION["autentificado"] = '¿*-?¡--@';
				//Autorizamos el ingreso a (home.php=Mod_Admin)(HTML-JS)
				echo "<script type='text/javascript'>window.location='../home.php';</script>";	
			}else{
				if($user && $pass){
			//Incriptamos el campo ($pass en $pp)
			$pp = sha1(md5($pass));
				$sql1 = "CALL valida_empleado(:user,:pass);";
				$modelo=new conexion();
				$conexion=$modelo->get_conexion();
				$result=$conexion->prepare($sql1);
				//Enviamos los parametros de nuestra consulta
				$result->bindparam(':user',$user);
				$result->bindparam(':pass',$pp);
				if($result)
				//Ejecutamos la consulta
				$result->execute();
				while($f=$result->fetch()){
					$res[]=$f;
				}
				$res= isset($res) ? $res:NULL;
				//Verificamos la cant de registros encontrados
				$coutR = count($res);
				if($coutR==1){
					//Capturamos en variables de sesion los datos de nuestro usuario
					$_SESSION["id_emp"] = $res[0]['id_emp'];
					$_SESSION["nomb"] = $res[0]['nomb'];
					$_SESSION["pefid"] = $res[0]['pefid'];
					$_SESSION["pefnom"] = $res[0]['pefnom'];
					$_SESSION["autentificado"] = '¿*-?¡--@';
					//Autorizamos el ingreso a (home.php=Mod_Admin)(HTML-JS)
					echo "<script type='text/javascript'>window.location='../home.php';</script>";	
				}else{

				if($user && $pass){
				//Incriptamos el campo ($pass en $pp)
				$pp = sha1(md5($pass));
				//Llamamos nuestro procedimiento almacenado
				$sql = "CALL valida_empresa(:user,:pass);";
				$modelo=new conexion();
				$conexion=$modelo->get_conexion();
				$result=$conexion->prepare($sql);
				//Enviamos los parametros de nuestra consulta
				$result->bindparam(':user',$user);
				$result->bindparam(':pass',$pp);
				if($result)
					//Ejecutamos la consulta
					$result->execute();
				while($f=$result->fetch()){
						$res[]=$f;
				}
				$res= isset($res) ? $res:NULL;
				//Verificamos la cant de registros encontrados
				$coutR = count($res);
					if($coutR==1){
					//Capturamos en variables de sesion los datos de nuestro usuario
					$_SESSION["emp_nit"] = $res[0]['emp_nit'];
					$_SESSION["nom_emp"] = $res[0]['nom_emp'];
					$_SESSION["pefid"] = $res[0]['pefid'];
					$_SESSION["pefnom"] = $res[0]['pefnom'];
					$_SESSION["autentificado"] = '¿*-?¡--@';
					//Autorizamos el ingreso a (home.php=Mod_Admin)(HTML-JS)
					echo "<script type='text/javascript'>window.location='../home.php';</script>";	
				}else{
					//NO se Autorizara el ingreso a (home.php=Mod_Admin)
					session_destroy();
					echo "<script type='text/javascript'>window.location='../login.php?errorusuario=si';</script>";

							//NO se Autorizara el ingreso a (home.php=Mod_Admin)
							session_destroy();
							echo "<script type='text/javascript'>window.location='../login.php?errorusuario=si';</script>"
							;
						}	
					}	
				}

		  }
    }
  }
}  
?>