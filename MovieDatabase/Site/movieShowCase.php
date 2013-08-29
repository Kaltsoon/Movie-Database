<html>
	<head>
		<meta charset="ANSI"/>
		<?php include "styles.php"; ?>
	</head>
	<body>
		<?php
			
		?>
		<div id="contentWrapper">
			<?php include "header.php"; ?>
			<?php include "navigation.php"; ?>
			<div id="mainWrapper">
				<div id="leftWrapper">
					<section class="bigBox">
						<h2>
							<?php
								include "connection.php";
								$result =$con->prepare("SELECT name FROM Movie WHERE movieId=?");
								$result->execute(array(htmlspecialchars($_GET["movieId"])));
								while($row = $result->fetch()){
									echo htmlspecialchars($row['name']);
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
									echo "<input type='button' value='Poista' class='yellow' id='deleteMovie' data-movieid='".htmlspecialchars($_GET["movieId"])."' style='margin-left: 0px'>";
									echo "</article>";
								}
							}
						?>
						<article>
							<h3>Tiedot</h3>
							<ul>
								<?php
									include "connection.php";
									$result = $con->prepare("SELECT round(sum(stars)/count(stars),0) AS average FROM Review WHERE movieId=?");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									while($row = $result->fetch()){
										echo "<li><div class='review' style='width:".(17*htmlspecialchars($row['average']))."'></div></li>";
									}
									$result = $con->prepare("SELECT name FROM Movie WHERE movieId=?");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									while($row = $result->fetch()){
										echo "<li><b>Nimi:</b> " . htmlspecialchars($row['name']) . "</li>";
									}
									$result = $con->prepare("SELECT g.genreId,g.name as genreName ,mag.genreId,mag.movieId FROM Genre g, MovieAndGenre mag WHERE mag.movieId=? and g.genreId=mag.genreId");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									$i=0;
									echo "<li><b>Genre:</b> ";
									while($row = $result->fetch()){
										if($i!=0){
											echo ", " . htmlspecialchars($row["genreName"]);
										}else{
											echo htmlspecialchars($row["genreName"]);
										}
										$i++;
									}
									$i=0;
									echo "</li>";
									$result = $con->prepare("SELECT premiereDate,duration FROM Movie WHERE movieId=?");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									while($row = $result->fetch()){
										echo "<li><b>Ensi-ilta:</b> " . htmlspecialchars($row['premiereDate']) . "</li>";
										echo "<li><b>Kesto:</b> " . htmlspecialchars($row['duration']) . " min.</li>";
									}
									$result = $con->prepare("SELECT im.movieId,im.personId,p.personId as personId,p.name as personName,im.task FROM Person p, InMovie im WHERE im.movieId=? and p.personId=im.personId and im.task=0");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									echo "<li><b>Ohjaaja:</b> ";
									while($row = $result->fetch()){
										if($i!=0){
											echo ", <a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>". htmlspecialchars($row["personName"])."</a>";
										}else{
											echo "<a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>". htmlspecialchars($row["personName"])."</a>";;
										}
										$i++;
									}
									$i=0;
									$result = $con->prepare("SELECT im.movieId,im.personId,p.personId as personId,p.name as personName,im.task FROM Person p, InMovie im WHERE im.movieId=? and p.personId=im.personId and im.task=1");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									echo "<li><b>Käsikirjoittaja:</b> ";
									while($row = $result->fetch()){
										if($i!=0){
											echo ", <a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>". htmlspecialchars($row["personName"])."</a>";
										}else{
											echo "<a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>". htmlspecialchars($row["personName"])."</a>";;
										}
										$i++;
									}
								?>
							</ul>
						</article>
						<article>
						<h3>Kuvaus</h3>
							<?php
							include "connection.php";
							$result = $con->prepare("SELECT description FROM Movie WHERE movieId=?");
							$result->execute(array(htmlspecialchars($_GET["movieId"])));
							while($row = $result->fetch()){
								echo htmlspecialchars($row['description']);
							}
							?>
						</article>
						<article>
						<h3>Rooleissa</h3>
						<ul class="list">
						<?php
						include "connection.php";
						$result = $con->prepare("SELECT p.name as personName,p.personId as personId,r.personId,r.name as roleName,r.movieId FROM Role r,Person p WHERE r.movieId=? and p.personId=r.personId");
						$result->execute(array(htmlspecialchars($_GET["movieId"])));
						while($row =  $result->fetch()){
							echo "<li><a href='personShowCase.php?personId=".htmlspecialchars($row['personId'])."'>".htmlspecialchars($row['personName'])."</a><div style='float: right;'>roolissa <i>".htmlspecialchars($row['roleName'])."</i></div></li>";
						}
						?>
						</ul>
						</article>
						<a name="reviewsTop"></a>
						<article>
							<h3>Käyttäjien arvostelut</h3>
							<ul class="list reviewList">
								<?php
									include "connection.php";
									$admin=false;
									if(isset($_SESSION["username"])){
										$result = $con->prepare("SELECT permission FROM User WHERE username=?");
										$result->execute(array(htmlspecialchars($_SESSION["username"])));
										if($row = $result->fetch()){
											if($row['permission']==1){
												$admin=true;
											}
										}
									}
									$result = $con->prepare("SELECT * FROM Review WHERE movieId=? ORDER BY submitDate DESC");
									$result->execute(array(htmlspecialchars($_GET["movieId"])));
									while($row = $result->fetch()){
										echo "<li>";
										echo "<a href='userShowCase.php?username=".htmlspecialchars($row['username'])."'><h3>".htmlspecialchars($row['username'])."</h3></a>";
										echo utf8_decode(htmlspecialchars($row['review']));
										echo "<div style='overflow: hidden;'>";
										echo "<div style='float: left;'>";
										echo "<div class='review' style='width:".(17*htmlspecialchars($row['stars']))."'></div>";
										echo "<span style='color: rgb(120,120,120);'>".htmlspecialchars($row['submitDate'])."</span>";
										echo "</div>";
										echo "</div>";
										if($admin==true){
											echo "<input type='button' class='deleteReview yellow' style='margin-left: 0px; margin-top: 15px;' data-movieid='".htmlspecialchars($_GET["movieId"])."' data-username='".htmlspecialchars($row['username'])."' value='Poista'>";
										}
										echo "</li>";
									}
								?>
							</ul>
						</article>
						<article class="reviewForm">
							<?php
								if(isset($_SESSION["username"])){
									include "connection.php";
									$result = $con->prepare("SELECT * FROM Review WHERE username=? and movieId=?");
									$result->execute(array(htmlspecialchars($_SESSION["username"]),htmlspecialchars($_GET["movieId"])));
									$check=0;
									while($row = $result->fetch()){
										$check++;
									}
									if($check==0){
										include "reviewForm.php";
									}else{
										echo "<h3>Olet jo arvostellut tämän elokuvan!</h3>";
									}
								}else{
									echo "<h3>Kirjaudu sisään arvostellaksesi tämän elokuvan</h3>";
								}
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