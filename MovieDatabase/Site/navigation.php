<nav>
	<ul>
		<li><a href="index.php"><i class="icon-home"></i> Etusivu</a></li>
		<li>
			<a href="#">Elokuvat</a>
			<ul class="fallback">
				<li><a href="moviesByGenre.php">Genreittäin</a></li>
				<li><a href="moviesByInitial.php">Aakkosittain</a></li>
				<li><a href="moviesByPremiereDate.php">Uusimmat</a></li>
				<li><a href="moviesTop100.php">TOP 100</a></li>
			</ul>
		</li>
		<li><a href="personList.php?show=actors">Näyttelijät</a></li>
		<li><a href="personList.php?show=directors">Ohjaajat</a></li>
		<li><a href="personList.php?show=writers">Käsikirjoittajat</a></li>
		<li><a href="userList.php">Käyttäjät</a></li>
		<?php
			if(isset($_SESSION["username"])){
				include "connection.php";
				$result =  $con->prepare("SELECT permission,username FROM User WHERE username=?");
				$result->execute(array(htmlspecialchars($_SESSION["username"])));
				$permission=0;
				while($row = $result->fetch()){
					$permission=htmlspecialchars($row['permission']);
				}
				if($permission==1){
					echo "<li><a href='#'><i class='icon-cog'></i> Työkalut</a><ul class='fallback'><li><a href='addMovie.php'>Lisää elokuva</a></li><li><a href='addPerson.php'>Lisää henkilö</a></li><li><a href='addGenre.php'>Lisää genre</a></li></ul></li>";
				}
			}
		?>
	</ul>
</nav>