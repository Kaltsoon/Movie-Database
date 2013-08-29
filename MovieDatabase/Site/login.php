<html>
	<head>
		<meta charset="ANSI"/>
		<?php include "styles.php"; ?>
	</head>
	<body>
		<div id="contentWrapper">
			<?php include "header.php"; ?>
                        <?php include "navigation.php"; ?>
			<div id="mainWrapper">
				<div id="leftWrapper">
					<?php
						include "connection.php";
						$result = $con->prepare("SELECT password, username FROM User WHERE password=? and username=?");
						$result->execute(array(htmlspecialchars($_POST["password"]),htmlspecialchars($_POST["username"])));
						$check=0;
						while($row = $result->fetch()){
							$check++;
						}
						if($check>=1){
							include "loginSucces.php";
							session_start();
							$_SESSION["username"]=$_POST["username"];
						}else{
							include "loginFailure.php";
						}
					?>
				</div>
				<div id="rightWrapper">
					<?php include "rightContent.php"; ?>
				</div>
			</div>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>