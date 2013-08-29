<?php
	include "connection.php";
	$name=htmlspecialchars($_POST["name"]);
	$birthDate=htmlspecialchars($_POST["birthDate"]);
	$birthPlace=htmlspecialchars($_POST["birthPlace"]);
	$result = $con->prepare("SELECT personId FROM Id");
	$result->execute();
	$currentPersonId=0;
	while($row = $result->fetch()){
		$currentPersonId=htmlspecialchars($row['personId']);
	}
	$personId=$currentPersonId+1;
	$result=$con->prepare("UPDATE Id SET personId=?");
	$result->execute(array(htmlspecialchars($personId)));
	$result=$con->prepare("INSERT INTO Person VALUES(?,?,?,?)");
	$result->execute(array(htmlspecialchars($name),htmlspecialchars($personId),htmlspecialchars($birthDate),htmlspecialchars($birthPlace)));
?>