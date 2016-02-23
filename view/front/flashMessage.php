<?php 
	if (isset($_SESSION['flash_messageError'])) {

		echo "<div class='alert alert-danger'>".$_SESSION['flash_messageError']." </div>";
		unset($_SESSION['flash_messageError']);
	}

	if (isset($_SESSION['flash_messageValidate'])) {

		echo "<div class='alert alert-success'>".$_SESSION['flash_messageValidate']." </div>";
		unset($_SESSION['flash_messageValidate']);
	}
 ?>