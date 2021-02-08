<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mcargo.php");
include ('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
$pg = 6;
	//variable $arc
	$arc = "home.php";

    $mcargo = new mcargo();
    $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;


	$id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo']:NULL;
	if (!$id_cargo)

	$id_cargo = isset($_GET['id_cargo']) ? $_GET['id_cargo']:NULL;
	$tip_cargo = isset($_POST['tip_cargo']) ? $_POST['tip_cargo']:NULL;
	$nom_cargo = isset($_POST['nom_cargo']) ? $_POST['nom_cargo']:NULL;
	$fec_cargo = isset($_POST['fec_cargo']) ? $_POST['fec_cargo']:NULL;
	$estado = isset($_POST['estado']) ? $_POST['estado']:NULL;
	
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
		if($id_cargo AND $tip_cargo AND $nom_cargo AND $fec_cargo AND $estado){
			$mcargo->ins_cargo($id_cargo, $tip_cargo, $nom_cargo, $fec_cargo, $estado);
		}
		$id_cargo ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_cargo AND $tip_cargo AND $nom_cargo AND $fec_cargo AND $estado){
			$mcargo->upd_cargo($id_cargo, $tip_cargo, $nom_cargo, $fec_cargo, $estado);
		}	
		$id_cargo ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mcargo->del_cargo($del);
		$id_cargo ="";
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
	$conp = $mcargo->selcount($filtro); 
	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/

	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/

	function form_registro($id_cargo){
	    $mcargo = new mcargo();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 =$mcargo->sel_cargo_act($id_cargo);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';


					//1raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'ID Cargo:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="id_cargo" max="999999999999" value="'.$id_cargo.'"/>';
						$txt .= '</td>';
					//1ra Fila Cierre
					$txt .= '</tr>';


					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Tipo De Cargo:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="tip_cargo" maxlength="50" value="';
						if ($id_cargo)
						$txt .= $result1[0]["tip_cargo"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Nombre del Cargo:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="nom_cargo" maxlength="50" value="';
						if ($id_cargo)
						$txt .= $result1[0]["nom_cargo"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';


					//4da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Fecha de Creacion:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="date" name="fec_cargo"  value="';
						if ($id_cargo)
						$txt .= $result1[0]["fec_cargo"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ra Fila Cierre
					$txt .= '</tr>';


					//5ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Estado:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="estado" maxlength="50" value="';
						if ($id_cargo)
						$txt .= $result1[0]["estado"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ra Fila Cierre
					$txt .= '</tr>';


					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($id_cargo)
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
		$mcargo = new mcargo();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Ingrese el nuevo cargo' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mcargo->sel_cargo($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";
		if ($result) {
		$txt .= '<div class="cuad1" style="width: 90%;">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)			
				$txt .= '<tr>';
					$txt .= '<th>';
						$txt .= 'ID Cargo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Tipo de Cargo';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre del Crago';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Fecha de Creacion';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Estado';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_cargo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["tip_cargo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom_cargo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["fec_cargo"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["estado"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=006&id_cargo='.$f["id_cargo"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=006&del='.$f["id_cargo"].'">
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