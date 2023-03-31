
<?php 

	class Contribuyente extends Conectar
	{


		
		// * 1. REGISTRO Y ACTUALIZACIÓN DE CONTRIBUYENTE. * //.

		// REGISTRO DE CONTRIBUYENTE

		// N° AUTOMATICO //
		
		/* Asignamos un N° automatico al contribuyente. */
	    public function identificador_numerodecontribuyente()
	    {

	    	$conectar=parent::conexion();
		    parent::set_names();
		    $sql="SELECT identificador from contribuyente;";
		    $sql=$conectar->prepare($sql);
		    $sql->execute();
		    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		    //Se selecciona unicamente un campo array que es el campo "identificador".
		    foreach($resultado as $k=>$v)
		    {
		      	$identificador["numero"]=$v["identificador"];
		    }

		    //Después de seleccionar el campo identificador verificamos si esta vacio, luego se le asigna un valor el cual comenzara con "P000001".
		    if(empty($identificador["numero"]))
		    {
		      	echo 'C000001';
		    } 
		        
		    else 
		    {
		        $num     = substr($identificador["numero"] , 1);
		        $dig     = $num + 1;
		        $fact = str_pad($dig, 6, "0", STR_PAD_LEFT);
		        echo 'C'.$fact;
		    } 


	    }


	    // MOSTRAMOS EN FORMULARIO //

        /* Listamos ciudades. */
        public function getciudad_formcontribuyente()
        {
            
            $conectar=parent::conexion();
            parent::set_names();
            //SENTENCIA SELECT PARA MOSTRAR TODOS LOS REGISTROS..
            $sql="SELECT ciudad FROM contribuyente where ciudad!=''  group by ciudad";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
              
        }

	    // VALIDACIÓN //
		
		/* Validamos que no se repita el nombre de contribuyente. */
		public function getnombredecontribuyente_validacion($contribuyente)
	    {

	        $conectar=parent::conexion();
	        $sql="SELECT * from contribuyente where contribuyente=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $contribuyente);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	        
	    }

	    // INGRESO DE CONTRIBUYENTE //
		
		/* Insertamos registros de contribuyente. */
		public function insertamos_contribuyente($identificador,$numerocontri,$contribuyente,$rfc,$direccion,$colonia,$ciudad,$ciudadbd,$telefono,$correo,$id_personal,$fecha)
		{

			$conectar=parent::conexion();
	        parent::set_names();

	        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha=$_POST["fecha"];
            $mes = $meses[date("n", strtotime($fecha))-1];


            $contribuyente=$_POST["contribuyente"];
            $contrimayu=mb_strtoupper($contribuyente);

            $direccion=$_POST["direccion"];
            $diremayu=mb_strtoupper($direccion);

            $colonia=$_POST["colonia"];
            $coloniamayu=mb_strtoupper($colonia);

            //$correo=$_POST["correo"];
            //$correoamayu=mb_strtoupper($correo);
            //Validaciones de campos vacios.

            //Variable RFC.

            if($rfcmayu=$_POST["rfc"])
            {
                $rfcContribuyente = strtoupper($rfcmayu);
            } 
            else 
            {
                $rfcContribuyente='PENDIENTE';
            }

            //Variable TELEFONO.
            if($telefono==$_POST["telefono"])
            {
                $telefonoContribuyente =$_POST["telefono"];             
            } 
            else 
            {
                $telefonoContribuyente="PENDIENTE";
            }

            //Variable CORREO.
            if($correomayu=$_POST["correo"])
            {
                $correoContribuyente = mb_strtoupper($correomayu);
            } 
            else 
            {
                $correoContribuyente='PENDIENTE';
            }

            $nombreciudad='';

            if ($_POST["ciudad"]=='') 
            {
                $nombreciudad=$_POST["ciudadbd"];
            }

            else
            {
                $nombreciudad=$_POST["ciudad"];
                $nombreciudad=mb_strtoupper($nombreciudad);
            }
	        
	    	
	    	//Sentencia Insert para insertar registros..
	        $sql="INSERT into contribuyente  values(null,now(),?,?,?,?,?,?,?,?,?,?,?,'1');";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $mes);
	        $sql->bindValue(2,  $_POST["identificador"]);
            $sql->bindValue(3,  $_POST["numerocontri"]);
            $sql->bindValue(4,  $contrimayu);
            $sql->bindValue(5,  $rfcContribuyente);
            $sql->bindValue(6,  $diremayu);
            $sql->bindValue(7,  $coloniamayu);
            $sql->bindValue(8,  $nombreciudad);
            $sql->bindValue(9,  $telefonoContribuyente);
            $sql->bindValue(10, $correoContribuyente);
            $sql->bindValue(11, $_POST["id_personal"]);
	        $sql->execute();

		}


	    // MOSTRAMOS DESPUES DE INGRESAR //

	    /* Listamos registros de contribuyente una vez ingresados al sistema. */
	    public function getcontribuyente_listadoregistro()
	    {
	    	$conectar=parent::conexion();
	    	$sql="SELECT * from contribuyente WHERE fechaingreso= CURRENT_DATE()";
	    	$sql=$conectar->prepare($sql);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	    }


	    // ACTUALIZAR INFORMACIÓN DEL CONTRIBUYENTES


	    // MOSTRAMOS CONTRIBUYENTES //

	    /* Listamos contribuyentes para actualizar información. */
	    public function getcontribuyente_listadoactualizar()
	    {
	    	
	    	$conectar=parent::conexion();
	    	$sql="SELECT * from contribuyente";	    	
	    	$sql=$conectar->prepare($sql);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	    }

	    // MOSTRAR REGISTRO A TRAVES DEL ID //

	    /* Obtenemos los datos del registro seleccionado por el ID. */	
	    public function getdatosporid_contribuyente($id_contribuyente)
	    {

	        $conectar=parent::conexion();
	        $sql="SELECT * from contribuyente where id_contribuyente=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $id_contribuyente);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	        
	    }


	    // ACTUALIZAR INFORMACIÓN DEL CONTRIBUYENTE

	    /* Actualizamos datos de un contribuyente. */
	    public function actualizarinformacion_contribuyente($id_contribuyente,$numerocontri,$contribuyente,$rfc,$direccion,$colonia,$ciudadmostrar,$ciudadbd,$ciudad,$telefono,$correo)
	    {

	    	$conectar=parent::conexion();
        	parent::set_names();

        	$contribuyente=$_POST["contribuyente"];
            $contrimayu=mb_strtoupper($contribuyente);

            $rfc=$_POST["rfc"];
            $rfcmayu=mb_strtoupper($rfc);

            $direccion=$_POST["direccion"];
            $diremayu=mb_strtoupper($direccion);

            $colonia=$_POST["colonia"];
            $coloniamayu=mb_strtoupper($colonia);

            $correo=$_POST["correo"];
            $correoamayu=mb_strtoupper($correo);
            //Validaciones de campos vacios.

            $nombreciudad='';
            if ($_POST["ciudadbd"]=='' OR $_POST["ciudad"]=='') 
            {   
                
                $nombreciudad=$_POST["ciudadmostrar"];
                 
            }

            if ($_POST["ciudadbd"]!='') 
            {
                $ciudadbd=$_POST["ciudadbd"];
                $nombreciudad=mb_strtoupper($ciudadbd); 
            }

            if ($_POST["ciudad"]!='') 
            {
                $ciudad=$_POST["ciudad"];
                $nombreciudad=mb_strtoupper($ciudad);  
            }


        	

        	//Sentencia Actualizar registros..
	        $sql="UPDATE contribuyente  set  numerocontri=?, contribuyente=?,      rfc=?, direccion=?,  
	        								 	  colonia=?, 		ciudad=?, telefono=?,    correo=?

											where id_contribuyente=?";

			$sql=$conectar->prepare($sql);
		    $sql->bindValue(1,  $_POST["numerocontri"]);
            $sql->bindValue(2,  $contrimayu);
            $sql->bindValue(3,  $rfcmayu);
            $sql->bindValue(4,  $diremayu);
            $sql->bindValue(5,  $coloniamayu);
            $sql->bindValue(6,  $nombreciudad);
            $sql->bindValue(7,  $_POST["telefono"]);
            $sql->bindValue(8,  $correoamayu);
            $sql->bindValue(9,  $_POST["id_contribuyente"]);
            $sql->execute();
        	
	        
	    }


		// * 2. CAMBIO DE ESTADO AL CONTRIBUYENTE. * //.


		/* Cambiamos el estado del contribuyente (Baja (0) o Activar (1) )*/
	    public function getcontribuyente_cambiarestado($id_contribuyente,$estado)
	    {

	    	$conectar=parent::conexion();
	        parent::set_names();
	        //el parametro est se envia por via ajax
	        if($_POST["est"]=="0")
	        {
	          $estado=1;
	        } 
	        else 
	        {
	          $estado=0;
	        }

	        $sql="update contribuyente set estado=? where id_contribuyente=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1,$estado);
	        $sql->bindValue(2,$id_contribuyente);
	        $sql->execute();

	    }


	    /* Cambiamos el estadocontri y estadotienda de la tienda por el id_contribuyente (Baja (0) o Activar (1) )*/
	    public function getcontribuyente_cambiarestadotienda($id_contribuyente,$estado)
	    {

	    	$conectar=parent::conexion();
	        parent::set_names();
	        //el parametro est se envia por via ajax
	        if($_POST["est"]=="0")
            {
              $estado=1;
              $sql="update tiendacomercial set estadocontri=?, estadotienda='1' where id_contribuyente=?";
            } 
            else 
            {
              $estado=0;
              $sql="update tiendacomercial set estadocontri=?, estadotienda='0' where id_contribuyente=?";
            }

	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1,$estado);
	        $sql->bindValue(2,$id_contribuyente);
	        $sql->execute();

	    }

	    /* Cambiamos unicamente el estadocontri de la tienda por el id_contribuyente (Baja (0) o Activar (1) )*/
	    public function getcontribuyente_cambiarestadotiendatienda($id_contribuyente,$estado)
	    {

	    	$conectar=parent::conexion();
	        parent::set_names();
	        //el parametro est se envia por via ajax
	        if($_POST["est"]=="0")
            {
              $estado=1;
              $sql="update tiendacomercial set estadocontri=? where id_contribuyente=?";
            } 
            else 
            {
              $estado=0;
              $sql="update tiendacomercial set estadocontri=? where id_contribuyente=?";
            }

	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1,$estado);
	        $sql->bindValue(2,$id_contribuyente);
	        $sql->execute();

	    }



		// * 3. CONSULTA DE CONTRIBUYENTE. * //.

		// MOSTRAMOS A TODOS LOS CONTRIBUYENTES DEL SISTEMA  //

	    /* Listamos registros de contribuyente. */
	    public function getcontribuyente_listadocompleto()
	    {
	    	
	    	$conectar=parent::conexion();
	    	$sql="SELECT * from contribuyente";
	    	$sql=$conectar->prepare($sql);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	    }


	    // MOSTRAMOS AL CONTRIBUYENTE INACTIVO EN EL SISTEMA  //

	    /* Listamos registros de contribuyentes. */
	    public function getcontribuyente_listadoinactivo()
	    {
	    	$conectar=parent::conexion();
	    	$sql="SELECT * from contribuyente WHERE estado='0'";
	    	$sql=$conectar->prepare($sql);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	    }

	  
	    
	    // * 4. MOSTRAMOS INFORMACIÓN DETALLADA DE CONTRIBUYENTE. * //

	    // MOSTRAMOS INFORMACIÓN DE TODO EL CONTRIBUYENTE //

	    /* Información detallada del contribuyente */
	    public function getdetalleinformacion_contribuyente($identificador)
	    {

	        $conectar=parent::conexion();
	       	$sql="SELECT c.fechaingreso,c.numerocontri,c.identificador,c.contribuyente, c.rfc,c.direccion,
                         c.colonia,c.ciudad,c.telefono,c.estado,c.correo, c.estado
                         from contribuyente as c where c.identificador=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1,$identificador);
	        $sql->execute();
	        return $resultado=$sql->fetchAll();
	       
	    }


	    // 5. HISTORIAL DE TIENDAS POR CONTRIBUYENTE

	    // MOSTRAMOS EN FORMULARIO //

        /* Listamos contribuyentes. */
        public function getcontribuyente_formhistorial()
        {
            
            $conectar=parent::conexion();
            parent::set_names();
            //SENTENCIA SELECT PARA MOSTRAR TODOS LOS REGISTROS..
            $sql="SELECT * FROM contribuyente";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
              
        }

        // OBTENEMOS DATOS //

        /* Obtenemos la información del registro seleccionado. */
        public function getcontribuyente_obtenerdatos($id_contribuyente)
        {
            
            $conectar=parent::conexion();
            parent::set_names();
            //SENTENCIA SELECT PARA MOSTRAR TODOS LOS REGISTROS..
            $sql="SELECT * FROM contribuyente WHERE id_contribuyente=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_contribuyente);
            $sql->execute();
            return $resultado=$sql->fetchAll();
              
        }

        /* Obtenemos las tiendas asociadas con el contribuyente. */
        public function gettienda_asociadascontribuyente($id_contribuyente)
        {
            
            $conectar=parent::conexion();
            parent::set_names();
            //SENTENCIA SELECT PARA MOSTRAR TODOS LOS REGISTROS..
            $sql="SELECT * FROM tiendacomercial WHERE id_contribuyente=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_contribuyente);
            $sql->execute();
            return $resultado=$sql->fetchAll();
              
        }
	    


	}

?>
