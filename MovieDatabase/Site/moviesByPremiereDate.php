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
						<h2>Uusimmat elokuvat</h2>
						<article>
							<ul class="list">
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT name,movieId,premiereDate FROM Movie ORDER BY premiereDate DESC");
									$result->execute();
									$yearOld="";
									while($row = $result->fetch()){
										$yearNew=substr(htmlspecialchars($row['premiereDate']),0,4);
										if($yearOld!=$yearNew){
											echo "<li><b>".$yearNew."</b></li>";
										}
										$yearOld=$year;
										echo "<li><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['name'])."</a></li>";
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