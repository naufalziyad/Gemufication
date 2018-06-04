<?php 
	session_start();
	unset($_SESSION["admin"]);
	unset($_SESSION["guru"]);
	unset($_SESSION["siswa"]);
	session_destroy();
	header("location:../");
?>
