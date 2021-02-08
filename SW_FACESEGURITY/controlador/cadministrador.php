<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/madministrador.php");
require_once('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
$pg = 1;
	//variable $arc
$arc = "home.php";

	$madministrador = new madministrador();
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	$id_admi = isset($_POST['id_admi']) ? $_POST['id_admi']:NULL;
	if (!$id_admi)
		$id_admi = isset($_GET['id_admi']) ? $_GET['id_admi']:NULL;
	$nom = isset($_POST['nom']) ? $_POST['nom']:NULL;
	
	$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;

	$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
	$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu']:NULL;



	//capturamos la accion (C-U-D) metodo - POST(Form)
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	$del = isset($_POST['del']) ? $_POST['del']:NULL;
	//capturamos la accion (C-U-D) metodo - GET(URL)
	$del = isset($_GET['del']) ? $_GET['del']:NULL;
	$opera = isset($_POST['operacion']) ? $_POST['operacion']:NULL;
	//1.4. Validamos el tipo de operacion (Accion (Evento_Vista))

// 1.4. Validamos el tipo de operacion (Accion(Evento_Vista(User)))

	//1.4.1. Inserción
	if($opera=="Insertar"){

		$pp = sha1(md5($pasusu));
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_admi AND $nom AND $pefid AND $emausu AND $pp){
			$madministrador->ins_administrador($id_admi, $nom, $pefid, $emausu, $pp);
		}
		$id_admi ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){

	    $pp = sha1(md5($pasusu));
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($id_admi AND $nom AND $pefid AND $emausu AND $pp){
			$madministrador->upd_administrador($id_admi,$nom, $pefid, $emausu, $pp);
		}	
		$id_admi ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$madministrador->del_administrador($del);
		$id_admi ="";
		$opera ="";	
		$del ="";
	}
	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/
//1.5. Creamos las FUNCION Y CODIGO FORM para visualizar en (VISTA(vusu.php))
	//- N O T A - Deberemos guardar algunos icnos en la carpeta [/image] (Actualizar - Eliminar)
	$bo = '';
	//Varible numero de registro a mostrar
	$nreg = 3;
	//Crea un objeto [pa] que se instanciar la clase [mpagina.php]
	$pa = new mpaginacion();
	$preg = $pa->mpagin($nreg);
	//Variable de cant_num_registros
	$conp = $madministrador->selcount($filtro);

	function form_registro($id_admi){
	    $madministrador = new madministrador();
	    //Listamos nuetros perfiles(modulo)
		$result = $madministrador->list_Perfil();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 = $madministrador->sel_administrador_act($id_admi);

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
							$txt .= '<input type="number" name="id_admi" max="999999999999" value="'.$id_admi.'"/>';
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
						if ($id_admi)
						$txt .= $result1[0]["nom"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					
					//6ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'Id Perfil: ';

						//$txt .= $result[0]["id_perf"];
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
					//6ta Fila Cierre
					$txt .= '</tr>';


					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Usuario:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="emausu" maxlength="100" value="';
						if ($id_admi)
						$txt .= $result1[0]["emausu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Contraseña:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="pasusu" maxlength="50" value="';
						if ($id_admi)
						$txt .= $result1[0]["pasusu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';



					
					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($id_admi)
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

// 1.6. Creamos las FUNCION Y CODIGO TABAL para visualizar en (VISTA(vusu.php))

	function form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc){
		$madministrador = new madministrador();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Nombre del admin' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $madministrador->sel_administrador($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";
		
		if($result){
		$txt .= '<div class="cuad1" style="width: 90%; ">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)		
				$txt .= '<tr>';
					$txt .= '<th>';
						$txt .= 'ID';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre(s)';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Perfil';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Usuario';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Contraseña';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_admi"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pefid"];
					$txt .= '<td align="center">';	
						$txt .= $f["emausu"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pasusu"];
					$txt .= '</td>';

					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=001&id_admi='.$f["id_admi"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=001&del='.$f["id_admi"].'">
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