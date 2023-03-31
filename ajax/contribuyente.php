
<?php 

	//Clase conexion.php
	require_once("../config/conexion.php");
	//Clase Contribuyente.php - Hacemos uso de sus métodos.
	require_once("../modelo/Contribuyente.php");
	//Instanciamos la clase
	$operaciones = new Contribuyente();

	//DECLARAMOS LAS VARIABLES DE LOS VALORES QUE SE ENVÍAN POR EL FORMULARIO Y QUE RECIBIMOS POR AJAX.
	$id_contribuyente  = isset($_POST["id_contribuyente"]);
	$id_personal   	   = isset($_POST["id_personal"]);
  $identificador 	   = isset($_POST["identificador"]);
  $numerocontri 	   = isset($_POST["numerocontri"]);
	$contribuyente	   = isset($_POST["contribuyente"]);
	$rfc			   = isset($_POST["rfc"]);
	$direccion		   = isset($_POST["direccion"]);
	$colonia		   = isset($_POST["colonia"]);
	$ciudad			   = isset($_POST["ciudad"]);
	$ciudadbd	   	   = isset($_POST["ciudadbd"]);
	$ciudadmostrar	   = isset($_POST["ciudadmostrar"]);
	$telefono		   = isset($_POST["telefono"]);
	$correo			   = isset($_POST["correo"]);
	$fecha			   = isset($_POST["fecha"]);

	//CONDICIONAL SWITCH PARA LAS DIFERENTES OPERACIONES (MÉTODOS) CON LAS QUE SE VA INTERACTUAR A LA BD.
	switch($_GET["op"])
	{

		// * 1. REGISTRO Y ACTUALIZACIÓN DE CONTRIBUYENTE. * //.

		// * REGISTRO Y ACTUALIZAR REGISTRO. * //.

		/* Registar y actualizar datos de contribuyente. */
		case "guardaryactualizarcontribuyente":

			//Verificamos si existe ya un contribuyente con el mismo nombreen la bd, si ya existe un registro con esos datos no se efectua el registro.
			$datos = $operaciones->getnombredecontribuyente_validacion($_POST["contribuyente"]);

			if(empty($_POST["id_contribuyente"]))
			{
				//Si el id no existe entonces se hace el registro a la bd.
				if(is_array($datos)==true and count($datos)==0)
				{

					$operaciones->insertamos_contribuyente($identificador,$numerocontri,$contribuyente,$rfc,$direccion,$colonia,$ciudad,$ciudadbd,$telefono,$correo,$id_personal,$fecha);

					//Mostramos un mensaje de exito al insertar el registro.
			    	$messages[]="SE HA INGRESADO UN NUEVO CONTRIBUYENTE.";

				}

				else
				{

					//Mensaje de alerta en caso de que el registro coincidan con un nombre de usuario o correo ya existente.
		    		$errors[]="YA EXISTE UN CONTRIBUYENTE CON ESE NOMBRE.";
				}

			}

			else
			{

				$operaciones->actualizarinformacion_contribuyente($id_contribuyente,$numerocontri,$contribuyente,$rfc,$direccion,$colonia,$ciudadmostrar,$ciudadbd,$ciudad,$telefono,$correo);

				//Mostramos un mensaje de exito al actualizar el registro.
			    $messages[]="SE HA ACTUALIZADO INFORMACIÓN DEL CONTRIBUYENTE.";

			}


			//Mensaje de exito.
			if(isset($messages))
			{
			?>
				<div class="col-12 alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>PROCESO COMPLETADO:</strong>
					<?php
					foreach($messages as $message)
					{
						echo $message;
					}
					?>
				</div>
			<?php
			}

			//Mensaje de alerta.
			if(isset($errors))
			{
			?>
				<div class="col-12 alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>PROCESO DENEGADO:</strong>
					<?php
					foreach($errors as $message)
					{
						echo $message;
					}
					?>
				</div>
			<?php
			}

		break;

		
		// * MOSTRAMOS REGISTROS DE CONTRIBUYENTE UNA VEZ INGRESADOS AL SISTEMA. * //.

		/* Listamos los registros en la tabla. */
		case "listadocontribuyente_registro":

			//Llamamos al método para listar al concepto.
		    $datos = $operaciones->getcontribuyente_listadoregistro();
		    	
		    //Se declara un array.
		    $data = Array();
		    //Recorremos los datos con un ciclo for.
		    foreach($datos as $row) 
		    {

		    	//Creamos un segundo array
				$sub_array= array();
				    
				//Mostramos una etiqueta si el registro está activo o inactivo.
				$atrib2 = "bg bg-primary btn-sm estado";
				if($row["estado"]==0)
				{
				 	$est2="INACTIVO";
				 	$atrib2 = "bg bg-danger btn-sm estado";
				}
				else
				{

					if($row["estado"]==1)
					{
					  $est2="ACTIVO";
					}

				}

				
				
				//Mostramos los campos/información que se van a visualizar en las tabla.
				$espacio=" ";
			    $sub_array[] = $row["contribuyente"];
			    $sub_array[] = $row["rfc"];
			    //$sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

			    $data[]=$sub_array;

		    } //Cerramos el foreach.


		    $results= array(
		    "sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);	
		       echo json_encode($results);

		break;


		// * MOSTRAMOS CONTRIBUYENTE PARA ACTUALIZAR INFORMACIÓN. * //.

		/* Listamos los registros en la tabla. */
		case "listadocontribuyente_actualizar":

			//Llamamos al método para listar al contribuyente.
		    $datos = $operaciones->getcontribuyente_listadoactualizar();
		    	
		    //Se declara un array.
		    $data = Array();
		    //Recorremos los datos con un ciclo for.
		    foreach($datos as $row) 
		    {

		    	//Creamos un segundo array
				$sub_array= array();
				

				//Mostramos el estado en el que se encuentra el personal y manipular el botón.
				$est = '';
				$atrib = "btn btn-primary btn-sm estado";
				if($row["estado"] == 0)
				{
					$est = '';
					$atrib = "btn btn-danger btn-sm estado";
				}
				else
				{
					if($row["estado"] == 1)
					{
						 $est = '';            
					} 
				}

				//Mostramos una etiqueta si el registro está activo o inactivo.
				$atrib2 = "bg bg-primary btn-sm estado";
				if($row["estado"]==0)
				{
				 	$est2="INACTIVO";
				 	$atrib2 = "bg bg-danger btn-sm estado";
				}
				else
				{

					if($row["estado"]==1)
					{
					  $est2="ACTIVO";
					}

				}

				
				

				if($_SESSION["Controltotaldelsistema"]==1)
		    	{
		    		//Mostramos los campos/información que se van a visualizar en las tabla.
					$espacio=" ";
					$sub_array[] = $row["id_contribuyente"];
				    $sub_array[] = $row["contribuyente"];
				    $sub_array[] = $row["rfc"];
				    $sub_array[] = $row["ciudad"];				    
				    $sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

				    if($row["estado"]==0)
					{
						
						$sub_array[] = '<button type="button" disabled style="font-size: 7pt;" onClick="mostrardatos_contribuyente('.$row["id_contribuyente"].');" title="Botón que muestra ventana para actualizar información" id="'.$row["id_contribuyente"].'" class="btn btn-warning btn-sm update"><i class="fa fa-edit"></i></button>'.$espacio.'<button type="button" style="font-size: 7pt;" onClick="cambiarestado_activar('.$row["id_contribuyente"].','.$row["estado"].');" name="estado" title="Botón para activar al contribuyente" id="'.$row["id_contribuyente"].'" class="'.$atrib.'">'.$est.'<i class="fa fa-flag"></i></button>';
					}

					else
					{

						$sub_array[] = '<button type="button" style="font-size: 7pt;" onClick="mostrardatos_contribuyente('.$row["id_contribuyente"].');" title="Botón que muestra ventana para actualizar información" id="'.$row["id_contribuyente"].'" class="btn bg-orange btn-sm update"><i class="fa fa-edit"></i></button>'.$espacio.'<button type="button" style="font-size: 7pt;" onClick="cambiarestado_inactivar('.$row["id_contribuyente"].','.$row["estado"].');" name="estado" title="Botón para inactivar al contribuyente" id="'.$row["id_contribuyente"].'" class="'.$atrib.'">'.$est.'<i class="fa fa-flag"></i></button>';


				    }


				    
		    	}


		    	if($_SESSION["ModuloAdministradorInspecciones"]==1  OR $_SESSION["ModuloInspector"]==1)
		    	{
		    		//Mostramos los campos/información que se van a visualizar en las tabla.
					$espacio=" ";
					
				    $sub_array[] = $row["contribuyente"];
				    $sub_array[] = $row["rfc"];
				    $sub_array[] = $row["ciudad"];				    
				    $sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

				    if($row["estado"]==0)
					{
						
						$sub_array[] = '<button type="button" disabled style="font-size: 7pt;" onClick="mostrardatos_contribuyente('.$row["id_contribuyente"].');" title="Botón que muestra ventana para actualizar información" id="'.$row["id_contribuyente"].'" class="btn btn-warning btn-sm update"><i class="fa fa-edit"></i></button>';
					}

					else
					{

						$sub_array[] = '<button type="button" style="font-size: 7pt;" onClick="mostrardatos_contribuyente('.$row["id_contribuyente"].');" title="Botón que muestra ventana para asignar permisos" id="'.$row["id_contribuyente"].'" class="btn bg-orange btn-sm update"><i class="fa fa-edit"></i></button>';


				    }


				    
		    	}


		    	




			    $data[]=$sub_array;

		    } //Cerramos el foreach.


		    $results= array(
		    "sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);	
		       echo json_encode($results);

		break;

		// * MOSTRAMOS INFORMACIÓN DEL REGISTRO SELECCIONADO. * //.

		/* Mostramos la información del registro seleccionado por el ID. */
		case "mostrardatos_contribuyente":

			//Parametro id se envía por ajax cuando se edita la información del contribuyente.
			$datos = $operaciones->getdatosporid_contribuyente($_POST["id_contribuyente"]);

			if(is_array($datos)==true and count($datos)>0)
			{	
				foreach($datos as $row)
				{
					
					
					$esp=' ';
					
					$output["identificador"] 		 	= $row["identificador"];	
					$output["contribuyente"] 		 	= $row["contribuyente"];
					$output["numerocontri"] 			= $row["numerocontri"];
					$output["rfc"] 		 				= $row["rfc"];
					$output["ciudad"] 					= $row["ciudad"];
					$output["direccion"] 				= $row["direccion"];
					$output["colonia"] 					= $row["colonia"];
					$output["telefono"] 				= $row["telefono"];
					$output["correo"] 					= $row["correo"];
					$output["id_contribuyente"] 		= $row["id_contribuyente"];
				}

				echo json_encode($output);
			}

			else
		  	{
				$errors[]="NO SE PUDO SELECCIONARL EL REGISTRO, LLAME A SOPORTE.";
		  	}

		  	//Mensaje de alerta.
			if(isset($errors))
			{
			?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>PROCESO DENEGADO:</strong>
					<?php
					foreach($errors as $message)
					{
						echo $message;
					}
					?>
				</div>
			<?php
			}

		break;


		// * 2. CAMBIO DE ESTADO AL CONTRIBUYENTE. * //.

		/* Cambiar el estado al contribuyente y sus tiendas */
		case "cambiarestado_contribuyente":

        	//los parametros id_contribuyente y est vienen por via ajax
	        $datos = $operaciones->getdatosporid_contribuyente($_POST["id_contribuyente"]);
	        //valida el id del personal.
	        if(is_array($datos)==true and count($datos)>0)
	        {
	            //edita el estado del contribuyente. 
	            $operaciones->getcontribuyente_cambiarestado($_POST["id_contribuyente"],$_POST["est"]);
	            $operaciones->getcontribuyente_cambiarestadotienda($_POST["id_contribuyente"],$_POST["est"]);
	        }

        break;

        /* Cambiar el estado unicamente al contribuyente */
		case "cambiarestado_contribuyentesolo":

        	//los parametros id_contribuyente y est vienen por via ajax
	        $datos = $operaciones->getdatosporid_contribuyente($_POST["id_contribuyente"]);
	        //valida el id del personal.
	        if(is_array($datos)==true and count($datos)>0)
	        {
	            //edita el estado del contribuyente. 
	            $operaciones->getcontribuyente_cambiarestado($_POST["id_contribuyente"],$_POST["est"]);
	            $operaciones->getcontribuyente_cambiarestadotiendatienda($_POST["id_contribuyente"],$_POST["est"]);
	            
	        }

        break;


		// * 3. CONSULTA DE CONTRIBUYENTE. * //.

		// * MOSTRAMOS A TODO LOS CONTRIBUYENTES DEL SISTEMA. * //.

		/* Listamos los registros en la tabla. */
		case "listadocompleto_contribuyente":

			//Llamamos al método para listar al contribuyente.
		    $datos = $operaciones->getcontribuyente_listadocompleto();
		    	
		    //Se declara un array.
		    $data = Array();
		    //Recorremos los datos con un ciclo for.
		    foreach($datos as $row) 
		    {

		    	//Creamos un segundo array
				$sub_array= array();
				

				//Mostramos el estado en el que se encuentra el personal y manipular el botón.
				$est = '';
				$atrib = "btn btn-primary btn-sm estado";
				if($row["estado"] == 0)
				{
					$est = '';
					$atrib = "btn btn-danger btn-sm estado";
				}
				else
				{
					if($row["estado"] == 1)
					{
						 $est = '';            
					} 
				}

				//Mostramos una etiqueta si el registro está activo o inactivo.
				$atrib2 = "bg bg-primary btn-sm estado";
				if($row["estado"]==0)
				{
				 	$est2="INACTIVO";
				 	$atrib2 = "bg bg-danger btn-sm estado";
				}
				else
				{

					if($row["estado"]==1)
					{
					  $est2="ACTIVO";
					}

				}

				


				if($_SESSION["Controltotaldelsistema"]==1)
		    	{
		    		
		    		//Mostramos los campos/información que se van a visualizar en las tabla.
					$espacio=" ";
					$sub_array[] = $row["id_contribuyente"];
				    $sub_array[] = $row["contribuyente"];
				   	$sub_array[] = $row["rfc"];
				   	$sub_array[] = $row["ciudad"];
				    
				    $sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

				    if($row["estado"]==0)
					{
					    $sub_array[] = '<button class="btn btn-info detalle btn-sm" id="'.$row["identificador"].'"  data-toggle="modal" data-target="#contribuyentedetallemodal"><i class="fa fa-eye"></i></button>';
					}

					else
					{

						$sub_array[] = '<button class="btn btn-info detalle btn-sm" id="'.$row["identificador"].'"  data-toggle="modal" data-target="#contribuyentedetallemodal"><i class="fa fa-eye"></i></button>';
					}
		    	}


		    	if($_SESSION["ModuloAdministradorInspecciones"]==1  OR $_SESSION["ModuloInspector"]==1)
		    	{
		    		
		    		//Mostramos los campos/información que se van a visualizar en las tabla.
					$espacio=" ";
					
				    $sub_array[] = $row["contribuyente"];
				   	$sub_array[] = $row["rfc"];
				   	$sub_array[] = $row["ciudad"];
				    
				    $sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

				    if($row["estado"]==0)
					{
					    $sub_array[] = '<button class="btn btn-info detalle btn-sm" id="'.$row["identificador"].'"  data-toggle="modal" data-target="#contribuyentedetallemodal"><i class="fa fa-eye"></i></button>';
					}

					else
					{

						$sub_array[] = '<button class="btn btn-info detalle btn-sm" id="'.$row["identificador"].'"  data-toggle="modal" data-target="#contribuyentedetallemodal"><i class="fa fa-eye"></i></button>';
					}
		    	}


		    	
				
				

			    $data[]=$sub_array;

		    } //Cerramos el foreach.


		    $results= array(
		    "sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);	
		       echo json_encode($results);

		break;


		// * MOSTRAMOS CONTRIBUYENTES INACTIVOS. * //.

		/* Listamos los registros en la tabla. */
		case "listadoinactivo_contribuyente":

			//Llamamos al método para listar los contribuyentes.
		    $datos = $operaciones->getcontribuyente_listadoinactivo();
		    	
		    //Se declara un array.
		    $data = Array();
		    //Recorremos los datos con un ciclo for.
		    foreach($datos as $row) 
		    {

		    	//Creamos un segundo array
				$sub_array= array();
				    
				//Mostramos el estado en el que se encuentra el personal y manipular el botón.
				$est = '';
				$atrib = "btn btn-primary btn-sm estado";
				if($row["estado"] == 0)
				{
					$est = '';
					$atrib = "btn btn-danger btn-sm estado";
				}
				else
				{
					if($row["estado"] == 1)
					{
						 $est = '';            
					} 
				}

				//Mostramos los campos/información que se van a visualizar en las tabla.
				$espacio=" ";
			    $sub_array[] = $row["contribuyente"];
			    $sub_array[] = $row["rfc"];
			    $sub_array[] = '<button type="button" style="font-size: 7pt;" onClick="cambiarestado_activarsolo('.$row["id_contribuyente"].','.$row["estado"].');" name="estado" title="Botón para activar al contribuyente" id="'.$row["id_contribuyente"].'" class="'.$atrib.'">'.$est.'<i class="fa fa-flag"></i></button>';
			    
			    //$sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

			    $data[]=$sub_array;

		    } //Cerramos el foreach.


		    $results= array(
		    "sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);	
		       echo json_encode($results);

		break;


		// IMPRESIÓN DE CONTRIBUYENTES

		// * MOSTRAMOS A TODO LOS CONTRIBUYENTES. * //.

		/* Listamos los registros en la tabla. */
		case "listadoimpresion_contribuyente":

			//Llamamos al método para listar al contribuyente.
		    $datos = $operaciones->getcontribuyente_listadocompleto();
		    	
		    //Se declara un array.
		    $data = Array();
		    //Recorremos los datos con un ciclo for.
		    foreach($datos as $row) 
		    {

		    	//Creamos un segundo array
				$sub_array= array();
				

				//Mostramos el estado en el que se encuentra el personal y manipular el botón.
				$est = '';
				$atrib = "btn btn-primary btn-sm estado";
				if($row["estado"] == 0)
				{
					$est = '';
					$atrib = "btn btn-danger btn-sm estado";
				}
				else
				{
					if($row["estado"] == 1)
					{
						 $est = '';            
					} 
				}

				//Mostramos una etiqueta si el registro está activo o inactivo.
				$atrib2 = "bg bg-primary btn-sm estado";
				if($row["estado"]==0)
				{
				 	$est2="INACTIVO";
				 	$atrib2 = "bg bg-danger btn-sm estado";
				}
				else
				{

					if($row["estado"]==1)
					{
					  $est2="ACTIVO";
					}

				}

				
				
				//Mostramos los campos/información que se van a visualizar en las tabla.
				$espacio=" ";
				$sub_array[] = $row["id_contribuyente"];
			    $sub_array[] = $row["contribuyente"];
			    $sub_array[] = $row["numerocontri"];
			    $sub_array[] = $row["rfc"];
			    $sub_array[] = $row["ciudad"];
			    $sub_array[] = $row["direccion"];
			    $sub_array[] = $row["colonia"];
			    $sub_array[] = '<label  name="estado" style="font-size: 11pt;" class="'.$atrib2.'">'.$est2.'</label>';

			    
			    $data[]=$sub_array;

		    } //Cerramos el foreach.


		    $results= array(
		    "sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);	
		       echo json_encode($results);

		break;



		// * 4. MOSTRAMOS INFORMACIÓN DETALLADA DE CONTRIBUYENTE. * //

	    // MOSTRAMOS INFORMACIÓN DE TODO EL CONTRIBUYENTE //

	    /* Mostramos la información del registro seleccionado por el ID. */
		case "verinformacion_contribuyente":

			//Parametro id se envía por ajax cuando se edita la información del contribuyente.
			$datos = $operaciones->getdetalleinformacion_contribuyente($_POST["identificador"]);

			if(is_array($datos)==true and count($datos)>0)
			{	
				foreach($datos as $row)
				{
					
					
					$esp=' ';

					if ($row["estado"]==1) 
					{
						$estado="ACTIVO";
					}

					else
					{
						$estado="INACTIVO";
					}


						
					$output["contribuyente"]    = $row["contribuyente"];
					$output["numerocontri"] 	= $row["numerocontri"];
					$output["rfc"] 				= $row["rfc"];
					$output["ciudad"] 			= $row["ciudad"];
					$output["direccion"] 		= $row["direccion"];
					$output["colonia"] 			= $row["colonia"];
					$output["telefono"] 		= $row["telefono"];
					$output["correo"] 			= $row["correo"];
					$output["estado"] 			= $estado;
					$output["identificador"] 	= $row["identificador"];
				}

				echo json_encode($output);
			}

			else
		  	{
				$errors[]="NO SE PUDO SELECCIONARL EL REGISTRO, LLAME A SOPORTE.";
		  	}

		  	//Mensaje de alerta.
			if(isset($errors))
			{
			?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>PROCESO DENEGADO:</strong>
					<?php
					foreach($errors as $message)
					{
						echo $message;
					}
					?>
				</div>
			<?php
			}

		break;


	}

?>
