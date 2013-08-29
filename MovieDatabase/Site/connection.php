<?php
	try {
		$con=new PDO("mysql:host=mysql9.000webhost.com;dbname=a5209055_etk","a5209055_etk","elli123");
	} catch (PDOException $e) {
		die("ERROR! " . $e->getMessage());
	}
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con->exec("SET CHARACTER SET utf8");
?>