<?php
	include "connection.php";
	$result = $con->prepare("INSERT INTO Review VALUES(?,?,?,?,NOW())");
	$result->execute(array(htmlspecialchars($_POST["movieid"]),htmlspecialchars($_POST["name"]),htmlspecialchars($_POST["stars"]),htmlspecialchars($_POST["review"])));
?>