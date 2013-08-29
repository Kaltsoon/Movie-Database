<?php
	session_start();
	if(isset($_SESSION["username"])){
		include "userCard.php";
	}
?>
<aside class="smallBox">
	<h2>Arvostetuimmat elokuvat</h2>
	<article>
		<h3>TOP 10</h3>
		<ul class="list">
			<?php
				include "connection.php";
				$result = $con->prepare("SELECT round(sum(r.stars)/count(r.stars),0) AS average, m.name as name, m.movieId as movieId, r.movieId FROM Review r, Movie m WHERE m.movieId=r.movieId GROUP BY r.movieId ORDER BY round(sum(r.stars)/count(r.stars),0) DESC");
				$result->execute();
				$i=1;
				while($i<=10){
					if($row = $result->fetch()){
						echo "<li><div style='float: left; width: 210px; padding-top: 8px; padding-bottom: 8px;'><b style='margin-right: 10px;'>".$i.".</b><a href='movieShowCase.php?movieId=".htmlspecialchars($row['movieId'])."'>".htmlspecialchars($row['name'])."</a></div><div style='float: right;'><div class='review' style='width:".(17*htmlspecialchars($row['average']))."px;'></div></div></li>";
					}else{
						echo "<li><b style='margin-right: 10px;'>".$i."</b>-</li>";
					}
					$i++;
				}
			?>
		</ul>
		<br><a href="moviesTop100.php"><i class="icon-list"></i> Katso TOP-100-lista</a>
	</article>
</aside>
<aside class="smallBox">
	<h2>Haku</h2>
	<article>
	<h3>Hae näytteliöijöitä, elokuvia, ohjaajia...</h3>
	<form method="get" action="searchResults.php">
		<input type="text" name="keyword" placeholder="Hakusana" style="width: 200px;"><input type="submit" class="yellow" value="Hae" style="margin-left: 10px;">
	</form>
	</article>
</aside>