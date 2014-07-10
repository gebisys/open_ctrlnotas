<?php
	include_once("DBGeneric.php"); #Fabrica de la clase
	
	class DBMySQL extends DBGeneric {
		
		public function __construct() {} #Constructor
		
		public function Connect() { #Metodo para conectarse a la base de datos
			$obj = null;
			try {
				$dns	= "mysql:host=".DB_HOST.";dbname=".DB_NAME;
				$obj	= new PDO($dns, DB_USER, DB_PASS); 
			} catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
			
			return $obj;
		}
		
		public function Close($db) { #Metodo para cerrar la base de datos
			
			if(is_object($db)) {
				$db = null;
			} else {
				return false;
			}
			
		}
		
		public function Query($db, $sql, $data=null) { #Metodo para ejecutar una consulta
			$stmt = null;
			if($stmt = $db->prepare($sql)) {
				if(!$stmt->execute($data))
					return $this->getError($stmt);
				
				return $stmt;
			}
		}
		
		public function getError($stmt) { #Metodo para obtener errores
			if(is_object($stmt)) {
				echo "<pre>";
					print_r($stmt->errorInfo());
				echo "</pre>";
				//throw new Exception("Error: ".$stmt->errorInfo());
			}
		}
		
		public function numRows($stmt) { #Metodo para obtener numero de filas
			if(is_object($stmt)){
				return $stmt->rowCount();
			}
		}
		
		public function fetchAssoc($stmt) { #Metodo para obtener una array asociativo
			$output = array();
			
			if(is_object($stmt)) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$output[] = $row;
				}	
			}
			
			return $output;
		}
		
		public function fetchObject($stmt) { //Por el momento esta funcion solo es necesaria para obtener el total de registros de una tabla
			$obj = null;
			if(is_object($stmt)) {
				$obj = $stmt->fetch(PDO::FETCH_OBJ);
			}
			return $obj;
		}
                
                 public function ramdomCode($i=null){
          
                        $fec = date("ymd-his");
                        $fec = md5($fec);
                        $fec = substr($fec, 10, 7);
                        $fec = strtoupper($fec);
                        $fec = $i.$fec;
                        return $fec;
               }
	}
?>
