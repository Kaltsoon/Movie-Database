<noscript>
	<div class="no-script-error">
		<article>
			<strong><i class="icon-frown"></i> Kaikki sivuston toiminnallisuus ei ole k&aumltett&aumlviss&auml ilman JavaScripti&auml!</strong>
		</article>
	</div>
</noscript>
<header>
	<?php
		session_start();
		if(isset($_SESSION["username"])){
			include "logoutForm.php";
		}else{
			include "loginForm.php";
		}
	?>	
</header>