<?php
	class Review{
		public $username;
		public $review;
		public $stars;
		public $timestamp;
		public $movieid;
		public $adminStatus;
		public function __construct($movieid,$username,$review,$stars,$timestamp,$adminStatus){
			$this->movieid=$movieid;
			$this->username=$username;
			$this->review=$review;
			$this->stars=$stars;
			$this->timestamp=$timestamp;
			$this->adminStatus=$adminStatus;
		}
	}
	include "connection.php";
	$admin=false;
	session_start();
	if(isset($_SESSION["username"])){
		$result = $con->prepare("SELECT permission FROM User WHERE username=?");
		$result->execute(array(htmlspecialchars($_SESSION["username"])));
		if($row = $result->fetch()){
			if($row['permission']==1){
				$admin=true;
			}
		}
	}
	$result = $con->prepare("SELECT * FROM Review WHERE movieId=? ORDER BY submitDate DESC");
	$result->execute(array(htmlspecialchars($_POST["movieId"])));
	$reviews=array();
	while($row = $result->fetch()){
		$review=new Review(htmlspecialchars($row["movieId"]),htmlspecialchars($row["username"]),htmlspecialchars($row["review"]),htmlspecialchars($row["stars"]),htmlspecialchars($row["submitDate"]),$admin);
		array_push($reviews,$review);
	}
	$json=json_encode($reviews);
	echo $json;
?>