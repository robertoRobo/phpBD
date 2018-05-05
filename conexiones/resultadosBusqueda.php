<?php 
		session_start();
 		
    $id = intval($_POST['nombre']);
    include('conexionBaseDatos.php');
    $query = "SELECT * FROM inmueble WHERE id_casa = $id";
    $results = $conexion->query($query);
    $row = $results->fetch_assoc();
?>	 
		<div id="id03" class="modal">

    <form class="modal-content2 animate" action="/action_page.php">
        <div class="modal-titulo">
            <span onclick="document.getElementById('id03').style.display='none'" class="close1" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <div id="main_area">
                <div class="row">
                    <div class="col-xs-12" id="slider">
                        <div class="row">
<!Parte superior carousel>
	<div class="col-md-8 col-lg-8" id="carousel-bounding-box">
		<div class="carousel slide" id="myCarousel2">
			<div class="carousel-inner">
<?php  
	$qfoto = "SELECT imagen FROM foto WHERE id_casa = $id";
	$res = $conexion->query($qfoto);
	$con = 0;
	while ($rowF = $res->fetch_assoc()) {
		# code...
		if($con == 0){

			?>
			<div class="active item" data-slide-number="$con">
				<img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $rowF['imagen']);?>" style="height:400px;width:800px"></div>
                	
	<?php
		$con +=1;
		}else{
	?>
		<div class="item" data-slide-number="$con">
                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $rowF['imagen']);?>"  
                        style="height:400px;width:800px">
         </div>

<?php

		}
		$con +=1;

	}
?>
                            
                            <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>                                       
                            </a>
                            <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>                                       
                            </a> 

                        </div>
                    </div>
             </div>
<!Informacion general de la casa>
                            <div class="container">
                                <div class="col-md-3 col-lg-3">
                                    <label style="color:white;" for="titulo"><font size="6"><?= $row['titulo'] ?></font></label>
                                    <br>
                                    <label style="color:white" for="descripcion"> <?= $row['descripcion'] ?> </label>
                                    <label style="color:blue" for="domicilio"> <?= $row['domicilio'] ?> </label>
                                    <hr style="color:#DF0174;">
                                    <p><span class="glyphicon glyphicon-usd" style="font-size: 30px"></span><label style="color:white;font-size: 25px" for="precio"><?= $row['costo_mensual'] ?> MXN</label></p>
                                    <p><i class="fa fa-bed" style="color:#DF0174"></i><label for="cuartos"> X<?= $row['num_habitaciones']?></label><i class="fa fa-wifi" style="margin-left: 62px;color:#DF0174"></i><label for="internet"> X<?= $row['num_banos']?></label></p> 

                                    <table>
<?php
			$query="SELECT servicios.descripcion FROM servicios, cuenta_con WHERE id_casa=$id and id_casa=cuenta_con.id_casa and cuenta_con.id_servicio=servicios.id_servicio";
			$res = $conexion->query($query);
			$pares = 1;
			while ($reng = $res->fetch_assoc()) {
				# code...
					if($pares == 1){
						?>
						<tr>
						<?php
					}
				?>
						
                    		<td><img src="Imagenes/<?= $reng['descripcion'] ?>.png" style="width: 15px;height:15px;" ><label><?= $reng['descripcion'] ?></label> </td>
                    		<td style="width:70px;"></td>
                    		
                    	

				<?php

				if($pares == 2){
					$pares = 0;
					?>
						</tr>
					<?php
				}
				$pares +=1;

			}


?>
                                    	
                                    	
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1"></div>
                    </div>
                </div>
<!Parte inferior carousel Imagenes casa>

                <div class="row hidden-xs" id="slider-thumbs" style="width: 70%">

                    <ul class="hide-bullets">

<?php
	$qfoto = "SELECT imagen FROM foto WHERE id_casa = $id";
	$res = $conexion->query($qfoto);
	$con = 0;	
	while ($rowF = $res->fetch_assoc()) {
?>
		<li class="col-md-1" style="width:3cm">
                            <a class="thumbnail" id="carousel-selector-0">
                                <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $rowF['imagen']);?>" style="height:45px;width:150px">
                            </a>
                        </li>
<?php
	}
?>

                    </ul> 


                </div>
            </div>
        <div class="row">
            <div class="col-md-8">
                <div id="map" style="height:400px;width:675px">
                </div>
                <label id="distancia"></label>
            </div>
<!Información Arrendatario>
            <div class="container">
                <div class="col-md-3">
 <?php
 		$persona = "SELECT nombre_completo,telefono,correo FROM inmueble,persona WHERE id_casa = $id AND inmueble.id_usuario = persona.id_usuario ";
 		$res  = $conexion->query($persona);
 		$datos = $res->fetch_assoc();
	
 		
 		if (isset($_SESSION['session'])) {
 			# code...
 			?>
 			<input type="text" style=" color:#DF0174;border-radius:10px;width:255px" 
                            placeholder="tito y los dinosaurios" value="<?= $datos['nombre_completo'] ?>" disabled="disabled">
                    <br>
                    <input type="email" style="color:#DF0174;border-radius:10px;width:255px" 
                           placeholder="Correo: ejemplo@hotmail.com" value="<?= $datos['correo'] ?>" disabled="disabled">
                    <input type="tel" style="color:#DF0174;border-radius:10px;width:255px" 
                            placeholder="Correo: 4491234567" value="<?= $datos['telefono'] ?>" disabled="disabled">
                    

 		<?php
 		}
 ?>
                    

                </div>
            </div>


        </div>
        <div class="container" style="width:90%;float:left">
            <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Cancelar</button>
        </div>
        </div>
      
    </form>

</div>

    
<?php 
    mysqli_close($conexion);
?>