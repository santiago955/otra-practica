<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mtipoempresa.php");
require_once('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
$pg = 9;
	
$arc = "home.php";

    $mtipoempresa = new mtipoempresa();
    $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	$idtipemp = isset($_POST['idtipemp']) ? $_POST['idtipemp']:NULL;
	if (!$idtipemp)

	$idtipemp = isset($_GET['idtipemp']) ? $_GET['idtipemp']:NULL;
	$tipo_emp = isset($_POST['tipo_emp']) ? $_POST['tipo_emp']:NULL;
	$sector = isset($_POST['sector']) ? $_POST['sector']:NULL;
	$procapital = isset($_POST['procapital']) ? $_POST['procapital']:NULL;
	$ambactuacion = isset($_POST['ambactuacion']) ? $_POST['ambactuacion']:NULL;
	
	//capturamos la accion (C-U-D) metodo - POST(Form)
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	$del = isset($_POST['del']) ? $_POST['del']:NULL;
	//capturamos la accion (C-U-D) metodo - GET(URL)
	$del = isset($_GET['del']) ? $_GET['del']:NULL;
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	//1.4. Validamos el tipo de operacion (Accion (Evento_Vista))

	//1.4.1. Inserción
	if($opera=="Insertar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($idtipemp AND $tipo_emp AND $sector AND $procapital AND $ambactuacion){
			$mtipoempresa->ins_tipoempresa($idtipemp, $tipo_emp, $sector, $procapital, $ambactuacion);
		}
		$idtipemp ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($idtipemp AND $tipo_emp AND $sector AND $procapital AND $ambactuacion){
			$mtipoempresa->upd_tipoempresa($idtipemp, $tipo_emp, $sector, $procapital, $ambactuacion);
		}	
		$idtipemp ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mtipoempresa->del_tipoempresa($del);
		$idtipemp ="";
		$opera ="";	
		$del ="";
	}

	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/
	$bo = '';
	//Varible numero de registro a mostrar
	$nreg = 2;
	//Crea un objeto [pa] que se instanciar la clase [mpagina.php]
	$pa = new mpaginacion();
	$preg = $pa->mpagin($nreg);
	//Variable de cant_num_registros
	$conp = $mtipoempresa->selcount($filtro);

	function form_registro($idtipemp){
	    $mtipoempresa = new mtipoempresa();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 =$mtipoempresa->sel_tipoempresa_act($idtipemp);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';


					//1raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'ID:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="idtipemp" max="999999999999" value="'.$idtipemp.'"/>';
						$txt .= '</td>';
					//1ra Fila Cierre
					$txt .= '</tr>';


					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Tipo de Empresa:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="tipo_emp" maxlength="50" value="';
						if ($idtipemp)
						$txt .= $result1[0]["tipo_emp"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Sector de Actividad:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="sector" maxlength="50" value="';
						if ($idtipemp)
						$txt .= $result1[0]["sector"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';


					//4da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Propiedad Capital:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="procapital" maxlength="50" value="';
						if ($idtipemp)
						$txt .= $result1[0]["procapital"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ra Fila Cierre
					$txt .= '</tr>';


					//5ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Ambito de Actuacion:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="ambactuacion" maxlength="50" value="';
						if ($idtipemp)
						$txt .= $result1[0]["ambactuacion"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ra Fila Cierre
					$txt .= '</tr>';


					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($idtipemp)
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
function form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc){
		$mtipoempresa = new mtipoempresa();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Tipo Empresa' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mtipoempresa->sel_tipoempresa($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";
		if($result){
		$txt .= '<div class="cuad1" style="width: 90%;">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)			
				$txt .= '<tr>';
					$txt .= '<th>';
						$txt .= 'ID';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Tipo de Empresa';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Sector de Actividad';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Propiedad Capital';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Ambito de Actuacion';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["idtipemp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["tipo_emp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["sector"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["procapital"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["ambactuacion"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=009&idtipemp='.$f["idtipemp"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=009&del='.$f["idtipemp"].'">
						<img src="img/elemi.png" title="Eliminar"</a></td>';
				//Cierre ROW - Datos de la tabla
				$txt .= '</tr>';
				}
			$txt .= '</table>';
		$txt .= '</div>';
		}else{
		$txt .= '<div class="cuad" style="width: 90%;">';
		$txt .= '<h3>No existen datos registrado en la base de datos...</h3>';
		$txt .= '</div>';		
	}
		echo $txt;
	}


?>