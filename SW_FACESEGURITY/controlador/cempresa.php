<?php 
//1.2. Incluimos nuestra conexion y modelo 
include ("modelo/conexion.php");
include ("modelo/mempresa.php");
require_once('modelo/mpaginacion.php');
	//1.3. Instanciamos el modelo a variable php
$pg = 2;

$arc = "home.php";
    $mempresa = new mempresa();
    $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
	$emp_nit = isset($_POST['emp_nit']) ? $_POST['emp_nit']:NULL;
	if (!$emp_nit)

	$emp_nit = isset($_GET['emp_nit']) ? $_GET['emp_nit']:NULL;
	$nom_emp = isset($_POST['nom_emp']) ? $_POST['nom_emp']:NULL;
	$direc = isset($_POST['direc']) ? $_POST['direc']:NULL;
	$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad']:NULL;
	$tel = isset($_POST['tel']) ? $_POST['tel']:NULL;
	$nom_repre = isset($_POST['nom_repre']) ? $_POST['nom_repre']:NULL;
	$correo_repre = isset($_POST['correo_repre']) ? $_POST['correo_repre']:NULL;
	$raz_soci = isset($_POST['raz_soci']) ? $_POST['raz_soci']:NULL;
	$sect_econ = isset($_POST['sect_econ']) ? $_POST['sect_econ']:NULL;
	$desc_emp = isset($_POST['desc_emp']) ? $_POST['desc_emp']:NULL;
	$id_admi = isset($_POST['id_admi']) ? $_POST['id_admi']:NULL;
	$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
	$idtipemp = isset($_POST['idtipemp']) ? $_POST['idtipemp']:NULL;
	$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
	$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu']:NULL;
	
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
		if($emp_nit AND $nom_emp AND $direc AND $ciudad AND $tel AND $nom_repre AND $correo_repre AND $raz_soci AND $sect_econ AND $desc_emp AND $id_admi AND $pefid AND $idtipemp AND $emausu AND $pp){
			$mempresa->ins_empresa($emp_nit, $nom_emp, $direc, $ciudad, $tel, $nom_repre, $correo_repre, $raz_soci, $sect_econ, $desc_emp, $id_admi, $pefid, $idtipemp, $emausu, $pp);
		}
		$emp_nit ="";
		$opera ="";	
		$del ="";
	}
	//1.4.2. Actualizar
	if($opera=="Actualizar"){
		 $pp = sha1(md5($pasusu));
		//Validamos si la var(PHP) estan llenas y las enviamos al nuestro objeto -> metodo(parametros)
		if($emp_nit AND $nom_emp AND $direc AND $ciudad AND $tel AND $nom_repre AND $correo_repre AND $raz_soci AND $sect_econ AND $desc_emp AND $id_admi AND $pefid AND $idtipemp AND $emausu AND $pp){
			$mempresa->upd_empresa($emp_nit, $nom_emp, $direc, $ciudad, $tel, $nom_repre, $correo_repre, $raz_soci, $sect_econ, $desc_emp, $id_admi, $pefid, $idtipemp, $emausu, $pp);
		}	
		$emp_nit ="";
		$opera ="";
		$del ="";
	}
	//1.4.3. Eliminar
	if($del){		
		$mempresa->del_empresa($del);
		$emp_nit ="";
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
	$conp = $mempresa->selcount($filtro);

	function form_registro($emp_nit){
	    $mempresa = new mempresa();
	    //Listamos nuetros perfiles(modulo)
		$result = $mempresa->list_administrador();
		$result2 = $mempresa->list_perfil();
		$result3 = $mempresa->list_tipoempresa();

		//Cargar los datos de nuestro user a atualizar(modulo)
		$result1 =$mempresa->sel_empresa_act($emp_nit);

		$txt = '';
		$txt .= '<div class="cuad">';
			$txt .= '<form name="frm1" action="#" method="POST">';
				$txt .= '<table>';


					//1raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Nit:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="emp_nit" max="999999999999" value="'.$emp_nit.'"/>';
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
							$txt .= '<input type="text" name="nom_emp" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["nom_emp"];
						$txt .= '"/>';
						$txt .= '</td>';
					//2da Fila Cierre
					$txt .= '</tr>';


					//3ra Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Dirreción:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="direc" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["direc"];
						$txt .= '"/>';
						$txt .= '</td>';
					//3ra Fila Cierre
					$txt .= '</tr>';


					//4da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Ciudad:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="ciudad" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["ciudad"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ra Fila Cierre
					$txt .= '</tr>';


					//5raFilas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Telefono:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="number" name="tel" max="999999999999" value="'.$emp_nit.'"/>';
						$txt .= '</td>';
					//5ra Fila Cierre
					$txt .= '</tr>';


					//6da Filas (<tr>)
					$txt .= '<tr>';
					//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Representante:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="varchar" name="nom_repre" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["nom_repre"];
						$txt .= '"/>';
						$txt .= '</td>';
					//6ra Fila Cierre
					$txt .= '</tr>';



					//4ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'E-mail:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="email" name="correo_repre" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["correo_repre"];
						$txt .= '"/>';
						$txt .= '</td>';
					//4ta Fila Cierre
					$txt .= '</tr>';



					//5ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Razon Social:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="raz_soci" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["raz_soci"];
						$txt .= '"/>';
						$txt .= '</td>';
					//5ta Fila Cierre
					$txt .= '</tr>';


					//6ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Sector Economico:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="sect_econ" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["sect_econ"];
						$txt .= '"/>';
						$txt .= '</td>';
					//6ta Fila Cierre
					$txt .= '</tr>';


					//7ta Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Descripcion de Empresa:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="desc_emp" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["desc_emp"];
						$txt .= '"/>';
						$txt .= '</td>';
					//7ta Fila Cierre
					$txt .= '</tr>';


					//8ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'ID Administrador: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="id_admi">';
						foreach ($result as $f) {
							$txt .= '<option value="'.$f['id_admi'].'" ';
							if($f['id_admi'] and $f['id_admi']==$result[0]["id_admi"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['nom'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//8ta Fila Cierre
					$txt .= '</tr>';


					//9ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'ID Perfil: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="pefid">';
						foreach ($result2 as $f) {
							$txt .= '<option value="'.$f['pefid'].'" ';
							if($f['pefid'] and $f['pefid']==$result2[0]["pefid"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['pefnom'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//9ta Fila Cierre
					$txt .= '</tr>';


				//10ta Fila Inicio (tr)
					$txt .= '<tr>';
					$txt .= '<th align="left">';
						$txt .= 'Tipo de Empresa: ';
						//$txt .= $result[0]["id_admi"];
					$txt .= '</th>';

					$txt .= '<td>';
						$txt .= '<select name="idtipemp">';
						foreach ($result3 as $f) {
							$txt .= '<option value="'.$f['idtipemp'].'" ';
							if($f['idtipemp'] and $f['idtipemp']==$result3[0]["idtipemp"])
								$txt .="SELECTED";
							$txt .= ' >'.$f['tipo_emp'].'</option>';
						}
						$txt .= '</select>';
					$txt .= '</td>';
					//10ta Fila Cierre
					$txt .= '</tr>';	


                    //11da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Usuario:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="emausu" maxlength="100" value="';
						if ($emp_nit)
						$txt .= $result1[0]["emausu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//11da Fila Cierre
					$txt .= '</tr>';


					//12da Filas (<tr>)
					$txt .= '<tr>';
						//1ra Cabeceras Negrita (<th>)
						$txt .= '<th align="left">';
							$txt .= 'Contraseña:';
						$txt .= '</th>';
						//2da Cabecera normal (<td>)
						$txt .= '<td>';
							$txt .= '<input type="text" name="pasusu" maxlength="50" value="';
						if ($emp_nit)
						$txt .= $result1[0]["pasusu"];
						$txt .= '"/>';
						$txt .= '</td>';
					//12da Fila Cierre
					$txt .= '</tr>';



					//Insertamos el Boton Centrado
					$txt .= '<tr>';
					$txt .= '<th colspan="2" style="text-align: center;">';
						$txt .= '<input type="submit" name="operacion" value="';
						if ($emp_nit)
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
		$mempresa = new mempresa();
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
						$txt .= "Buscar:<input type='text' name='filtro' value='".$filtro."' placeholder='Nombre Empresa' onChange= 'this.form.submit();' />";
					$txt .= "</form>";
				$txt .= "</td>";
				//2da Columna control de paginacion
				$txt .= "<td align='right' style='padding-left: 10px;'>";
					$bo = "<input type='hidden' name='filtro' value='".$filtro."' />";
					//Llamamos el metodo de contar la cantida de paginas
					$txt .= $pa->spag($conp,$nreg,$pg,$bo,$arc);
					//Llamar los datos para completar la paginacion
					$result = $mempresa->sel_empresa($filtro,$pa->rvalini(),$pa->rvalfin());
				$txt .= "</td>";
			//Cierre Fila
			$txt .= "</tr>";
		$txt .= "</table>";
		if($result){
		$txt .= '<div class="cuad2" style="width: 100%;">';
			$txt .= '<table width="100%" cellspacing="0px" align="center">';
				//Inicio de la (Cabecera_Tb)			
				$txt .= '<tr>';
					$txt .= '<th>';
						$txt .= 'Nit';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Nombre';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Dirreción';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Ciudad';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Telefono';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Representante';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'E-mail';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Razon';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Sector';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Descripcion';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Administrador';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Perfil';
					$txt .= '</th>';
					$txt .= '<th>';
						$txt .= 'Tipo Empresa';
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
						$txt .= $f["emp_nit"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom_emp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["direc"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["ciudad"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["tel"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["nom_repre"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["correo_repre"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["raz_soci"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["sect_econ"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["desc_emp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["id_admi"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pefid"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["idtipemp"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["emausu"];
					$txt .= '</td>';
					$txt .= '<td align="center">';	
						$txt .= $f["pasusu"];
					$txt .= '</td>';
					//ICONOS-MOdificar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=002&emp_nit='.$f["emp_nit"].'">
						<img src="img/actua.png" title="Actualizar"</a></td>';
					//ICONOS-Eliminar (Boton)
					$txt .= '<td align="center"><a href="home.php?pg=002&del='.$f["emp_nit"].'">
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