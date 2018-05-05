<?php 
  session_start();
    if(isset($_SESSION['session'])){
		include('conexiones/conexionBaseDatos.php');
		$usuario = $_SESSION['session'];
		$query = "SELECT * FROM persona WHERE id_usuario = '$usuario'";
		$results = $conexion->query($query);
		$rows = $results->fetch_assoc();
		echo "session ".$rows['nombre_completo']."<br>";
		
		mysqli_close($conexion);
	}
	include('conexiones/conexionBaseDatos.php');
	
	$query = "select distinct id_foto, foto.id_casa from foto inner join (SELECT id_casa FROM foto GROUP BY id_casa desc limit 6)as hola";

	$results = $conexion->query($query);
	$temporal = "";
	$foto  = "";
	while ($rows = $results->fetch_assoc()) {
		# code...
		if($temporal != $rows['id_casa']){
			echo "<br>".$rows['id_foto']." ".$rows['id_casa'];
			$temporal = $rows['id_casa'];	
			$qFoto = "SELECT imagen FROM foto WHERE id_foto = '$temporal'";
			#$results2 = $conexion->query($qFoto);
			#$row2 = $results2->fetch_assoc();
			#$foto = $row2['imagen']; 
		}
		
	}	
	echo "<br>";
	mysqli_close($conexion);

	if(isset($_POST['buscar'])){
		$mensualidad = intval($_POST['mensual']);
		$cuartos = intval($_POST['cuartos']);
		$bano = intval($_POST['bano']);
		$telefono = "";
		$gas = "";
		$wifi ="";
		$agua = "";
		$luz = "";
		$aseo = "";
		$mueble = "";
		$cable = "";
		$servicios = array();
		$posicion = 0;
		if (isset($_POST['wifi'])) {
			# code...
			$wifi = intval($_POST['wifi']);
			echo "wifi: ".$wifi;
			$servicios[$posicion] = $wifi;
			$posicion += 1;
		}
		if (isset($_POST['agua'])) {
			$agua = intval($_POST['agua']);
			$servicios[$posicion] = $agua;
			$posicion += 1;
		}
		if (isset($_POST['luz'])) {
			$luz = intval($_POST['luz']);
			$servicios[$posicion] = $luz;
			$posicion += 1;
		}
		if (isset($_POST['aseo'])) {
			$aseo = intval($_POST['aseo']);
			$servicios[$posicion] = $aseo;
			$posicion += 1;
		}
		
		
		if (isset($_POST['telefono'])) {
			$telefono = intval($_POST['telefono']);
			$servicios[$posicion] = $telefono;
			$posicion += 1;
		}
		if (isset($_POST['gas'])) {
			$gas = intval($_POST['gas']);
			$servicios[$posicion] = $gas;
			$posicion += 1;
		}
		print_r($servicios);
		echo "<br>";
		echo "mensualidad: ".$mensualidad."<br>";
		echo "cuartos: ".$cuartos."<br>";
		echo "bano: ".$bano."<br>";

	}	
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mostrar imagenes base datos</title>
</head>
<body>
	<table  border="2">
		<thead>
			<tr>
				<th>id</th>
				<th>nombre</th>
				<th>Foto</th>
			</tr>
		</thead>		
		<tbody>
		<?php 
			include('conexiones/conexionBaseDatos.php');
			$query = "SELECT * FROM foto";

			$results = $conexion->query($query);
			$temporal = "";
			$foto  = "";
			while ($rows = $results->fetch_assoc()) {
				# code...
			?>
			<tr> 			
				<td><?php echo $rows['id_foto']; ?></td>
				<td><?php echo $rows['id_casa']; ?></td>
				<td><img height="450px" width="800px" src="data:image/jpg;base64,<?php echo base64_encode( $rows['imagen']);?>" ></td>	
			</tr>
			<?php
				
			}	
		?>
		</tbody>
	</table>
</body>
</html>