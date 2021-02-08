<?php 

class mdependencia{

	public function ins_dependencia($id_dependencia,$nom,$correo,$activi,$nove,$emp_nit){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL registrardependencia(:iddependencia, :nom, :correo, :activi, :nove, :empnit);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':iddependencia',$id_dependencia);
	 	$result->bindParam(':nom',$nom);
	 	$result->bindParam(':correo',$correo);
	 	$result->bindParam(':activi',$activi);
	 	$result->bindParam(':nove',$nove);
	 	$result->bindParam(':empnit',$emp_nit);
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Dependencia');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Dependencia registrada correctamente...');</script>";
	}
	//1.3.2. Crear Funcion CONSULTA()

// 1.3.2. Creamos Metodos/(Function) C[R]UD

	public function sel_dependencia($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT id_dependencia, nom, correo, activi, nove, emp_nit FROM dependencia';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom LIKE :filtro';
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

	public function upd_dependencia($id_dependencia, $nom, $correo, $activi, $nove, $emp_nit){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE dependencia SET nom=:nom, correo=:correo, activi=:activi, nove=:nove, emp_nit=:emp_nit WHERE id_dependencia=:id_dependencia;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':nom',$nom);
		$result->bindParam(':correo',$correo);
		$result->bindParam(':activi',$activi);
		$result->bindParam(':nove',$nove);
		$result->bindParam(':emp_nit',$emp_nit);
		$result->bindParam(':id_dependencia',$id_dependencia);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Dependencia Actualizada');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()


	public function del_dependencia($id_dependencia){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM dependencia WHERE id_dependencia=:id_dependencia;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_dependencia',$id_dependencia);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	//1.3.5. Crear Funciones Adicioanles (Ej: Carga de datos en campo del formulario (Tb_perfiles))

	//1.3.5.1. Crear Funcion CARGA_DATOS [COMBOBOX]
	public function list_empresa(){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT emp_nit, nom_emp FROM empresa;";
		$result = $conexion->prepare($sql);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//1.3.5.2. Crear Funcion Cargar datos de un usuario al formulario para (Actualizar)
	public function sel_dependencia_act($id_dependencia){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_dependencia, nom, correo, activi, nove,emp_nit FROM dependencia WHERE id_dependencia=:id_dependencia;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_dependencia',$id_dependencia);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(id_dependencia) AS Npe FROM dependencia';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}



	}

?>
