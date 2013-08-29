<aside class="smallBox">
	<h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
	<article>
		<h3>Kuvaus</h3>
		<p>
			<?php
				include "connection.php";
				$result = $con->prepare("SELECT description FROM User WHERE username=?");
				$result->execute(array(htmlspecialchars($_SESSION["username"])));
				while($row = $result->fetch()){
					echo htmlspecialchars($row['description']);
				}
			?>
		</p>
		<h3>Tiedot</h3>
		<ul class="list">
			<?php
				include "connection.php";
				$result = $con->prepare("SELECT registerDate,favoriteMovie,favoriteActor FROM User WHERE username=?");
				$result->execute(array(htmlspecialchars($_SESSION["username"])));
				while($row = $result->fetch()){
					echo "<li><b>Liittymispäivä: </b>".htmlspecialchars($row['registerDate'])."</li>";
					echo "<li><b>Lempielokuva: </b>".htmlspecialchars($row['favoriteMovie'])."</li>";
					echo "<li><b>Lempinäyttelijä: </b>".htmlspecialchars($row['favoriteActor'])."</li>";
				}
			?>
		</ul>
		<br><a href="changeUserInfo.php"><i class="icon-pencil"></i> Muuta tietoja</a>
	</article>
</aside>