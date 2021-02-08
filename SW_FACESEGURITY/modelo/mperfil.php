 <?php 

class mperfil{

	public function ins_perfil($pefid, $pefnom){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrarperfil(:pefid, :pefnom);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':pefid',$pefid);
	 	$result->bindParam(':pefnom',$pefnom);
	 	
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar perfil');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('perfil registrado correctamente...');</script>";
	}
	//1.3.2. Crear Funcion CONSULTA()
	public function sel_perfil($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT pefid, pefnom FROM perfil';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE pefnom LIKE :filtro';
		}
		$sql .= ' LIMIT '.$rvini.', '.$rvfin.';';
		$result = $conexion->prepare($sql);
		if($filtro){
			$result->bindParam(':filtro',$filtro);
		}
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//1.3.3. Crear Funciona ACTUALIZAR()
	public function upd_perfil($pefid, $pefnom){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE perfil SET pefnom=:pefnom WHERE pefid=:pefid";
		$result = $conexion->prepare($sql);
		$result->bindParam(':pefnom',$pefnom);
	 	$result->bindParam(':pefid',$pefid);
	 	

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('perfil Actualizado');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()
	public function del_perfil($pefid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM perfil WHERE pefid=:pefid;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':pefid',$pefid);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}

        public function sel_perfil_act($pefid){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pefid, pefnom FROM perfil WHERE pefid=:pefid;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':pefid',$pefid);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(pefnom) AS Npe FROM perfil';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE pefnom LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}
}


?>