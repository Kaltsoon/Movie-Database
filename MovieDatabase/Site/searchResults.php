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
						<h2>Tulokset haulle "<?php echo htmlspecialchars($_GET['keyword']); ?>"</h2>
						<article>
							<h3>Elokuvat, jotka t‰sm‰‰v‰t hakuun</h3>
							<ul class='list'>
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT  name,movieId FROM Movie WHERE UCASE(name) LIKE ?;");
								$result->execute(array(htmlspecialchars("%".strtoupper($_GET["keyword"])."%")));
								while($row = $result->fetch()){
									echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['name'])."</a></li>";
								}
							?>		
							</ul>					
							<h3>Henkilˆt, jotka t‰sm‰‰v‰t hakuun</h3>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT name,personId FROM Person WHERE UCASE(name) LIKE ?;");
									$result->execute(array(htmlspecialchars("%".strtoupper($_GET["keyword"])."%")));
									while($row = $result->fetch()){
										echo "<li><a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>".htmlspecialchars($row['name'])."</a></li>";
									}
								?>
							</ul>
							<h3>K‰ytt‰j‰t, jotka t‰sm‰‰v‰t hakuun</h3>
							<ul class="list">		
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT username FROM User WHERE UCASE(username) LIKE ?;");
									$result->execute(array(htmlspecialchars("%".strtoupper($_GET["keyword"])."%")));
									while($row = $result->fetch()){
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