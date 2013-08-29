<?php
	include "connection.php";
	$result = $con->prepare("DELETE FROM Review WHERE movieId=? AND username=?");
	$result->execute(array(htmlspecialchars($_POST["movieid"]),htmlspecialchars($_POST["username"])));
?>