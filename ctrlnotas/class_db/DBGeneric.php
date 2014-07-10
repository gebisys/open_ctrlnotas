<?php
	abstract class DBGeneric {
	
		abstract public function Connect(); 			#Metodo para conectarse a la base de datos
			
		abstract public function Close($db);			#Metodo para cerrar una base de datos
		
		abstract public function Query($db, $sql, $data=null); 	#Metodo para ejecutar consultas
		
		abstract public function getError($stmt); 		#Metodo para obtener errores
		
		abstract public function numRows($stmt);		#Metodo para obtener numero de filas
		
		abstract public function fetchAssoc($stmt);		#Metodo para obtener un array asociativo
		
		abstract public function fetchObject($stmt);            #Metodo para obtener Objeto
                
		abstract public function ramdomCode($i=null);                #Metodo para obtener Codigo Aleatoreo
		
	}
?>
