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
						<h2>Elokuvat genreittäin</h2>
						<article>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT mag.genreId,g.genreId,g.name as genreName,mag.movieId,m.movieId as movieId,m.name as movieName FROM Movie m,MovieAndGenre mag,Genre g WHERE mag.genreId=g.genreId and mag.movieId=m.movieId ORDER BY g.name");
									$result->execute();
									$genreOld="";
									while($row = $result->fetch()){
										$genreNew=htmlspecialchars($row['genreName']);
										if($genreOld!=$genreNew){
											echo "<li><b>".$genreNew."</b></li>";
										}
										$genreOld=$genreNew;
										echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['movieName'])."</a></li>";
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