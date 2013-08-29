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
						<h2>Elokuvien TOP 100</h2>
						<article>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT round(sum(r.stars)/count(r.stars),0) AS average, m.name as name, m.movieId as movieId, r.movieId FROM Review r, Movie m WHERE m.movieId=r.movieId GROUP BY r.movieId ORDER BY round(sum(r.stars)/count(r.stars),0) DESC");
									$result->execute();
									$i=1;
									while($i<=100){
										if($row = $result->fetch()){
										  echo "<li><div style='float: left; width: 210px; padding-top: 8px; padding-bottom: 8px;'><b style='margin-right: 10px;'>".$i.".</b><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['name'])."</a></div><div style='float: right;'><div class='review' style='width:".(17*htmlspecialchars($row['average']))."px;'></div></div></li>";
										}
										else{
											echo "<li><b style='margin-right: 10px;'>".$i."</b>-</li>";
										}
										$i++;
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