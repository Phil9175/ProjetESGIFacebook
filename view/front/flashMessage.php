<?php 
	if (isset($_SESSION['flash_message'])) {

		echo "<div class='flash-error'>".$_SESSION['flash_message']." </div>";
		unset($_SESSION['flash_message']);
	}
 ?>