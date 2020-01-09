<?php
	namespace App;

	class Connection {
		public static function getDb() {
			try{
				$conn = new \PDO(
					'mysql:host=localhost;dbname=php_com_pdo',
					'root',
					''
				);
				return $conn;
			}catch(\PDOException $e){
				//Tratar erros
				echo 'Error: '.$e->getMessage();
			}
		}
	}

?>