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
							include "connection.php";
							$result = $con->prepare("SELECT name FROM Person WHERE personId=?");
							$result->execute(array(htmlspecialchars($_GET["personId"])));
							while($row = $result->fetch()){
								echo $row['name'];
							}
						?>
						</h2>
						<?php
							if(isset($_SESSION["username"])){
								include "connection.php";
								$result = $con->prepare("SELECT permission,username FROM User WHERE username=?");
								$result->execute(array(htmlspecialchars($_SESSION["username"])));
								$permission=0;
								while($row = $result->fetch()){
									$permission=htmlspecialchars($row['permission']);
								}
								if($permission==1){
									echo "<article>";
									echo "<h3>Työkalut</h3>";
									echo "<input type='button' value='Poista' class='yellow' id='deletePerson' data-personid='".htmlspecialchars($_GET["personId"])."' style='margin-left: 0px'>";
									echo "</article>";
								}
							}
						?>
						<article>
							<h3>Tiedot</h3>
							<ul>
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT name,dateOfBirth,placeOfBirth FROM Person WHERE personId=?");
									$result->execute(array(htmlspecialchars($_GET["personId"])));
									while($row = $result->fetch()){
										echo "<li><b>Nimi:</b> " . htmlspecialchars($row['name']) . "</li>";
										echo "<li><b>Syntymäaika:</b> " . htmlspecialchars($row['dateOfBirth']) . "</li>";
										echo "<li><b>Syntymäpaikka:</b> " . htmlspecialchars($row['placeOfBirth']) . "</li>";
									}
								?>
							</ul>
						</article>
						<article>
							<h3>Elokuvia, joissa
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT name FROM Person WHERE personId=?");
									$result->execute(array(htmlspecialchars($_GET["personId"])));
									while($row = $result->fetch()){
										echo htmlspecialchars($row['name']);
									}
								?> on näytellyt
							</h3>
						<ul class="list">
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT DISTINCT r.movieId,r.personId,m.movieId as movieId,m.name as movieName FROM Role r,Movie m WHERE r.personId=? and m.movieId=r.movieId");
								$result->execute(array(htmlspecialchars($_GET["personId"])));
								while($row = $result->fetch()){
									echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>". htmlspecialchars($row['movieName']) . "</a></li>";
								}
							?>
						</ul>
					</article>
					<article>
						<h3>Elokuvia, jotka 
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT name FROM Person WHERE personId=?");
								$result->execute(array(htmlspecialchars($_GET["personId"])));
								while($row = $result->fetch()){
									echo htmlspecialchars($row['name']);
								}
							?> on ohjannut
						</h3>
						<ul class="list">
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT DISTINCT im.movieId,im.personId,im.task,m.movieId as movieId,m.name as movieName FROM InMovie im,Movie m WHERE im.personId=? and im.movieId=m.movieId and im.task=0");
								$result->execute(array(htmlspecialchars($_GET["personId"])));
								while($row = $result->fetch()){
									echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>". htmlspecialchars($row['movieName']) . "</a></li>";
								}
							?>
						</ul>
					</article>
					<article>
						<h3>Elokuvia, jotka
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT name FROM Person WHERE personId=?");
								$result->execute(array(htmlspecialchars($_GET["personId"])));
								while($row = $result->fetch()){
									echo htmlspecialchars($row['name']);
								}
							?> on käsikirjoittanut
						</h3>
						<ul class="list">
							<?php
								include "connection.php";
								$result = $con->prepare("SELECT DISTINCT im.movieId,im.personId,im.task,m.movieId as movieId,m.name as movieName FROM InMovie im,Movie m WHERE im.personId=? and im.movieId=m.movieId and im.task=1");
								$result->execute(array(htmlspecialchars($_GET["personId"])));
								while($row = $result->fetch()){
									echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>". htmlspecialchars($row['movieName']) . "</a></li>";
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