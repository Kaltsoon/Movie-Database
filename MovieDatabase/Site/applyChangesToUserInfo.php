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
					<section class="bigBox">
						<h2>Profiili on päivitetty onnistuneesti!</h2>
						<article>
						<a href="index.php">Siirry etusivulle</a>
						<?php
							include "connection.php";
							$result = $con->prepare("UPDATE User SET description=?, favoriteMovie=? ,favoriteActor=? WHERE username=?");
							$result->execute(array(htmlspecialchars($_POST["description"]),htmlspecialchars($_POST["favoriteMovie"]),htmlspecialchars($_POST["favoriteActor"]),htmlspecialchars($_SESSION["username"])));
						?>
						</article>
					</section>
				</div>
				<div id="rightWrapper">
					<?php include "rightContent.php"; ?>
				</div>
			</div>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>