<?php 
//1.2. Crea Clase(POO) que se llamara tal cual el archivo

class madministrador{
//1.3. Metodos/Funciones
//1.3. Creamos Metodos/(Function) [C]RUD
	//1.3.1. Crear Funcion INSERTAR (Parametro(VariablesPHP))
	public function ins_administrador($id_admi,$nom,$pefid,$emausu,$pasusu){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registraradministrador(:idadmi,:nom,:fkpefid, :emausu, :pasusu);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':idadmi',$id_admi);
	 	$result->bindParam(':nom',$nom);
	 	$result->bindParam(':fkpefid',$pefid);
	 	$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);
	 
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Administrador');</script>";
	  	else
	  	$result->execute();
	  		echo "<script>alert('Administrador registrado correctamente...');</script>";
	}
	//1.3.2. Crear Funcion CONSULTA()

//1.3.2. Creamos Metodos/(Function) C[R]UD

	public function sel_administrador($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT id_admi, nom, pefid, emausu, pasusu FROM administrador';
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

//1.3.3. Creamos Metodos/(Function) CR[U]D

	public function upd_administrador($id_admi, $nom, $pefid,$emausu,$pasusu){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE administrador SET nom=:nom,pefid=:pefid,emausu=:emausu,pasusu=:pasusu where id_admi=:id_admi;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':nom',$nom);
		$result->bindParam(':pefid',$pefid);
		$result->bindParam(':id_admi',$id_admi);
		$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);
		
		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Administrador Actualizado');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()

 //1.3.4. Creamos Metodos/(Function) CRU[D]

	public function del_administrador($id_admi){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM administrador WHERE id_admi=:id_admi;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_admi',$id_admi);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	//1.3.5. Crear Funciones Adicioanles (Ej: Carga de datos en campo del formulario (Tb_perfiles))

// 1.3.5. Crear Funciones Adicioanles

	//1.3.5.1. Crear Funcion CARGA_DATOS [COMBOBOX]
	public function list_Perfil(){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pefid, pefnom FROM perfil;";
		$result = $conexion->prepare($sql);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//1.3.5.2. Crear Funcion Cargar datos de un usuario al formulario para (Actualizar)
	public function sel_administrador_act($id_admi){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_admi,nom,pefid,emausu,pasusu FROM administrador WHERE id_admi=:id_admi;";
		$result1 = $conexion->prepare($sql);
		$result1->bindParam(':id_admi',$id_admi);
		$result1->execute();
		while ($f1=$result1->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(id_admi) AS Npe FROM administrador';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}



}
?>