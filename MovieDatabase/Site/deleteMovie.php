<?php
	include "connection.php";
	$result = $con->prepare("DELETE FROM Movie WHERE movieId=?");
	$result->execute(array(htmlspecialchars($_POST['movieId'])));
	$result = $con->prepare("DELETE FROM InMovie WHERE movieId=?");
	$result->execute(array(htmlspecialchars($_POST['movieId'])));
	$result = $con->prepare("DELETE FROM Role WHERE movieId=?");
	$result->execute(array(htmlspecialchars($_POST['movieId'])));
	$result = $con->prepare("DELETE FROM MovieAndGenre WHERE movieId=?");
	$result->execute(array(htmlspecialchars($_POST['movieId'])));
?>