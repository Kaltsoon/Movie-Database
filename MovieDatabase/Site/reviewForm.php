<h3>Kirjoita arvostelusi</h3>								
<b>Arvosana:</b>
<select style="margin-top: 10px; margin-bottom: 10px;" id="stars">
	<option value = "1">1 - Huono</option>
	<option value = "2">2 - Välttävä</option>
	<option value = "3">3 - Kohtalainen</option>
	<option value = "4">4 - Hyvä</option>
	<option value = "5">5 - Erinomainen</option>
</select>
<b>Arvostelu:</b>
<textarea style="margin-top: 10px;" id="review"></textarea>
<?php echo "<input type='button' value='Lähetä arvostelu' class='yellow saveReview' style='margin-left: 0px; margin-top: 20px;' data-movieid='".$_GET['movieId']."' data-username='".$_SESSION['username']."'>"; ?>