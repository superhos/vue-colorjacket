<?php 
function getConnection() {
	try {
		
		$dbhost="localhost";
		$dbuser="root";
		$dbpass="112358";
		$dbname="colorjacket";
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
	return $conn;
}