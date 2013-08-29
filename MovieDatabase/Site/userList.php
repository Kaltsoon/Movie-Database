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
						<h2>Käyttäjät</h2>
						<article>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT username FROM User ORDER BY username");
									$result->execute();
									$letterOld="";
									while($row = $result->fetch()){
										$letterNew=strtoupper(substr(htmlspecialchars($row['username']),0,1));
										if($letterNew!=$letterOld){
											echo "<li><b>".$letterNew."</b></li>";
										}
										$letterOld=$letterNew;
										echo "<li><a href='userShowCase.php?username=".htmlspecialchars($row['username'])."'>".htmlspecialchars($row['username'])."</a></li>";
									}
								?>
							</ul>
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