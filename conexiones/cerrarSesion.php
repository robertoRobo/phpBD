<?php 
	session_start();
	if(isset($_SESSION['session'])){
		session_destroy();
	}
	header("Status: 301 Moved Permanently");
	header("Location: http://localhost/baseDatos/segundaCasa.php");
?>