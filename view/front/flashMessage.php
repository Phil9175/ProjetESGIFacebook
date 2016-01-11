<?php 
	if (isset($_SESSION['flash_messageError'])) {

		echo "<div class='flash-error'>".$_SESSION['flash_messageError']." </div>";
		unset($_SESSION['flash_messageError']);
	}

	if (isset($_SESSION['flash_messageValidate'])) {

		echo "<div class='flash-validate'>".$_SESSION['flash_messageValidate']." </div>";
		unset($_SESSION['flash_messageValidate']);
	}
 ?>