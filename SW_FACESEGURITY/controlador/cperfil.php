<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mperfil.php");
include ('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
$pg = 8;
	//variable $arc
	$arc = "home.php";

    $mperfil = new mperfil();
	
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;

	$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
	if (!$pefid)

	$pefid = isset($_GET['pefid']) ? $_GET['pefid']:NULL;
	$pefnom = isset($_POST['pefnom']) ? $_POST['pefnom']:NULL;

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
		if($pefid AND $pefnom){
			$mperfil->ins_perfil($pefid, $pefnom);
		}
		$pefid ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($pefid AND $pefnom){
			$mperfil->upd_perfil($pefid, $pefnom);
		}	
		$pefid ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mperfil->del_perfil($del);
		$pefid ="";
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
	$conp = $mperfil->selcount($filtro); 
	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/


	/*1.5. Creamos la funcion de nuestra vista (HTML) que se cargara en (vtab.php)*/

	function form_registro($pefid){
	    $mperfil = new mperfil();
		//Cargar los datos de nuestro user a atualizar(modulo)
		$result = $mperfil->sel_perfil_act($pefid);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';


					//1raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'PERFIL:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="pefid" max="999999999999" value="'.$pefid.'"/>';
						$txt .= '</td>';
					//1ra Fila Cierre
					$txt .= '</tr>';


					//2da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Nombre Perfil:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="pefnom" maxlength="50" value="';
						if ($pefid)
						$txt .= $result[0]["pefnom"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';

					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit"class="btn btn-primary" name="operacion" value="';
						if ($pefid)
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
		$mperfil = new mperfil();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Ingrese El Nombre Del Empleado' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mperfil->sel_perfil($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";
		if ($result) {
		$txt .= '<div class="cuad1" style="width: 90%;">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)			
				$txt .= '<tr class="bg-success">';
					$txt .= '<th>';
						$txt .= 'PERFIL';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre Perfil';
					$txt .= '</th>';
					$txt .= '<th></th>';
					$txt .= '<th></th>';
				$txt .= '</tr>';
				//Cierre de la (Cabecera_Tb)
				foreach($result as $f) {
				//Inicio ROW - Datos de la tabla
				$txt .= '<tr>';
					$txt .= '<td align="center">';	
						$txt .= $f["pefid"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pefnom"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=008&pefid='.$f["pefid"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=008&del='.$f["pefid"].'">
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