<?php
/*
* This program connects to the postgres database
*/

/*
* Prerequisites : Host must have php-pgsql installed
* Host must be connected to tamu VPN
*/

//Connect to the database
$host = "database-1.csgl6fql6yv6.us-east-2.rds.amazonaws.com";
$user = "postgres";                     //Your Cloud 9 username
$pass = "betterthanyourdb";                                  //Remember, there is NO password by default!
$db = "postgres";
$string = "pgsql:host=". $host .";port=5432;dbname=" . $db . ";user=" . $user . ";password= " . $pass;


try {
	$connection = new PDO($string);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>