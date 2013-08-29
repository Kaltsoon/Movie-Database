<?php
	include "connection.php";
	$directors=explode(";",$_POST['directors']);
	$writers=explode(";",$_POST['writers']);
	$roles=explode(";",$_POST['roles']);
	$genres=explode(";",$_POST['genres']);
	$name=$_POST['name'];
	$duration=$_POST['duration'];
	$premiereDate=$_POST['premiereDate'];
	$description=$_POST['description'];
	$result = $con->prepare("SELECT movieId FROM Id");
	$result->execute();
	$currentMovieId=0;
	while($row = $result->fetch()){
		$currentMovieId=htmlspecialchars($row['movieId']);
	}
	$movieId=$currentMovieId+1;
	$result=$con->prepare("UPDATE Id SET movieId=?");
	$result->execute(array(htmlspecialchars($movieId)));
	for($i=0; $i<count($directors); $i++){
		$result=$con->prepare("INSERT INTO InMovie VALUES (?,?,0)");
		$result->execute(array(htmlspecialchars($movieId),htmlspecialchars($directors[$i])));
	}
	for($i=0; $i<count($writers); $i++){
		$result=$con->prepare("INSERT INTO InMovie VALUES (?,?,1)");
		$result->execute(array(htmlspecialchars($movieId),htmlspecialchars($writers[$i])));
	}
	for($i=0; $i<count($genres); $i++){
		$result=$con->prepare("INSERT INTO MovieAndGenre VALUES (?,?)");
		$result->execute(array(htmlspecialchars($movieId),htmlspecialchars($genres[$i])));
	}
	for($i=0; $i<count($roles); $i++){
		$temp=explode(":",$roles[$i]);
		$personId=$temp[0];
		$roleName=$temp[1];
		$result=$con->prepare("INSERT INTO Role VALUES (?,?,?)");
		$result->execute(array(htmlspecialchars($personId),htmlspecialchars($movieId),htmlspecialchars($roleName)));
	}
	$result=$con->prepare("INSERT INTO Movie VALUES (?,?,?,?,?,NOW())");
	$result->execute(array(htmlspecialchars($movieId),htmlspecialchars($name),htmlspecialchars($description),htmlspecialchars($premiereDate),htmlspecialchars($duration)));
?>