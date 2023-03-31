<?php

 session_start();
 class Conectar {

 	protected $dbh;

 	protected function conexion(){


 		try {

 			
 			$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=dbbomberoscajeme","root","");

 			//$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=dbbomberoscajeme","adminpatronatodbco","patronatodbcod3");
 			

 			
		   	$conectar->query("SET NAMES 'utf8'");
		    return $conectar;
 			
 		} catch (Exception $e) {

 			print "¡Error!: " . $e->getMessage() . "<br/>";
            die();  
 			
 		}
 


		 } //cierre de llave de la function conexion()


		 public function set_names(){

		 	return $this->dbh->query("SET NAMES 'utf8'");
		 }


		public function ruta(){

		 	return "http://localhost:8080/Sistemabomberoscajeme/";
		}

		//Función para convertir fecha del mes de numero al nombre, ejemplo de 01 a enero
	    public static function convertir($string){

	        $string = str_replace(
	        array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
	        array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', ' Diciembre'),
	        $string

	        );        
	        return $string;
	    }

		//Función para convertir fecha del dia de numero al nombre que corresponda 
	    public static function convertirmes($string){

	        $string = str_replace(
	        array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
	        array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'),
	        $string

	        );        
	        return $string;
	    }

	}//cierre de llave conectar 		
		  	
?>
