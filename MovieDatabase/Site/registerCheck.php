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
								echo "<section class='bigBox'><h2>Rekisteröityminen epäonnistui!</h2>";
								echo "<article>Käyttäjätunnus <i>".htmlspecialchars($_POST["username"])."</i> on jo käytössä. Valitse toinen käyttäjätunnus ja <a href='register.php'>rekisteröidy</a> uudelleen!</section>";
							}else{
								echo "<section class='bigBox'><h2>Rekisteröityminen onnistui!</h2>";
								echo "<article>Olet onnistuneesti rekisteröinyt käyttäjän <i>".htmlspecialchars($_POST["username"])."</i> ja voit käyttää sitä kirjautuaksesi sisään!</article></section>";
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