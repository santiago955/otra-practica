<?php 
//1.2. Crea Clase(POO) que se llamara  tal cual el archivo
class mtipoempresa{
//1.3. Metodos/Funciones
//1.3.1. Crear Funcion INSERTAR (Parametro(VariablesPHP))
	public function ins_tipoempresa($idtipemp, $tipo_emp, $sector, $procapital, $ambactuacion){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrartipoempresa(:idtipemp, :tipoemp, :sector, :procapital, :ambactuacion);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':idtipemp',$idtipemp);
	 	$result->bindParam(':tipoemp',$tipo_emp);
	 	$result->bindParam(':sector',$sector);
	 	$result->bindParam(':procapital',$procapital);
	 	$result->bindParam(':ambactuacion',$ambactuacion);
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Tipo de Empresa');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert(' Tipo de Empresa registrada correctamente...');</script>";
	}

	//1.3.2. Crear Funcion CONSULTA()
	public function sel_tipoempresa($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT idtipemp, tipo_emp, sector, procapital, ambactuacion FROM tipoempresa';
		//2.1.1.1.1.
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE tipo_emp LIKE :filtro';
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
	public function upd_tipoempresa($idtipemp, $tipo_emp, $sector, $procapital, $ambactuacion){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE tipoempresa SET idtipemp=:idtipemp, tipo_emp=:tipo_emp, sector=:sector, procapital=:procapital, ambactuacion=:ambactuacion WHERE idtipemp=:idtipemp";
		$result = $conexion->prepare($sql);
		$result->bindParam(':idtipemp',$idtipemp);
	 	$result->bindParam(':tipo_emp',$tipo_emp);
	 	$result->bindParam(':sector',$sector);
	 	$result->bindParam(':procapital',$procapital);
	 	$result->bindParam(':ambactuacion',$ambactuacion);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Tipo de Empresa Actualizada');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()
	public function del_tipoempresa($idtipemp){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM tipoempresa WHERE idtipemp=:idtipemp;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':idtipemp',$idtipemp);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	

	public function sel_tipoempresa_act($idtipemp){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idtipemp, tipo_emp, sector, procapital, ambactuacion FROM tipoempresa WHERE  idtipemp=:idtipemp;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':idtipemp',$idtipemp);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(idtipemp) AS Npe FROM tipoempresa';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE tipo_emp LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}

}


?>