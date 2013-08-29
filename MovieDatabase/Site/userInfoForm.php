<section class="bigBox">
	<h2>Muuta profiilia</h2>
	<article>
		<form action="applyChangesToUserInfo.php" method="post">
			<h3>Kuvaus</h3>
			<p>
				<?php
					$textarea = "<textarea maxlength='500' name='description'";
					include "connection.php";
					$result = $con->prepare("SELECT description, username FROM User WHERE username=?");
					$result->execute(array(htmlspecialchars($_SESSION["username"])));
					while($row = $result->fetch()){
						$textarea.="placeholder='".htmlspecialchars($row['description'])."'";
					}
					$textarea.="></textarea>";
					echo $textarea;
				?>
			</p>
			<h3>Tiedot</h3>
			<ul class="list">
				<li>
					<b>Lempielokuva:</b>
					<p>
						<input type="text" name="favoriteMovie" placeholder="<?php
							include "connection.php";
							$result = $con->prepare("SELECT favoriteMovie, username FROM User WHERE username=?");
							$result->execute(array(htmlspecialchars($_SESSION["username"])));
							while($row = $result->fetch()){
								echo htmlspecialchars($row['favoriteMovie']);
							}
						?>" maxlength="50" style="width: 200px;">
					</p>
				</li>
				<li>
					<b>Lempinäyttelijä:</b>
					<p>
						<input type="text" name="favoriteActor" placeholder="<?php
							include "connection.php";
							$result = $con->prepare("SELECT favoriteActor, username FROM User WHERE username=?");
							$result->execute(array(htmlspecialchars($_SESSION["username"])));
							while($row = $result->fetch()){
								echo htmlspecialchars($row['favoriteActor']);
							}
						?>" maxlength="50" style="width: 200px;">
					</p>
				</li>
			</ul>
			<input type="submit" value="Tallenna" class="yellow" style="margin-top: 10px; margin-left: 0px;">
		</form>
	</article>
</section>