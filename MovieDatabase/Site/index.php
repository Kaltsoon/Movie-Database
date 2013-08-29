<html>
	<head>
		<meta charset="ANSI" />
		<?php include "styles.php"; ?>
	</head>
	<body>
		<div id="contentWrapper">
			<?php include "header.php"; ?>
			<?php include "navigation.php"; ?>
			<div id="mainWrapper">
				<div id="leftWrapper">
					<section class="bigBox">
						<h2>Uusimmat elokuvat</h2>
						<?php
							include "connection.php";
							$result = $con->prepare("SELECT name,movieId,premiereDate,description FROM Movie ORDER BY premiereDate DESC");
							$result->execute();
							$i=1;
							while($i<=3){
								if($row = $result->fetch()){
									echo "<article>";
									echo "<a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'><h3>".htmlspecialchars($row['name'])."</h3></a>";
									$result2 = $con->prepare("SELECT round(sum(stars)/count(stars),0) AS average FROM Review WHERE movieId=?");
									$result2->execute(array(htmlspecialchars($row['movieId'])));
									while($row2 = $result2->fetch()){
									  echo "<div class='review' style='width:".(17*htmlspecialchars($row2['average']))."'></div>";
									}
									echo "<ul>";
									echo "<li><b>Ensi-ilta:</b> ".$row['premiereDate']."</li>";
									$result3 = $con->prepare("SELECT g.genreId,g.name as genreName ,mag.genreId,mag.movieId FROM Genre g, MovieAndGenre mag WHERE mag.movieId=? and g.genreId=mag.genreId");
									$result3->execute(array(htmlspecialchars($row['movieId'])));
									$t=0;
									echo "<li><b>Genre:</b> ";
									while($row3 = $result3->fetch()){
										if($t!=0){
										echo ", " . htmlspecialchars($row3["genreName"]);
										}else{
										echo htmlspecialchars($row3["genreName"]);
										}
										$t++;
									}
									$description=htmlspecialchars($row['description']);
									if(strlen($description)>200){
										$description=substr($description,0,200)."...";
									}
									echo "<li style='padding-top: 15px;'>" . $description."</li>";
									echo "</ul>";
									echo "</article>";
								}
								$i++;
							}
						?>
					</section>
					<section class="bigBox">
						<h2>Uusimmat arvostelut</h2>
						<?php
						include "connection.php";
						$result = $con->prepare("SELECT r.movieId,m.movieId as movieId,r.username,u.username as username,r.review as review,r.stars as stars,m.name as movieName,r.submitDate as submitDate FROM Movie m,User u,Review r WHERE r.movieId=m.movieId and u.username=r.username ORDER BY r.submitDate DESC");
						$result->execute();
						$i=1;
						while($i<=3){
							if($row = $result->fetch()){
								echo "<article>";
								echo "<a href='userShowCase.php?username=".htmlspecialchars($row['username'])."'><h3>".htmlspecialchars($row['username'])."</h3></a>";
								echo "<ul>";
								echo "<li><b>Elokuva:</b> <a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['movieName'])."</a></li>";
								echo "<li><div class='review' style='width:".(17*htmlspecialchars($row['stars']))."'></div></li>";
								$review=utf8_decode(htmlspecialchars($row['review']));
								if(strlen($review)>200){
									$review=substr($review,0,200)."...";
								}
								echo "<li>" . $review . "</li>";
								echo "<br><span style='color: rgb(120,120,120);'>" . htmlspecialchars($row['submitDate']) . "</span>";
								echo "</ul>";
								echo "</article>";
							}
							$i++;
						}
						?>
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