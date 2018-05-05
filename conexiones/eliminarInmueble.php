<?php
session_start();
if(isset($_SESSION['session'])){
        include('conexionBaseDatos.php');
        $casa=intval($_POST['editar']) ;
        $query = "DELETE FROM inmueble WHERE id_casa=$casa";
        $resultado=$conexion->query($query);  
        mysqli_close($conexion);   
}
	header("Status: 301 Moved Permanently");
	header("Location: http://localhost/baseDatos/segundaCasa.php");
?>