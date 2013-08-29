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
						<h2>
							<?php 
								if($_GET["show"]=="actors"){
									echo "Näyttelijät";
								}else if($_GET["show"]=="directors"){
									echo "Ohjaajat";
								}else if($_GET["show"]=="writers"){
									echo "Käsikirjoittajat";
								}else{
									echo "(tyhjä)";
								}
							?>
						</h2>
						<article>
							<ul class="list">
								<?php
									include "connection.php";
									if($_GET["show"]=="actors"){
										$result = $con->prepare("SELECT personId,name FROM Person WHERE personId IN (SELECT personId FROM Role) ORDER BY name");
									}else if($_GET["show"]=="directors"){
										$result = $con->prepare("SELECT personId,name FROM Person WHERE personId IN (SELECT personId FROM InMovie WHERE task=0) ORDER BY name");
									}else if($_GET["show"]=="writers"){
										$result = $con->prepare("SELECT personId,name FROM Person WHERE personId IN (SELECT personId FROM InMovie WHERE task=1) ORDER BY name");
									}else{
										echo "<li>(tyhjä)</li>";
										exit();
									}
									$result->execute();
									$letterOld="";
									while($row = $result->fetch()){
										$letterNew=strtoupper(substr(htmlspecialchars($row['name']),0,1));
										if($letterNew!=$letterOld){
											echo "<li><b>".$letterNew."</b></li>";
										}
										$letterOld=$letterNew;
										echo "<li><a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>".htmlspecialchars($row['name'])."</a></li>";
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