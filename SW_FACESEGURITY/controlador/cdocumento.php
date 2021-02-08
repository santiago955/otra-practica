<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mdocumento.php");
require_once('modelo/mpaginacion.php');

$pg = 5;

$arc = "home.php";

$mdocumento = new mdocumento();
$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	$id_doc = isset($_POST['id_doc']) ? $_POST['id_doc']:NULL;
	if (!$id_doc)
	$id_doc = isset($_GET['id_doc']) ? $_GET['id_doc']:NULL;
	$nom = isset($_POST['nom']) ? $_POST['nom']:NULL;
	$aut_doc = isset($_POST['aut_doc']) ? $_POST['aut_doc']:NULL;
	$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
	$id_emp = isset($_POST['id_emp']) ? $_POST['id_emp']:NULL;
	$id_tpdoc = isset($_POST['id_tpdoc']) ? $_POST['id_tpdoc']:NULL;
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
		if($id_doc AND $nom AND $aut_doc AND $fec_crea AND $id_emp AND $id_tpdoc){
			$mdocumento->ins_documento($id_doc, $nom, $aut_doc, $fec_crea, $id_emp, $id_tpdoc);
		}
		$id_doc ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_doc AND $nom AND $aut_doc AND $fec_crea AND $id_emp AND $id_tpdoc){
			$mdocumento->upd_documento($id_doc, $nom, $aut_doc, $fec_crea, $id_emp, $id_tpdoc);
		}	
		$id_doc ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mdocumento->del_documento($del);
		$id_doc ="";
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
	$conp = $mdocumento->selcount($filtro);

	function form_registro($id_doc){
	    $mdocumento = new mdocumento();
	    //Listamos nuetros perfiles(modulo)
		$result = $mdocumento->list_empleado();
		$result2 = $mdocumento->list_tipodocumento();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 = $mdocumento->sel_documento_act($id_doc);

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
							$txt .= '<input type="number" name="id_doc" max="999999999999" value="'.$id_doc.'"/>';
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
						if ($id_doc)
						$txt .= $result1[0]["nom"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';
					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Autor:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="aut_doc" maxlength="50" value="';
						if ($id_doc)
						$txt .= $result1[0]["aut_doc"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';
					//4ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Fecha Creacion:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="date" name="fec_crea" maxlength="50" value="';
						if ($id_doc)
						$txt .= $result1[0]["fec_crea"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ta Fila Cierre
					$txt .= '</tr>';
					
					//6ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'Empleado: ';
						//$txt .= $result[0]["id_perf"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="id_emp">';
						foreach ($result as $f) {
							$txt .= '<option value="'.$f['id_emp'].'" ';
							if($f['id_emp'] and $f['id_emp']==$result[0]["id_emp"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['nomb'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//6ta Fila Cierre
					$txt .= '</tr>';

					//7ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'T.Documento: ';
						//$txt .= $result[0]["id_perf"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="id_tpdoc">';
						foreach ($result2 as $f) {
							$txt .= '<option value="'.$f['id_tpdoc'].'" ';
							if($f['id_tpdoc'] and $f['id_tpdoc']==$result2[0]["id_tpdoc"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['nom_tpdoc'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//6ta Fila Cierre
					$txt .= '</tr>';
					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($id_doc)
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
		$mdocumento = new mdocumento();
		$pa = new mpaginacion();
		$txt = '';
		$txt .= "<table>";
			//Una Fila
			$txt .= "<tr>";
				//1ra Columna - Formulario buscar
				$txt .= "<td>";
					$txt .= "<form name='forfil' method='GET' action='".$arc."'>";
						$txt .= "<input type='hidden' name='pg' value='".$pg."' />";
						//Campo de texto para escribir el dato a buscar
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Documento' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mdocumento->sel_documento($filtro,$pa->rvalini(),$pa->rvalfin());
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
						$txt .= 'Nombre Doc';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Autor Doc';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Fecha Creacion';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Empleado';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Tipo';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_doc"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["aut_doc"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["fec_crea"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_emp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_tpdoc"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=005&id_doc='.$f["id_doc"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=005&del='.$f["id_doc"].'">
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