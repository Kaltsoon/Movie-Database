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
						<h2><?php echo htmlspecialchars($_GET["username"]); ?></h2>
						<article>
							<h3>Kuvaus</h3>
							<p>
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT description FROM User WHERE username=?");
									$result->execute(array(htmlspecialchars($_GET["username"])));
									while($row = $result->fetch()){
										echo htmlspecialchars($row['description']);
									}
								?>
							</p>
						</article>
						<article>
							<h3>Tiedot</h3>
							<ul class="list">
								<?php
								include "connection.php";
								$result = $con->prepare("SELECT registerDate,favoriteMovie,favoriteActor FROM User WHERE username=?");
								$result->execute(array(htmlspecialchars($_GET["username"])));
								while($row = $result->fetch()){
									echo "<li><b>Liittymisp‰iv‰: </b>".htmlspecialchars($row['registerDate'])."</li>";
									echo "<li><b>Lempielokuva: </b>".htmlspecialchars($row['favoriteMovie'])."</li>";
									echo "<li><b>Lempin‰yttelij‰: </b>".htmlspecialchars($row['favoriteActor'])."</li>";
								}
								?>	
							</ul>
						</article>
						<article>
							<h3>Elokuvia, joista <?php echo htmlspecialchars($_GET["username"]); ?> tykk‰‰</h3>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT m.movieId as mi,r.movieId,m.name as movieName,r.stars,r.username FROM Movie m, Review r WHERE r.username=? and m.movieId=r.movieId and r.stars>3 ORDER BY r.stars");
									$result->execute(array(htmlspecialchars($_GET["username"])));
									while($row = $result->fetch()){
										echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['mi'])."'>".htmlspecialchars($row['movieName'])."</a></li>";
									}
								?>
							</ul>
						</article>
						<article>
							<h3>Elokuvat, jotka <?php echo htmlspecialchars($_GET["username"]); ?> on arvostellut</h3>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT m.movieId as mi,r.movieId,m.name as movieName,r.username FROM Movie m, Review r WHERE r.username=? and m.movieId=r.movieId ORDER BY m.name");
									$result->execute(array(htmlspecialchars($_GET["username"])));
									while($row = $result->fetch()){
										echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['mi'])."'>".htmlspecialchars($row['movieName'])."</a></li>";
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