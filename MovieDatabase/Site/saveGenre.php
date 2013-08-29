<?php
	include("connection.php");
	$name=htmlspecialchars($_POST["name"]);
	$result = $con->prepare("SELECT genreId FROM Id");
	$result->execute();
	$currentGenreId=0;
	while($row = $result->fetch()){
		$currentGenreId=htmlspecialchars($row['genreId']);
	}
	$genreId=$currentGenreId+1;
	$result=$con->prepare("UPDATE Id SET genreId=?");
	$result->execute(array(htmlspecialchars($genreId)));
	$result=$con->prepare("INSERT INTO Genre VALUES(?,?)");
	$result->execute(array(htmlspecialchars($genreId),htmlspecialchars($name)));
?>