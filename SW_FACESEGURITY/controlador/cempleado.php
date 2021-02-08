<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mempleado.php");
include ('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
    $pg = 003;
	//variable $arc
	$arc = "home.php";

    $mempleado = new mempleado();
      $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	  

	$id_emp = isset($_POST['id_emp']) ? $_POST['id_emp']:NULL;
	if (!$id_emp)
	$id_emp = isset($_GET['id_emp']) ? $_GET['id_emp']:NULL;
	$nomb = isset($_POST['nomb']) ? $_POST['nomb']:NULL;
	$apelli = isset($_POST['apelli']) ? $_POST['apelli']:NULL;
	$correo = isset($_POST['correo']) ? $_POST['correo']:NULL;
	$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
	$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu']:NULL;
	$id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo']:NULL;
	$ini_cont = isset($_POST['ini_cont']) ? $_POST['ini_cont']:NULL;
	$direc = isset($_POST['direc']) ? $_POST['direc']:NULL;
	$tel = isset($_POST['tel']) ? $_POST['tel']:NULL;
	$genero = isset($_POST['genero']) ? $_POST['genero']:NULL;
	$foto = isset($_POST['foto']) ? $_POST['foto']:NULL;
	$estado = isset($_POST['estado']) ? $_POST['estado']:NULL;
	$id_dependencia = isset($_POST['id_dependencia']) ? $_POST['id_dependencia']:NULL;
	$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
	
	//capturamos la accion (C-U-D) metodo - POST(Form)
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	$del = isset($_POST['del']) ? $_POST['del']:NULL;
	//capturamos la accion (C-U-D) metodo - GET(URL)
	$del = isset($_GET['del']) ? $_GET['del']:NULL;
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	//1.4. Validamos el tipo de operacion (Accion (Evento_Vista))

	//1.4.1. Inserción
	if($opera=="Insertar"){

		$pp = sha1(md5($pasusu));
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_emp AND $nomb AND $apelli AND $correo AND $emausu AND $pp AND $id_cargo AND $ini_cont AND $direc AND $tel AND $genero AND $foto AND $estado AND $id_dependencia AND $pefid){
			$mempleado->ins_empleado($id_emp, $nomb, $apelli, $correo, $emausu, $pp, $id_cargo, $ini_cont, $direc, $tel, $genero, $foto, $estado, $id_dependencia, $pefid);
		}
		$id_emp ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){

		$pp = sha1(md5($pasusu));
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_emp AND $nomb AND $apelli AND $correo AND $emausu AND $pp AND $id_cargo AND $ini_cont AND $direc AND $tel AND $genero AND $foto AND $estado AND $id_dependencia AND $pefid){
			$mempleado->upd_empleado($id_emp, $nomb, $apelli, $correo, $emausu, $pp, $id_cargo, $ini_cont, $direc, $tel, $genero, $foto, $estado, $id_dependencia, $pefid);
		}	
		$id_emp ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mempleado->del_empleado($del);
		$id_emp ="";
		$opera ="";	
		$del ="";
	}

	//Paginacion
	$bo = '';
	//Varible numero de registro a mostrar
	$nreg = 2;
	//Crea un objeto [pa] que se instanciar la clase [mpagina.php]
	$pa = new mpaginacion();
	$preg = $pa->mpagin($nreg);
	//Variable de cant_num_registros
	$conp = $mempleado->selcount($filtro); 
	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/

	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/

	function form_registro($id_emp){
	    $mempleado = new mempleado();
	    //Listamos nuetros perfiles(modulo)
		$result = $mempleado->list_perfil();
		$result2 = $mempleado->list_cargo();
		$result3 = $mempleado->list_dependencia();

		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 =$mempleado->sel_empleado_act($id_emp);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';

				 		//4raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'ID Usuario:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="id_emp" max="999999999999" value="'.$id_emp.'"/>';
						$txt .= '</td>';
					//4ra Fila Cierre
					$txt .= '</tr>';


					//1da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Nombre:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="nomb" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["nomb"];
						$txt .= '"/>';
						$txt .= '</td>';
					//1da Fila Cierre
					$txt .= '</tr>';


					//2ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Apellido:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="apelli" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["apelli"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2ra Fila Cierre
					$txt .= '</tr>';


					//3da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Correo:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="email" name="correo" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["correo"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';



					//5da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Usuario:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="emausu" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["emausu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ra Fila Cierre
					$txt .= '</tr>';

						//5da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Contraseña:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="pasusu" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["pasusu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ra Fila Cierre
					$txt .= '</tr>';


					//6ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'ID Cargo: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="id_cargo">';
						foreach ($result2 as $f) {
							$txt .= '<option value="'.$f['id_cargo'].'" ';
							if($f['id_cargo'] and $f['id_cargo']==$result2[0]["id_cargo"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['tip_cargo'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//6ta Fila Cierre
					$txt .= '</tr>';



					//7ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Fecha de Contrato:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="date" name="ini_cont" value="';
						if ($id_emp)
						$txt .= $result1[0]["ini_cont"];
						$txt .= '"/>';
						$txt .= '</td>';
					//7ta Fila Cierre
					$txt .= '</tr>';


					//8da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Dirreción:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="direc" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["direc"];
						$txt .= '"/>';
						$txt .= '</td>';
					//8ra Fila Cierre
					$txt .= '</tr>';


					//9raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Telefono:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="tel" max="999999999999" value="'.$id_emp.'"/>';
						$txt .= '</td>';
					//9ra Fila Cierre
					$txt .= '</tr>';



					//10ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Genero:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="genero" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["genero"];
						$txt .= '"/>';
						$txt .= '</td>';
					//10ta Fila Cierre
					$txt .= '</tr>';


					//11ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Foto:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="foto" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["foto"];
						$txt .= '"/>';
						$txt .= '</td>';
					//11ta Fila Cierre
					$txt .= '</tr>';


					//12ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Estado:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="estado" maxlength="50" value="';
						if ($id_emp)
						$txt .= $result1[0]["estado"];
						$txt .= '"/>';
						$txt .= '</td>';
					//12ta Fila Cierre
					$txt .= '</tr>';


                    //13ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'ID Dependencia: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="id_dependencia">';
						foreach ($result3 as $f) {
							$txt .= '<option value="'.$f['id_dependencia'].'" ';
							if($f['id_dependencia'] and $f['id_dependencia']==$result3[0]["id_dependencia"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['nom'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//13ta Fila Cierre
					$txt .= '</tr>';



					//14ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'ID Perfil: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="pefid">';
						foreach ($result as $f) {
							$txt .= '<option value="'.$f['pefid'].'" ';
							if($f['pefid'] and $f['pefid']==$result[0]["pefid"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['pefnom'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//14ta Fila Cierre
					$txt .= '</tr>';


					

					

					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($id_emp)
							$txt .= 'Actualizar';
						else
							$txt .= 'Insertar';
					$txt .= '" />';
					//Cierre Boton
					$txt .= '</tr>';
				//Cierre Tabla	
				$txt .= '</table>';
			//Cierre Formulario	
			$txt .= '</form>';
		//Cierre Etiqueta DIV	
		$txt .= '</div>';
		//Imprimimos el Formulario(Vista)
		echo $txt;
	}
	/*1.6. Creamos la funcion de nuestra vista (HTML) Listar_Registro*/
function form_mostrar($id_emp,$conp,$nreg,$pg,$bo,$filtro,$arc){
		$mempleado = new mempleado();
		$pa = new mpaginacion();
		$txt = '';
		//Creamos el cuadro de buscar (filtros-Busquedas)
		$txt .= "<table>";
			//Una Fila
			$txt .= "<tr>";
				//1ra Columna - Formulario buscar
				$txt .= "<td>";
					$txt .= "<form name='forfil' method='GET' action='".$arc."'>";
						$txt .= "<input type='hidden' name='pg' value='".$pg."' />";
						//Campo de texto para escribir el dato a buscar
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Ingrese El Nombre Del Empleado' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mempleado->sel_empleado($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";

		if ($result) {
		$txt .= '<div class="cuad2" style="width: 100%;">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)			
				$txt .= '<tr>';
					$txt .= '<th>';
						$txt .= 'Id Cargo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Apellido';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'correo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Usuario';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Contraseña';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'ID Cargo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Fecha Contrato';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Direccion';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Telefono';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Genero';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Foto';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Estado';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'ID Pendencia';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Id Perfil';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_emp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nomb"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["apelli"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["correo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["emausu"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pasusu"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_cargo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["ini_cont"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["direc"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["tel"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["genero"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["foto"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["estado"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_dependencia"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pefid"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=003&id_emp='.$f["id_emp"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=003&del='.$f["id_emp"].'">
						<img src="img/elemi.png" title="Eliminar"</a></td>';
				//Cierre ROW - Datos de la tabla
				$txt .= '</tr>';
				}
			$txt .= '</table>';
	$txt .= '</div>';
	}else{
	$txt.= '<div class="cuad" style=" width": 90%;">';
	$txt.= '<h3> No existen datos registrado en la base de datos...</h3>';
	$txt.='</div>';
        }

		echo $txt;
	}

?>