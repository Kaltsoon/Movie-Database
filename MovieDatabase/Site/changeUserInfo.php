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
					<?php 
						if(isset($_SESSION["username"])){
							include "userInfoForm.php";
						}else{
							include "error.php";
						}
					?>
				</div>
				<div id="rightWrapper">
					<?php include "rightContent.php"; ?>
				</div>
			</div>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>