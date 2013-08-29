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
						<h2>Rekisteröidy</h2>
						<article>
							<form action="registerCheck.php" method="post" id="register">
								<ul class="list">
									<li>
										<b style="display: block; margin-bottom: 10px;">Käyttäjänimi:</b>
										<input type="text" name="username" id="usernameRegister">
									</li>
									<li>
										<b style="display: block; margin-bottom: 10px;">Salasana:</b>
										<input type="password" name="password" id="passwordRegister">
									</li>
									<li>
										<b style="display: block; margin-bottom: 10px;">Salasana uudelleen:</b>
										<input type="password" name="passwordAgain" id="passwordRegisterAgain">
									</li>
								</ul>
								<input type="submit" class="yellow" value="Rekisteröidy" style="margin-top: 10px; margin-left: 0px;">
								</ul>
							</form>
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