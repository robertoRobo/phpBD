<?php
session_start();
if($_SESSION['session']){
	$usuario = $_SESSION['session'];
	include("conexionBaseDatos.php");
	$query = "DELETE FROM persona WHERE id_usuario = '$usuario'";
	echo $query."<br>";
	$results = $conexion ->query($query);
	mysqli_close($conexion);
	session_destroy();
}
	header("Status: 301 Moved Permanently");
	header("Location: http://localhost/baseDatos/segundaCasa.php");
?>