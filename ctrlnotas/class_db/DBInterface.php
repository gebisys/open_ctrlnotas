<?php
	class DBInterface {
		
		protected function __construct() {}
		
		static public function getInterface( $driver ) {
			
			if(!empty($driver)) {
			
				$obj = null;
				
				switch( $driver ) {
			
					case 'mysql':
						include_once('DBMySQL.php');
						$obj = new DBMySQL();
						break;
					default:
						throw new Exception("No se reconoce el SGBD", 406);	
						break;
				}
			} else {
				throw new Exception("No se ha definido un SGBD");	
			}
			
			return $obj;
			
		}	
		
	}
?>
