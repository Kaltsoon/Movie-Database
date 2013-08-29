<section class="bigBox">
    <h2>Lis‰‰ elokuva</h2>
    <article>
        <h3>Tiedot</h3>
        <ul class="list">
            <li>
                <b style="display: block; margin-bottom: 10px;">Nimi:</b>
                <input type="text" id="movieName">
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">Genre:</b>
                <ul id="genreList" class="normal">
                </ul>
                <select id="genreOptions">
                    <?php
                        include "connection.php";
                        $result = $con->prepare("SELECT genreId, name FROM Genre");
						$result->execute();
                        while($row = $result->fetch()){
							echo "<option value='".htmlspecialchars($row['genreId'])."'>".htmlspecialchars($row['name'])."</option>";
                        }
					?>
                </select>
                <input type="button" value="Lis‰‰ genre" id="addGenre" class="yellow" style="margin-left: 0px; margin-right: 10px; margin-top: 15px; margin-bottom: 10px;">
                <input type="button" value="Tyhjenn‰" id="clearGenre" class="yellow" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px;">
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">Ensi-ilta:</b>
                <input type="text" id="moviePremiereYear" placeholder="VVVV" style="width: 55px;">
                <input type="text" id="moviePremiereMonth"  style="width: 35px; margin-left: 15px;" placeholder="KK">
                <input type="text" id="moviePremiereDay" placeholder="PP" style="width: 35px; margin-left: 15px;" >
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">Kesto:</b>
                <input type="text" id="movieDuration" style="width: 50px;">  min.
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">Ohjaaja:</b>
                <ul id="directorList" class="normal">
                </ul>
                <select id="directorOptions">
                    <?php
                        include "connection.php";
                        $result = $con->prepare("SELECT personId, name FROM Person");
						$result->execute();
                        while($row = $result->fetch()){
							echo "<option value='".htmlspecialchars($row['personId'])."'>".htmlspecialchars($row['name'])."</option>";
                        }
					?>
                </select>
                <input type="button" value="Lis‰‰ ohjaaja" id="addDirector" class="yellow" style="margin-left: 0px; margin-right: 10px; margin-top: 15px; margin-bottom: 10px;">
                <input type="button" value="Tyhjenn‰" id="clearDirector" class="yellow" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px;">
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">K‰sikirjoittaja:</b>
                <ul id="writerList" class="normal">
                </ul>
                <select id="writerOptions">
                    <?php
                        include "connection.php";
                        $result = $con->prepare("SELECT personId, name FROM Person");
						$result->execute();
                        while($row = $result->fetch()){
							echo "<option value='".$row['personId']."'>".$row['name']."</option>";
                        }
					?>
                </select>
                <input type="button" value="Lis‰‰ k‰sikirjoittaja" id="addWriter" class="yellow" style="margin-left: 0px; margin-right: 10px; margin-top: 15px; margin-bottom: 10px;">
                    <input type="button" value="Tyhjenn‰" id="clearWriter" class="yellow" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px;">
            </li>
            <li>
                <b style="display: block; margin-bottom: 10px;">Rooleissa:</b>
                <ul id="roleList" class="normal">
                </ul>
                <select id="roleOptions">
                    <?php
                        include "connection.php";
                        $result = $con->prepare("SELECT personId, name FROM Person");
						$result->execute();
                        while($row = $result->fetch()){
							echo "<option value='".htmlspecialchars($row['personId'])."'>".htmlspecialchars($row['name'])."</option>";
                        }
				?>
                </select>
                <br>
                <input type="text" id="role">
                <br>
                <input type="button" value="Lis‰‰ rooli" id="addRole" class="yellow" style="margin-left: 0px; margin-right: 10px; margin-top: 15px; margin-bottom: 10px;">
                <input type="button" value="Tyhjenn‰" id="clearRole" class="yellow" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px;">
            </li>
								
								
        </ul>
        <h3>Kuvaus:<h3>
                <textarea id="movieDescription"></textarea>
                <input type="button" id="addMovie" value="Lis‰‰ elokuva" class="yellow" style="margin-left: 0px; margin-top: 10px;">
    </article>
</section>