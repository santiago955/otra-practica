
<?php 

class mpagina{


public function ins_pagina($pagid, $pagnom, $pagarc,$pagmos, $pagord, $pagmen){
		//Instanciar la clase/(objeto) conexion en variable $modelo
	 	$modelo = new conexion();
	 	//variable $modelo le heredo la funcion de mi clase
	 	$conexion = $modelo->get_conexion();
	 	//Llamado de mi PROCEDURE almacenado y envio parametros
	 	$sql = "CALL registrarpagina(:pag_id, :pag_nom, :pag_arc, :pag_mos, :pag_ord, :pag_men);";
	 	//Creo variable $result para alistar la consulta con parametros
	 	$result = $conexion->prepare($sql);
	 	//Reemplazo los parametro(PRECEDURE) por los recibidos desde el Controlador(funcion)
	$result->bindParam(':pag_id',$pagid);
	 	$result->bindParam(':pag_nom',$pagnom);
	 	$result->bindParam(':pag_arc',$pagarc);
	 	$result->bindParam(':pag_mos',$pagmos);
	 	$result->bindParam(':pag_ord',$pagord);
	 	$result->bindParam(':pag_men',$pagmen);
	
	 	//Valido si la variable $result(Esta Vacia)
	 	if(!$result)
	  		echo "<script>alert('ERROR al insertar pagina');</script>";
	 	else
	  	$result->execute();
	  		echo "<script>alert('Pagina registrada correctamente...');</script>";
	}
	public function sel_pagina($filtro,$rvini,$rvfin){
		$resultado = null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = 'SELECT pagid, pagnom, pagarc, pagmos, pagord, pagmen FROM pagina';

		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE pagnom LIKE :filtro';
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
	public function upd_pagina($pagid, $pagnom, $pagarc, $pagmos, $pagord, $pagmen){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql =  "UPDATE pagina SET pagid=:pagid, pagnom=:pagnom, pagarc=:pagarc, pagmos=:pagmos, pagord=:pagord, pagmen=:pagmen WHERE pagid=:pagid;";
		$result = $conexion->prepare($sql);

	    $result->bindParam(':pagid',$pagid);
		$result->bindParam(':pagnom',$pagnom);
		$result->bindParam(':pagarc',$pagarc);
		$result->bindParam(':pagmos',$pagmos);
		$result->bindParam(':pagord',$pagord);
		$result->bindParam(':pagmen',$pagmen);


		if(!$result)
			echo "<script>alert('Error al actualizar');</script>";
		else
			$result->execute();
			echo "<script>alert('Pagina Actualizado');</script>";
		}
		public function del_pagina($pagid){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion(); 
		$sql = "DELETE FROM pagina WHERE pagid=:pagid;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':pagid',$pagid);

		if(!$result)
			echo "<script>alert('Error al ELIMINAR');</script>";
		else
			$result->execute();
	}
	
      public function sel_pagina_act($pagid){
		$resultado1 = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT pagid, pagnom, pagarc, pagmos, pagord, pagmen FROM pagina WHERE pagid=:pagid;";
		$result = $conexion->prepare($sql);
		$result->bindParam(':pagid',$pagid);
		$result->execute();
		while ($f1=$result
			->fetch()){
			$resultado1[]=$f1;
		}
		return $resultado1;
	}
public function selcount($filtro){
		$sql = 'SELECT COUNT(pagnom) AS Npe FROM pagina';
		if($filtro){
			$filtro = '%'.$filtro.'%';
			$sql .= ' WHERE pagnom LIKE "'.$filtro.'";';
		}
		//echo $sql;
		return $sql;
	}

}

?>