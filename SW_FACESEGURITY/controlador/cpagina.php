<?php 
//1.2. Incluimos nuestra conexion y modelo 

include ("modelo/conexion.php");
include ("modelo/mpagina.php");
include ('modelo/mpaginacion.php');

$pg = 7;
	//variable $arc
	$arc = "home.php";

$mpagina = new mpagina();
    $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;

	$pagid = isset($_POST['pagid']) ? $_POST['pagid']:NULL;
	if (!$pagid)
		$pagid = isset($_GET['pagid']) ? $_GET['pagid']:NULL;
	$pagnom = isset($_POST['pagnom']) ? $_POST['pagnom']:NULL;
	$pagarc = isset($_POST['pagarc']) ? $_POST['pagarc']:NULL;
	$pagmos = isset($_POST['pagmos']) ? $_POST['pagmos']:NULL;
	$pagord = isset($_POST['pagord']) ? $_POST['pagord']:NULL;
	$pagmen = isset($_POST['pagmen']) ? $_POST['pagmen']:NULL;
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
		if($pagid AND $pagnom AND $pagarc AND $pagmos AND $pagord AND $pagmen){
			$mpagina->ins_pagina($pagid, $pagnom, $pagarc, $pagmos, $pagord, $pagmen);
		}
		$pagid ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($pagid AND $pagnom AND $pagarc AND $pagmos AND $pagord AND $pagmen){
			$mpagina->upd_pagina($pagid, $pagnom, $pagarc, $pagmos, $pagord, $pagmen);
		}	
		$pagid ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mpagina->del_pagina($del);
		$pagid ="";
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
	$conp = $mpagina->selcount($filtro); 
	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/
	//1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)/

	function form_registro($pagid){
	    $mpagina = new mpagina();
	    //Listamos nuetros perfiles(modulo)
		$result1 = $mpagina->sel_pagina_act($pagid);

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
							$txt .= '<input type="number" name="pagid" max="999999999999" value="'.$pagid.'"/>';
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
							$txt .= '<input type="text" name="pagnom" maxlength="50" value="';
						if ($pagid)
						$txt .= $result1[0]["pagnom"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';

					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'URL:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="pagarc" maxlength="50" value="';
						if ($pagid)
						$txt .= $result1[0]["pagarc"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';

					//4ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Mostrar:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="pagmos" maxlength="999999999999" value="';
						if ($pagid)
						$txt .= $result1[0]["pagmos"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ta Fila Cierre
					$txt .= '</tr>';

					//5ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Orden:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="pagord" maxlength="999999999999" value="';
						if ($pagid)
						$txt .= $result1[0]["pagord"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ta Fila Cierre
					$txt .= '</tr>';
					//6ta Fila Inicio (tr)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Mensaje:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="pagmen" maxlength="50" value="';
						if ($pagid)
						$txt .= $result1[0]["pagmen"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ta Fila Cierre
					$txt .= '</tr>';
					
					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($pagid)
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
	//1.6. Creamos la funcion de nuestra vista (HTML) Listar_Registro/
	function form_mostrar($conp,$nreg,$pg,$bo,$filtro,$arc){
		$mpagina = new mpagina();
	//Instanciamos en [$pa] la clase mpagina
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Ingrese la nueva pagina' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mpagina->sel_pagina($filtro,$pa->rvalini(),$pa->rvalfin());
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
						$txt .= 'ID';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre(s)';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'URL';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Mostrar';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Orden';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Mensaje';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach ($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagid"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagnom"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagarc"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagmos"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagord"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pagmen"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=007&pagid='.$f["pagid"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=007&del='.$f["pagid"].'">
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