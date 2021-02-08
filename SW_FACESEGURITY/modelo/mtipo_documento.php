<?php 

class mtipo_documento{


public function ins_tipo_documento($id_tpdoc, $nom_tpdoc, $extencion){
		
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrartipodocumento(:idtpdoc, :notpdo, :ext);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 $result->bindParam(':idtpdoc',$id_tpdoc);
	 	$result->bindParam(':notpdo',$nom_tpdoc);
	 	$result->bindParam(':ext',$extencion);
	 	
	
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar tipodedocumento');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Tipo de Documento registrado correctamente...');</script>";
	}
	public function sel_tipo_documento($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT id_tpdoc, nom_tpdoc, extencion FROM tipo_documento';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_tpdoc LIKE :filtro';
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
	public function upd_tipo_documento($id_tpdoc, $nom_tpdoc, $extencion){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE tipo_documento SET id_tpdoc=:id_tpdoc, nom_tpdoc=:nom_tpdoc, extencion=:extencion  WHERE id_tpdoc=:id_tpdoc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_tpdoc',$id_tpdoc);
		$result->bindParam(':nom_tpdoc',$nom_tpdoc);
		$result->bindParam(':extencion',$extencion);


		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Tipo de Documento Actualizado');</script>";
		}
		
		public function del_tipo_documento($id_tpdoc){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM tipo_documento WHERE id_tpdoc=:id_tpdoc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_tpdoc',$id_tpdoc);
         
		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
}
      public function sel_tipo_documento_act($id_tpdoc){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_tpdoc, nom_tpdoc, extencion FROM tipo_documento WHERE id_tpdoc=:id_tpdoc;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_tpdoc',$id_tpdoc);
		$result->execute();
		while ($f1=$result->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(nom_tpdoc) AS Npe FROM tipo_documento';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_tpdoc LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}
}

?>