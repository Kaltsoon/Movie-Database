<?php
	include "connection.php";
	$result = $con->prepare("DELETE FROM Person WHERE personId=?");
	$result->execute(array(htmlspecialchars($_POST['personId'])));
	$result = $con->prepare("DELETE FROM InMovie WHERE personId=?");
	$result->execute(array(htmlspecialchars($_POST['personId'])));
	$result = $con->prepare("DELETE FROM Role WHERE personId=?");
	$result->execute(array(htmlspecialchars($_POST['personId'])));
?>