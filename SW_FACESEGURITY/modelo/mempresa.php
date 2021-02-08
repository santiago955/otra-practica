<?php 
//1.2. Crea Clase(POO) que se llamara  tal cual el archivo
class mempresa{
//1.3. Metodos/Funciones
//1.3.1. Crear Funcion INSERTAR (Parametro(VariablesPHP))
	public function ins_empresa($emp_nit, $nom_emp, $direc, $ciudad, $tel, $nom_repre, $correo_repre, $raz_soci, $sect_econ, $desc_emp, $id_admi, $pefid, $idtipemp,$emausu,$pasusu){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrarempresa(:empnit, :nomemp, :direc, :ciudad, :tel, :nomrepre, :correorepre, :razsoci, :sectecon, :descemp, :idadmi, :pefid, :idtipemp, :emausu, :pasusu);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':empnit',$emp_nit);
	 	$result->bindParam(':nomemp',$nom_emp);
	 	$result->bindParam(':direc',$direc);
	 	$result->bindParam(':ciudad',$ciudad);
	 	$result->bindParam(':tel',$tel);
	 	$result->bindParam(':nomrepre',$nom_repre);
	 	$result->bindParam(':correorepre',$correo_repre);
	 	$result->bindParam(':razsoci',$raz_soci);
	 	$result->bindParam(':sectecon',$sect_econ);
	 	$result->bindParam(':descemp',$desc_emp);
	 	$result->bindParam(':idadmi',$id_admi);
	 	$result->bindParam(':pefid',$pefid);
	 	$result->bindParam(':idtipemp',$idtipemp);
	 	$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Empresa');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Empresa registrada correctamente...');</script>";
	}
	//1.3.2. Crear Funcion CONSULTA()
	public function sel_empresa($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT emp_nit, nom_emp, direc, ciudad, tel, nom_repre, correo_repre, raz_soci, sect_econ, desc_emp, id_admi, pefid, idtipemp, emausu, pasusu FROM empresa';
		//2.1.1.1.1.
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_emp LIKE :filtro';
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
	public function upd_empresa($emp_nit, $nom_emp, $direc, $ciudad, $tel, $nom_repre, $correo_repre, $raz_soci, $sect_econ, $desc_emp, $id_admi, $pefid, $idtipemp, $emausu, $pasusu){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE empresa SET emp_nit=:emp_nit, nom_emp=:nom_emp, direc=:direc, ciudad=:ciudad, tel=:tel, nom_repre=:nom_repre, correo_repre=:correo_repre, raz_soci=:raz_soci, sect_econ=:sect_econ, desc_emp=:desc_emp, id_admi=:id_admi, pefid=:pefid, idtipemp=:idtipemp, emausu=:emausu, pasusu=:pasusu WHERE emp_nit=:emp_nit";
		$result = $conexion->prepare($sql);
		$result->bindParam(':emp_nit',$emp_nit);
	 	$result->bindParam(':nom_emp',$nom_emp);
	 	$result->bindParam(':direc',$direc);
	 	$result->bindParam(':ciudad',$ciudad);
	 	$result->bindParam(':tel',$tel);
	 	$result->bindParam(':nom_repre',$nom_repre);
	 	$result->bindParam(':correo_repre',$correo_repre);
	 	$result->bindParam(':raz_soci',$raz_soci);
	 	$result->bindParam(':sect_econ',$sect_econ);
	 	$result->bindParam(':desc_emp',$desc_emp);
	 	$result->bindParam(':id_admi',$id_admi);
	 	$result->bindParam(':pefid',$pefid);
	 	$result->bindParam(':idtipemp',$idtipemp);
	 	$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Empresa Actualizada');</script>";
	}
	//1.3.4. Crear Funciona ELIMINAR()
	public function del_empresa($emp_nit){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM empresa WHERE emp_nit=:emp_nit;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':emp_nit',$emp_nit);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	//1.3.5.1. Crear Funcion CARGA_DATOS [COMBOBOX]
	public function list_administrador(){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_admi, nom FROM administrador;";
		$result = $conexion->prepare($sql);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function list_perfil(){
		$resultado2 = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pefid, pefnom FROM perfil;";
		$result2 = $conexion->prepare($sql);
		$result2->execute();
		while($f=$result2->fetch()){
			$resultado2[]=$f;
		}
		return $resultado2;
	}

	public function list_tipoempresa(){
		$resultado3 = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idtipemp, tipo_emp FROM tipoempresa;";
		$result3 = $conexion->prepare($sql);
		$result3->execute();
		while($f=$result3->fetch()){
			$resultado3[]=$f;
		}
		return $resultado3;
	}

	public function sel_empresa_act($emp_nit){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT emp_nit, nom_emp, direc, ciudad, tel, nom_repre, correo_repre, raz_soci, sect_econ, desc_emp, id_admi, pefid, idtipemp, emausu, pasusu FROM empresa WHERE emp_nit=:emp_nit;";
		$result1 = $conexion->prepare($sql);
		$result1->bindParam(':emp_nit',$emp_nit);
		$result1->execute();
		while ($f1=$result1->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(emp_nit) AS Npe FROM empresa';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nom_emp LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}

}


?>