<?php 
	$conexion = new mysqli("192.168.56.101","root","roberto123","pru");

	$query = "INSERT INTO hola(id,hola,jaja,que) VALUES (1,'HOLA','JAJA',2) ";
	$conexion -> query($query);
?>