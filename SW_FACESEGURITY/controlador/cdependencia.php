<?php 
include ("modelo/conexion.php");
include ("modelo/mdependencia.php");
require_once('modelo/mpaginacion.php');

$pg = 4;
$arc = "home.php";

$mdependencia = new mdependencia();
$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	$id_dependencia = isset($_POST['id_dependencia']) ? $_POST['id_dependencia']:NULL;
	if (!$id_dependencia)
		$id_dependencia = isset($_GET['id_dependencia']) ? $_GET['id_dependencia']:NULL;
	$nom = isset($_POST['nom']) ? $_POST['nom']:NULL;
	$correo = isset($_POST['correo']) ? $_POST['correo']:NULL;
	$activi = isset($_POST['activi']) ? $_POST['activi']:NULL;
	$nove = isset($_POST['nove']) ? $_POST['nove']:NULL;
	/*$contra = sha1 ($pasusu);
	$pasusu = $contra;*/
	$emp_nit = isset($_POST['emp_nit']) ? $_POST['emp_nit']:NULL;
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
		if($id_dependencia AND $nom AND $correo AND $activi AND $nove AND $emp_nit){
			$mdependencia->ins_dependencia($id_dependencia, $nom, $correo, $activi, $nove, $emp_nit);
		}
		$id_dependencia ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_dependencia AND $nom AND $correo AND $activi AND $nove AND $emp_nit){
			$mdependencia->upd_dependencia($id_dependencia, $nom, $correo, $activi, $nove, $emp_nit);
		}	
		$id_dependencia ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mdependencia->del_dependencia($del);
		$id_dependencia ="";
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
	$conp = $mdependencia->selcount($filtro);
	
	function form_registro($id_dependencia){
	    $mdependencia = new mdependencia();
	    //Listamos nuetros perfiles(modulo)
		$result = $mdependencia->list_empresa();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 = $mdependencia->sel_dependencia_act($id_dependencia);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';


					//1raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Id:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="id_dependencia" max="99999999999" value="'.$id_dependencia.'"/>';
						$txt .= '</td>';
					//1ra Fila Cierre
					$txt .= '</tr>';
					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Nombre:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="nom" maxlength="50" value="';
						if ($id_dependencia)
						$txt .= $result1[0]["nom"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Correo:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="email" name="correo" maxlength="50" value="';
						if ($id_dependencia)
						$txt .= $result1[0]["correo"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';


					//4ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Actividad:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="activi" maxlength="50" value="';
						if ($id_dependencia)
						$txt .= $result1[0]["activi"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ta Fila Cierre
					$txt .= '</tr>';
					//5ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Novedad:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="nove" maxlength="50" value="';
						if ($id_dependencia)
						$txt .= $result1[0]["nove"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ta Fila Cierre
					$txt .= '</tr>';


					//6ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'Empresa: ';
						//$txt .= $result[0]["id_perf"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="emp_nit">';
						foreach ($result as $f) {
							$txt .= '<option value="'.$f['emp_nit'].'" ';
							if($f['emp_nit'] and $f['emp_nit']==$result[0]["emp_nit"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['nom_emp'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//6ta Fila Cierre
					$txt .= '</tr>';


					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($id_dependencia)
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
		$mdependencia = new mdependencia();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Nombre de dependencia' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mdependencia->sel_dependencia($filtro,$pa->rvalini(),$pa->rvalfin());
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
						$txt .= 'Nombre';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Correo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Actividad';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Novedad';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Empresa';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_dependencia"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["correo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["activi"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nove"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["emp_nit"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=004&id_dependencia='.$f["id_dependencia"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=004&del='.$f["id_dependencia"].'">
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
