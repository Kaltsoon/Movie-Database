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
						$valid = (strlen($_POST["username"])>=3 && strlen($_POST["username"])<=15 && $_POST["password"]==$_POST["passwordAgain"] && strlen($_POST["password"])>=5);
						if($valid==false){
							include "registerFailure.php";
						}else{
							include "connection.php";
							$result = $con->prepare("SELECT * FROM User WHERE username=?");
							$result->execute(array(htmlspecialchars($_POST["username"])));
							$check=0;
							while($row = $result->fetch()){
								$check++;
							}
							if($check!=0){
								echo "<section class='bigBox'><h2>Rekister�ityminen ep�onnistui!</h2>";
								echo "<article>K�ytt�j�tunnus <i>".htmlspecialchars($_POST["username"])."</i> on jo k�yt�ss�. Valitse toinen k�ytt�j�tunnus ja <a href='register.php'>rekister�idy</a> uudelleen!</section>";
							}else{
								echo "<section class='bigBox'><h2>Rekister�ityminen onnistui!</h2>";
								echo "<article>Olet onnistuneesti rekister�inyt k�ytt�j�n <i>".htmlspecialchars($_POST["username"])."</i> ja voit k�ytt�� sit� kirjautuaksesi sis��n!</article></section>";
								$result = $con->prepare("INSERT INTO User VALUES(?,?,'. . .','. . .','. . .',NOW(),0)");
								$result->execute(array(htmlspecialchars($_POST["username"]),htmlspecialchars($_POST["password"])));
							}
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