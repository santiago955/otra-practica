<?php 

class mempleado{


public function ins_empleado($id_emp, $nomb, $apelli, $correo, $emausu, $pasusu, $id_cargo, $ini_cont, $direc, $tel, $genero, $foto, $estado, $id_dependencia, $pefid){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrarempleado(:idemp, :nomb, :apelli, :correo, :emausu, :pasusu, :idcargo, :inicont, :direc, :tel, :genero, :foto, :estado, :iddependencia, :pefid);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	 	$result->bindParam(':idemp',$id_emp);
	    $result->bindParam(':nomb',$nomb);
	 	$result->bindParam(':apelli',$apelli);
	 	$result->bindParam(':correo',$correo);
	 	$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);
	 	$result->bindParam(':idcargo',$id_cargo);
	 	$result->bindParam(':inicont',$ini_cont);
	 	$result->bindParam(':direc',$direc);
	 	$result->bindParam(':tel',$tel);
	 	$result->bindParam(':genero',$genero);
	 	$result->bindParam(':foto',$foto);
	 	$result->bindParam(':estado',$estado);
	 	$result->bindParam(':iddependencia',$id_dependencia);
	 	$result->bindParam(':pefid',$pefid);
	
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar Empleado');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Empleado registrado correctamente...');</script>";
	}
	public function sel_empleado($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT id_emp, nomb, apelli, correo, emausu, pasusu, id_cargo,ini_cont,direc,tel,genero,foto,estado,id_dependencia,pefid FROM empleado';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nomb LIKE :filtro';
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
	public function upd_empleado($id_emp, $nomb, $apelli, $correo, $emausu, $pasusu, $id_cargo, $ini_cont, $direc, $tel, $genero, $foto, $estado, $id_dependencia, $pefid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "UPDATE empleado SET id_emp=:id_emp, nomb=:nomb, apelli=:apelli, correo=:correo, emausu=:emausu,  pasusu=:pasusu, id_cargo=:id_cargo, ini_cont=:ini_cont, direc=:direc, tel=:tel, genero=:genero, foto=:foto, estado=:estado, id_dependencia=:id_dependencia, pefid=:pefid WHERE id_emp=:id_emp;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_emp',$id_emp);
		$result->bindParam(':nomb',$nomb);
		$result->bindParam(':apelli',$apelli);
		$result->bindParam(':correo',$correo);
		$result->bindParam(':emausu',$emausu);
	 	$result->bindParam(':pasusu',$pasusu);
		$result->bindParam(':id_cargo',$id_cargo);
		$result->bindParam(':ini_cont',$ini_cont);
		$result->bindParam(':direc',$direc);
		$result->bindParam(':tel',$tel);
		$result->bindParam(':genero',$genero);
		$result->bindParam(':foto',$foto);
		$result->bindParam(':estado',$estado);
		$result->bindParam(':id_dependencia',$id_dependencia);
		$result->bindParam(':pefid',$pefid);
		$result->bindParam(':id_emp',$id_emp);

		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Empleado Actualizado');</script>";
		}
		public function del_empleado($id_emp){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM empleado WHERE id_emp=:id_emp;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':id_emp',$id_emp);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	public function list_perfil(){
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

	public function list_cargo(){
		$resultado2 = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_cargo, tip_cargo FROM cargo;";
		$result2 = $conexion->prepare($sql);
		$result2->execute();
		while($f=$result2->fetch()){
			$resultado2[]=$f;
		}
		return $resultado2;
	}
	public function list_dependencia(){
		$resultado3 = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_dependencia, nom FROM dependencia;";
		$result3 = $conexion->prepare($sql);
		$result3->execute();
		while($f=$result3->fetch()){
			$resultado3[]=$f;
		}
		return $resultado3;
	}
	public function sel_empleado_act($id_emp){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT id_emp, nomb, apelli, correo, emausu, pasusu, id_cargo, ini_cont, direc, tel, genero, foto, estado, id_dependencia, pefid FROM empleado WHERE id_emp=:id_emp;";
		$result1 = $conexion->prepare($sql);
		$result1->bindParam(':id_emp',$id_emp);
		$result1->execute();
		while ($f1=$result1->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
	public function selcount($filtro){
		$sql = 'SELECT COUNT(id_emp) AS Npe FROM empleado';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE nomb LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}

}

?>