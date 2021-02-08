<?php 
//1.2. Crea Clase(POO) que se llamara  tal cual el archivo
class mcargo{
//1.3. Metodos/Funciones
//1.3.1. Crear Funcion INSERTAR (Parametro(VariablesPHP))
	public function ins_cargo($id_cargo, $tip_cargo, $nom_cargo, $fec_cargo, $estado){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrarcargo(:id_cargo, :tip_cargo, :nom_cargo, :fec_cargo, :estado);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':id_cargo',$id_cargo);
	 	$result->bindParam(':tip_cargo',$tip_cargo);
	 	$result->bindParam(':nom_cargo',$nom_cargo);
	 	$result->bindParam(':fec_cargo',$fec_cargo);
	 	$result->bindParam(':estado',$estado);
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar el Cargo');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert(' Cargo registrado correctamente...');</script>";
	}

	//1.3.2. Crear Funcion CONSULTA()
	public function sel_cargo($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); $sql = 'SELECT id_cargo, tip_cargo,nom_cargo,fec_cargo,estado FROM cargo';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_cargo LIKE :filtro';
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
	public function upd_cargo($id_cargo, $tip_cargo, $nom_cargo, $fec_cargo, $estado){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE cargo SET id_cargo=:id_cargo, tip_cargo=:tip_cargo, nom_cargo=:nom_cargo, fec_cargo=:fec_cargo, estado=:estado WHERE id_cargo=:id_cargo";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_cargo',$id_cargo);
	 	$result->bindParam(':tip_cargo',$tip_cargo);
	 	$result->bindParam(':nom_cargo',$nom_cargo);
	 	$result->bindParam(':fec_cargo',$fec_cargo);
	 	$result->bindParam(':estado',$estado);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Cargo Actualizada');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()
	public function del_cargo($id_cargo){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM cargo WHERE id_cargo=:id_cargo;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_cargo',$id_cargo);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	

	public function sel_cargo_act($id_cargo){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_cargo, tip_cargo, nom_cargo, fec_cargo, estado FROM cargo WHERE  id_cargo=:id_cargo;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_cargo',$id_cargo);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(nom_cargo) AS Npe FROM cargo';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_cargo LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}

}


?>
