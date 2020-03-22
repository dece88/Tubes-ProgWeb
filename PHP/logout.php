<?php 
	session_start();
	session_destroy();
	
	echo "<script>window.alert(\"Log Out Succes!\")</script>";
	header("Location: home.php");
 ?>
 