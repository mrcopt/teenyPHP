<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 Add environment specific constants for local development 
 */


/*
* Trait Database
* For database operations and interactions
*/

Trait Database {

	//Connection function
	private function connect() {
		$string = "mysql:hostname=".DATABASE['HOST'].";dbname=".DATABASE['DATABASE'];
		$connection = new PDO($string,DATABASE['USER'],DATABASE['PASSWORD']);
		return $connection;
	}

	//Execute a database query
	public function query($query, $data = []) {

		$connection = $this->connect(); //Make the connection
		$statement = $connection->prepare($query); //Prepare SQL statement to be executed with PDO::prepare()

		$check = $statement->execute($data); //Test the statement
		
		if($check){
			$result = $statement->fetchAll(PDO::FETCH_OBJ); //Get results in an Object
			if(is_array($result) && count($result)){
				return $result; //Return results
			}
		}

		return false;
	}

	//Get table row from database
	public function getRow($query, $data = []) {

		$connection = $this->connect(); //Make the connection
		$statement = $connection->prepare($query); //Prepare SQL statement to be executed with PDO::prepare()

		$check = $statement->execute($data); //Test the statement
		
		if($check){
			$result = $statement->fetchAll(PDO::FETCH_OBJ); //Get results in an Object
			if(is_array($result) && count($result)){
				return $result[0]; //Return only the first record (row)
			}
		}

		return false;
	}

}