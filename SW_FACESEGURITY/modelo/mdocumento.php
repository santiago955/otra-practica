<?php 
//1.2. Crea Clase(POO) que se llamara tal cual el archivo
class mdocumento{

	//1.3.1. Crear Funcion INSERTAR (Parametro(VariablesPHP))
	public function ins_documento($id_doc, $nom, $aut_doc, $fec_crea, $id_emp, $id_tpdoc){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrardocumento(:iddoc,:nom,:autdoc,:feccrea,:idemp,:id_tpdoc);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':iddoc',$id_doc);
	 	$result->bindParam(':nom',$nom);
	 	$result->bindParam(':autdoc',$aut_doc);
	 	$result->bindParam(':feccrea',$fec_crea);
	 	$result->bindParam(':idemp',$id_emp);
	 	$result->bindParam(':id_tpdoc',$id_tpdoc);
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Documento');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Documento registrado correctamente...');</script>";
	}
	//1.3.2. Crear Funcion CONSULTA()


	public function sel_documento($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT id_doc, nom, aut_doc, fec_crea, id_emp, id_tpdoc FROM documento';
		//2.1.1.1.1.
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


	public function upd_documento($id_doc, $nom, $aut_doc, $fec_crea, $id_emp, $id_tpdoc){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE documento SET nom=:nom, aut_doc=:aut_doc, fec_crea=:fec_crea, id_emp=:id_emp, id_tpdoc=:id_tpdoc WHERE id_doc=:id_doc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':nom',$nom);
		$result->bindParam(':aut_doc',$aut_doc);
		$result->bindParam(':fec_crea',$fec_crea);
		$result->bindParam(':id_emp',$id_emp);
		$result->bindParam(':id_tpdoc',$id_tpdoc);
		$result->bindParam(':id_doc',$id_doc);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Documento Actualizado');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()



	public function del_documento($id_doc){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM documento WHERE id_doc=:id_doc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_doc',$id_doc);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	//1.3.5. Crear Funciones Adicioanles (Ej: Carga de datos en campo del formulario (Tb_perfiles))


	//1.3.5.1. Crear Funcion CARGA_DATOS [COMBOBOX]
	public function list_empleado(){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_emp, nomb FROM empleado;";
		$result = $conexion->prepare($sql);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	public function list_tipodocumento(){
		$resultado2 = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_tpdoc, nom_tpdoc FROM tipo_documento;";
		$result2 = $conexion->prepare($sql);
		$result2->execute();
		while($f=$result2->fetch()){
			$resultado2[]=$f;
		}
		return $resultado2;
	}
	//1.3.5.2. Crear Funcion Cargar datos de un usuario al formulario para (Actualizar)
	public function sel_documento_act($id_doc){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_doc,nom,aut_doc,fec_crea,id_emp,id_tpdoc FROM documento WHERE id_doc=:id_doc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_doc',$id_doc);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(id_doc) AS Npe FROM documento';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}



}

?>