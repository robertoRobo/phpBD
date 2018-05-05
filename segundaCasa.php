<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="icon" href="Imagenes/logo.jpg">
        <meta charset="UTF-8">
        <title>Segunda Casa</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="estilos/estilo.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
               
    </head>
    <body style="height:100%">
<!Contenedor barra de navegación>
        <div>
            <div class="row">
                <div class="col-lg-12">
	            <nav class="navbar navbar-static-top" id="barraNav">
		        <div class="navbar-header">
                            <div class="container-fluid">
				<a class="navbar-brand" href="#">
                                    <img alt="" src="Imagenes/logo.jpg" height="66" style="border-radius: 10px">
				</a>
                            </div>
			</div>
                        
			<div class="navbar-right">
                            <div class="container-fluid">
           <?php 
                    session_start();
                    if(isset($_SESSION['session'])){
                        include('conexiones/conexionBaseDatos.php');
                        $usuario = $_SESSION['session'];
                        $query = "SELECT imagen FROM persona WHERE id_usuario = '$usuario'";
                        $result = $conexion->query($query);
                        $row = $result->fetch_assoc();

                ?>
                    <div style="margin-left:-50px;border-radius: 60px;width:50px;">
                                <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $row['imagen']);?>"
                                         style="width:70px;margin-bottom: 2px;margin-top: -4px; position:absolute;border-radius: 60px;height:50px;margin-left:-20px;">
                    </div>
            
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:auto;background:transparent;border:none">
                    <label for="sesionusuario"><?= $_SESSION['session']?></label>
                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="document.getElementById('id04').style.display='block'">Mi Perfil</a></li>
                                    <li><a href="#" onclick="document.getElementById('id05').style.display='block'" >Agregar Inmueble</a></li>
                                    <li><a href="#" onclick="document.getElementById('id07').style.display='block'">Mis Inmuebles</a></li>
                                    <li><a href="conexiones/cerrarSesion.php">Cerrar Sesión</a></li>
                                </ul>


                <?php

                    }else{

                ?>
                    <button type="button" class="btn btn-info collapsed" data-toggle="collapse"
                                onclick="document.getElementById('id01').style.display='block'" style="width:auto;
                                background: transparent;border:none"> Inicia Sesión
                                </button>

                    <button type="button" class="btn btn-success collapsed" data-toggle="collapse" 
                                onclick="document.getElementById('id02').style.display='block'" style="width:auto;
                                background: transparent;border:none">Crear Cuenta
                                </button>
                <?php
                    }
                ?>              
                    
                    </div>      
            </div>
                    </nav>
                </div>
            </div>
        </div>
<!Contenedor carousel>
        <?php
   include('conexiones/conexionBaseDatos.php');
   $query = " SELECT id_foto,id_casa from foto WHERE id_casa=id_casa GROUP BY id_casa desc limit 6";

        $results = $conexion->query($query);
        $temporal = "";
        $foto  = "";
        $contador = 0;
        $fotosA = array();
        $idCasa = array();
        while ($rows = $results->fetch_assoc()) {
            # code...
            $temporal = intval($rows['id_casa']); 
            /*if($temporal != $rows['id_casa']){
                #echo "<br>".$rows['id_foto']." ".$rows['id_casa'];
                $temporal = intval($rows['id_casa']);   
                $id_foto = $rows['id_foto'];
                $qFoto = "SELECT * FROM foto WHERE id_foto = $id_foto";
                
                $results2 = $conexion->query($qFoto);
                $row2 = $results2->fetch_assoc();


                //$foto = $row2['id_foto']; 
                //echo $foto."<br>";
                $idCasa[$contador] = $temporal;
                $fotosA[$contador] = $row2['imagen'];
                $contador +=1;        
            }*/
            $idCasa[$contador] = $temporal;
            $id_foto = $rows['id_foto'];
            $qFoto = "SELECT * FROM foto WHERE id_foto = $id_foto";
            $results2 = $conexion->query($qFoto);
            $row2 = $results2->fetch_assoc();

            $fotosA[$contador] = $row2['imagen'];
            $contador +=1;
        }
?>

    <div  id="carousel2">
            <div class="col-md-12">
                <div class="carousel slide" id="myCarousel">
                    <div class="carousel-inner">
    <?php 
        $tam = count($idCasa);
        for ($i=0; $i <$tam ; $i++) {
            if($i == 0){
                ?>
                <div class="item active">
    <?php
            }else{
                ?>
                <div class="item">
    <?php
            }
            include('conexiones/conexionBaseDatos.php');
            $css = intval($idCasa[$i]);
            $direccion = "SELECT domicilio FROM inmueble WHERE id_casa = $css";
            $resul = $conexion->query($direccion);
            $r = $resul->fetch_assoc();
    ?>
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                                 style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                <a href="#">
                                    <img onclick="hola(<?= $idCasa[$i]?>,'<?= $r['domicilio'] ?>')" src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $fotosA[$i]);?>" 
                                         class="img-responsive" style = " width:100%; height:100%">
                                </a>
                            </div>
                        </div>
<?php
    mysqli_close($conexion);
    }
?>
                    </div>    
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <i class="glyphicon glyphicon-chevron-left" style="color:#FE642E">
                        </i>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <i class="glyphicon glyphicon-chevron-right" style="color:#FE642E">
                        </i>
                    </a>
                </div>
            </div>  
        </div>
    
<script type="text/javascript">
    function hola(idCasa,origen){
        url ="conexiones/resultadosBusqueda.php"
        console.log(idCasa);
        valor = idCasa;
        $.ajax({
        type:"POST",
        url:url,
        data:{nombre:valor},
        success:function(res){
            $("#mostrar_datos").html(res)
            console.log(idCasa);
            console.log(origen);
            document.getElementById('id03').style.display='block';
            mapaUso(origen);
        }
    })
    }
    function mCasa(){
        url ="conexiones/modificaCasa.php";
        //console.log(idCasa);
        /**/
        //alert();
        if ($('input[name=editar]:checked').val()) {
            console.log($('input[name=editar]:checked').val());
            valor = $('input[name=editar]:checked').val();
            $.ajax({
                type:"POST",
                url:url,
                data:{casa:valor},
                success:function(res){
                    $("#modificar").html(res)
                    document.getElementById('id06').style.display='block';
                }
            })

        }
        
    }
</script>
<!Contenedor de barra de rangos e imagenes de resultados>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
<!Filtros para búsquedas>
 <?php
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
        #print_r($servicios);
        #echo "<br>";
        #echo "mensualidad: ".$mensualidad."<br>";
       # echo "cuartos: ".$cuartos."<br>";
        #echo "bano: ".$bano."<br>";
?>
                    <div class="col-md-3 simultaneo" id="filtros" align="center">
                        <form action="segundaCasa.php" method="POST">
                        <div>
                            <br>
                            <p><span class="glyphicon glyphicon-usd"></span></p>
                            <p></p>
                            
                            <div id="slidecontainer">
                                <input type="range" min="1" max="100000" name="mensual" value="<?= $mensualidad ?>" class="slider" id="myRange">
                                    <p>$<span id="demo"></span></p>
                            </div>
                            <br>
                            <p><i class="fa fa-bed"></i></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="cuartos" value="<?= $cuartos ?>" class="slider" id="myRange1">
                                    <p><span id="demo1"></span></p>
                            </div>
                            <br>
                            <p><span>WC</span></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="bano" value="<?= $bano ?>" class="slider" id="myRange2">
                                <p><span id="demo2"></span></p>
                            </div>
                        </div>
                        <div>
                           
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/wifi2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/agua.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/luz.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/telefono.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/aseo.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/gas.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                            <?php 
                            if(isset($_SESSION['session'])){
                                ?>
                                <button type="submit" name="buscar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Buscar</button>
              <button type="submit" name="eliminar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Quitar Filtro</button>
                            <?php
                            }
                            ?>
                            
                        
                            
                        </div></form>
                    </div>
<?php 
    }else if (isset($_POST['eliminar'])) {

?>
     <div class="col-md-3 simultaneo" id="filtros" align="center">
                        <form action="segundaCasa.php" method="POST">
                        <div>
                            <br>
                            <p><span class="glyphicon glyphicon-usd"></span></p>
                            <p></p>
                            
                            <div id="slidecontainer">
                                <input type="range" min="1" max="100000" name="mensual" value="1" class="slider" id="myRange">
                                    <p>$<span id="demo"></span></p>
                            </div>
                            <br>
                            <p><i class="fa fa-bed"></i></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="cuartos" value="1" class="slider" id="myRange1">
                                    <p><span id="demo1"></span></p>
                            </div>
                            <br>
                            <p><span>WC</span></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="bano" value="1" class="slider" id="myRange2">
                                <p><span id="demo2"></span></p>
                            </div>
                        </div>
                        <div>
                           
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/wifi2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/agua.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/luz.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/telefono.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/aseo.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/gas.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                            <?php 
                            if(isset($_SESSION['session'])){
                                ?>
                                <button type="submit" name="buscar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Buscar</button>
              <button type="submit" name="eliminar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Quitar Filtro</button>
                            <?php
                            }
                            ?>
                            
                        </div></form>
                    </div>
<?php
    }else{
        ?>
         <div class="col-md-3 simultaneo" id="filtros" align="center">
                        <form action="segundaCasa.php" method="POST">
                        <div>
                            <br>
                            <p><span class="glyphicon glyphicon-usd"></span></p>
                            <p></p>
                            
                            <div id="slidecontainer">
                                <input type="range" min="1" max="100000" name="mensual" value="1" class="slider" id="myRange">
                                    <p>$<span id="demo"></span></p>
                            </div>
                            <br>
                            <p><i class="fa fa-bed"></i></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="cuartos" value="1" class="slider" id="myRange1">
                                    <p><span id="demo1"></span></p>
                            </div>
                            <br>
                            <p><span>WC</span></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="20" name="bano" value="1" class="slider" id="myRange2">
                                <p><span id="demo2"></span></p>
                            </div>
                        </div>
                        <div>
                           
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/wifi2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/agua.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/luz.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/telefono.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/aseo.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/gas.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                            <?php 
                            if(isset($_SESSION['session'])){
                                ?>
                                <button type="submit" name="buscar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Buscar</button>
              <button type="submit" name="eliminar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Quitar Filtro</button>
                            <?php
                            }
                            ?>
                            
                        </div></form>
                    </div>
<?php
    }
?>
<!Resultado de búsqueda>

 <?php
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
        #print_r($servicios);
        #echo "<br>";
        #echo "mensualidad: ".$mensualidad."<br>";
       # echo "cuartos: ".$cuartos."<br>";
        #echo "bano: ".$bano."<br>";
       
        include('conexiones/conexionBaseDatos.php');

        $filtro = "SELECT * FROM inmueble WHERE costo_mensual <= $mensualidad and num_banos <= $bano and num_habitaciones <= $cuartos ";
        $results = $conexion->query($filtro);
?>
    <div class="container simultaneo">
        <div class="col-md-8">
            
<?php $con  = 1 ;
        while ($row = $results->fetch_assoc()) {
            # code...
           // echo "id_casa ".$row['id_casa'];
            $idU = intval($row['id_casa']);
            $foto = "SELECT imagen FROM foto WHERE id_casa = $idU";
            $res = $conexion -> query($foto);
            $r2 = $res->fetch_assoc();
            if ($con == 1) {
                $con +=1;
                # code...
                ?>
                    <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
        <?php
            }else if($con == 2){
                ?>
                <div class="col-md-3" id="mitad2">
                                <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
                <?php
                $con +=1;
                
            }else if($con == 3){
                ?>
                        <div class="col-md-3" id="mitad2">
                                <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
                <?php
                $con = 1;
            }
        ?>  
            
                        
           
<?php
        }

?>
    </div>
</div>
                        
   
<?php
    }else{
?>
        <div class="container simultaneo">
        <div class="col-md-8">
            
<?php $con  = 1 ;
        include('conexiones/conexionBaseDatos.php');
         
         $filtro = "SELECT * FROM resultados";


        $results = $conexion->query($filtro);
        while ($row = $results->fetch_assoc()) {
            # code...
           // echo "id_casa ".$row['id_casa'];
            $idU = intval($row['id_casa']);
            $foto = "SELECT imagen FROM foto WHERE id_casa = $idU";
            $res = $conexion -> query($foto);
            $r2 = $res->fetch_assoc();
            if ($con == 1) {
                $con +=1;
                # code...
                ?>
                    <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
        <?php
            }else if($con == 2){
                ?>
                <div class="col-md-3" id="mitad2">
                                <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
                <?php
                $con +=1;
                
            }else if($con == 3){
                ?>
                        <div class="col-md-3" id="mitad2">
                                <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="hola(<?= $row['id_casa'] ?>,'<?= $row['domicilio'] ?>')" style="width:auto;">
                                    <img src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $r2['imagen']);?>" alt="El tito"></button>
                            </div>
                        </div>
                <?php
                $con = 1;
            }
        ?>  
            
                        
           
<?php
        }

?>
    </div>
</div>

<?php
    }
?>
                    
                    <!--<div class="container col-md-8 simultaneo">
                        <div>
                        <div class="col-md-6">
                            <div>
                                <h2><u>Publicaciones activas</u></h2>
                            </div>
                        </div>
                        <div class="col-md-6" style="color:transparent">
                            <h2><u>Publicaciones activas</u></h2>
                        </div>
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img  alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div> 
                        </div>
                        <div>
                            <div class="col-md-6">
                            <div>
                                <h2><u>Publicaciones inactivas</u></h2>
                            </div>
                        </div>
                        <div class="col-md-6" style="color:transparent">
                            <h2><u>Publicaciones inactivas</u></h2>
                        </div>
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img  alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad3">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        </div>
                    </div>-->
                    </div>
            </div>
<!Modal Iniciar Sesión>
<div id="id01" class="modal">
    <form class="modal-content animate" method="POST" action="conexiones/iniciarSesion.php">
        <div class="imgcontainer modal-header">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="https://vignette3.wikia.nocookie.net/tumblr-survivor-athena/images/7/7a/Blank_Avatar.png/revision/latest?cb=20161204161729" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label><b>Usuario</b></label><p></p>
            <input type="text" maxlength="25" placeholder="Ingresa tu nombre de usuario o email" name="uname" required class="informacion">
            <p></p>
            <label><b>Contraseña</b></label><p></p>
            <input type="password" maxlength="25" placeholder="Ingresa tu contraseña" name="psw" required class='informacion'>
            <p></p>
            <button type="submit" style=" background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 56.5%;">Iniciar
            </button>
            <p></p>
            <div class="container" style="width:50%;float:left">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" style="float:right;
                        background-color:#DF0174;color:white;border-radius: 10px" >Cancelar
                </button>
                



            </div>
        </div>
    </form>
</div>
<!Script cerrar modal inicio de sesión>
<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};
</script>
<!Script carousel publicaciones recientes>
<script>
    $('#myCarousel').carousel({
  interval: 40000
});

$('.carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  if (next.next().length>0) {
 
      next.next().children(':first-child').clone().appendTo($(this)).addClass('rightest');
      
  }
  else {
      $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
     
  }
});
</script>
<!Script Sliders>
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
};
</script>
<script>
var slider1 = document.getElementById("myRange1");
var output1 = document.getElementById("demo1");
output1.innerHTML = slider1.value;

slider1.oninput = function() {
  output1.innerHTML = this.value;
};
</script>
<script>
var slider2 = document.getElementById("myRange2");
var output2 = document.getElementById("demo2");
output2.innerHTML = slider2.value;

slider2.oninput = function() {
  output2.innerHTML = this.value;
};
</script>
<!Modal Registro>
<div id="id02" class="modal">
    <form class="modal-content animate" method="POST" action="conexiones/registroUsuario.php" enctype="multipart/form-data">
        <div class="modal-header">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
            <h4 class="modal-titulo">Registro</h4>
        </div>
        <div class="container">
            <label><b>Nombre de Usuario</b></label><p></p>
            <input type="text" placeholder="Ingresa un nombre de usuario" name="unombre" required maxlength="25" class="informacion">
            <p></p>
            <label><b>Correo Electrónico</b></label><p></p>
            <input type="email" placeholder="ejemplo@hotmail.com" name="email" required maxlength="100" class="informacion">
            <p></p>
            <label><b>Nombre Completo</b></label><p></p>
            <input type="text" placeholder="Ingresa tu nombre completo" name="nombre" required maxlength="25" class="informacion">
            <p></p>
            <label><b>Teléfono</b></label>
            <input type="tel" placeholder="91234567" name="tel" maxlength="16"><label style="width:200px"></label>
            <label><b>Celular</b></label>
            <input type="tel" placeholder="4491234567" name="cel" required maxlength="16">
            <p></p>
            <label><b>Universidad</b></label><p></p>
            <select name="universidad">
                <option value="uaa">Universidad Autónoma de Aguascalientes</option>
                <option value="ita">Instituto Técnológico de Aguascalientes</option>
                <option value="uta">Universidad Técnológica de Aguascalientes</option>
                <option value="upa">Universidad Politécnica de Aguascalientes</option>
            </select><p></p>
            <label><b>Contraseña</b></label><p></p>
            <input type="password" placeholder="Ingresa una contraseña" name="psw" required maxlength="25" class="informacion">
            <p></p>
            <label><b>Foto de perfil</b></label>
            <input type="file" name="fotoG"/>
            <button type="submit" style=" background-color: #FA58F4;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 56.5%;">Crear cuenta</button>
                <p></p>
            <div class="container file1">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn" style="float:right;
                         background-color: #DF0174;color:white;border-radius: 10px">Cancelar</button>
            </div>
        </div> 
    </form>
</div>
<!Modal Información de casa>

<div id="mostrar_datos"></div>

<!Script cerrar informacion de casa>
<script>
var modal = document.getElementById('id03');
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
   
};
</script>
<!Scripts carousel imagenes de inmueble>
<script>
  jQuery(document).ready(function($) {
 
        $('#myCarousel2').carousel({
                interval: 5000
        });
 
        $('#carousel-text').html($('#slide-content-0').html());
 
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel2').carousel(id);
        });
});
</script>
<script>
  jQuery(document).ready(function($) {
 
        $('#myCarousel2').carousel({
                interval: 5000
        });
 
        $('#carousel-text').html($('#slide-content-0').html());
 
        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel2').carousel(id);
        });
});
</script>
<!Script mapa>
<script>
function myMap() {
var mapProp= {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap">
    
</script>
<!Modal editar perfil>
<?php 
    if(isset($_SESSION['session'])) {
        include('conexiones/conexionBaseDatos.php');
        $usuario = $_SESSION['session'];
        $query = "SELECT * FROM persona WHERE id_usuario = '$usuario'";
        $results = $conexion->query($query);
        $rows = $results->fetch_assoc();
        mysqli_close($conexion);
?>
        
    <div id="id04" class="modal">
    <form class="modal-content animate" method="POST" action="conexiones/configuracionPerfil.php" enctype="multipart/form-data">
        <div class="modal-titulo modal-header">
            <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
            <label class="titulo">Mi Perfil <?= $rows['nombre_completo'] ?></label>
        </div>
        <div class="container">
            <label><b>Nombre de Usuario</b></label><p></p>
            <input type="text" name="unombre" value="<?= $rows['id_usuario']?>"  required maxlength="25" class="informacion">
            <p></p>
            <label><b>Correo Electrónico</b></label><p></p>
            <input type="email" name="email" value="<?= $rows['correo'] ?>" required maxlength="100" class="informacion">
            <p></p>
            <label><b>Nombre Completo</b></label><p></p>
            <input type="text" name="nombre" value="<?= $rows['nombre_completo'] ?>"  required maxlength="100" size="100" class="informacion"></input>
            <p></p>
            <label><b>Teléfono</b></label><p></p>
            <input type="tel"  name="tel" value="<?= $rows['telefono'] ?>" maxlength="16" class="informacion">
            <p></p>
            <label><b>Celular</b></label><p></p>
            <input type="tel" name="cel" value="<?= $rows['celular'] ?>" required maxlength="16" class="informacion">
            <p></p>
            <label><b>Universidad</b></label><p></p>
            <select name="universidad">
            <?php
                if($rows['nombre_universidad'] == "uaa"){
            ?>
                <option value="uaa" selected>Universidad Autónoma de Aguascalientes</option>
                <option value="ita">Instituto Técnológico de Aguascalientes</option>
                <option value="uta">Universidad Técnológica de Aguascalientes</option>
                <option value="upa">Universidad Politécnica de Aguascalientes</option>  
            <?php
                }
            ?>
            <?php
                if($rows['nombre_universidad'] == "ita"){
            ?>
                <option value="uaa" >Universidad Autónoma de Aguascalientes</option>
                <option value="ita" selected>Instituto Técnológico de Aguascalientes</option>
                <option value="uta">Universidad Técnológica de Aguascalientes</option>
                <option value="upa">Universidad Politécnica de Aguascalientes</option>  
            <?php
                }
            ?>
            <?php
                if($rows['nombre_universidad'] == "uta"){
            ?>
                <option value="uaa">Universidad Autónoma de Aguascalientes</option>
                <option value="ita">Instituto Técnológico de Aguascalientes</option>
                <option value="uta" selected>Universidad Técnológica de Aguascalientes</option>
                <option value="upa">Universidad Politécnica de Aguascalientes</option>  
            <?php
                }
            ?>
            <?php
                if($rows['nombre_universidad'] == "upa"){
            ?>
                <option value="uaa" >Universidad Autónoma de Aguascalientes</option>
                <option value="ita">Instituto Técnológico de Aguascalientes</option>
                <option value="uta">Universidad Técnológica de Aguascalientes</option>
                <option value="upa" selected>Universidad Politécnica de Aguascalientes</option>  
            <?php
                }

            ?>
              

            </select><p></p>
            <label><b>Foto de perfil</b></label>
            <input type="file" name="fotoG" />
            <p></p>
            <button type="submit" style=" background-color: #FA58F4;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 56.5%;">Guardar Cambios</button>
                <p></p>
             </form>
            <form  method="POST" action="conexiones/eliminarUsuario.php" >
            <div class="container" style="width:50%;float:left;">
            
                <button type="submit" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn"  style=" background-color: #DF0174;color:white;border-radius: 10px;">Eliminar Cuenta</button>
            
              

            <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;float:right">Cancelar</button>
            
            </div>
            </form>
        </div>
   
</div>
<?php
    }      
?>
<!Script cerrar modal registro>
<script>
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
   
};
</script>
<!Script cerrar modal mi perfil>
<script>
var modal = document.getElementById('id04');
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    } 
};
</script>
<!Script seleccionar servicio>
<script type="text/javascript">
    
    
    


   $(document).ready(function(e){
    		$(".img-check").click(function(){
				$(this).toggleClass("check");
			});
	});
</script>
<!Modal Agregar inmueble>
<div id="id05" class="modal">
   <div class="modal-content">
          <div class="modal-header">
              <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
              <h4 class="modal-titulo">Agregar inmueble</h4>
          </div>

        <div class="modal-body">
            <div class="row">
                <form  method="POST" action="conexiones/registroCasa.php" enctype="multipart/form-data">
                
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <label><b>Agrega un título</b></label><p></p>
                    <input type="text" name="titulo" required maxlength="250" id="inmueble">
                </div>
                
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <label><b>Agrega el costo MXN</b></label><p></p>
                    <input type="number" name="costo" required id="inmueble">
                </div>
                <div class="col-md-1"></div>
               
                <div class="col-md-12">
                    <br>
                    <label><b>Ingresa la dirección del inmueble completa</b></label><p></p>
                    <input type="text" name="inmueble" id="inmueble" maxlength="100" required style="width:100%">
                </div>
                <div class="col-md-12">
                    <br>
                    <label> Selecciona los servicios con los que cuenta tu inmueble</label>
                </div>
                <div class="col-md-10">
                           
                                <div class="row">
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/wifi2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/agua.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/luz.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                                
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/aseo.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2" style="margin-top: 11px">
                                    <img src="Imagenes/bano.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px
                                         ;background-color:transparent;border-color: transparent">
                                    <input type="checkbox" class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" name="bano" min="1" style="width:40px;margin-top: 25px;margin-left: -15px">
                                </div>
                                </div>
                                <div class="row">
                            <div class="col-md-2" style="">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/telefono.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/gas.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                                    <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/sillon.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="mueble" value="6" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/cable.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="cable" value="5" class="hidden">
                                </label>
                                </div>
                                    <div class="col-md-2" style="margin-top: 11px">
                                    <img src="Imagenes/cuarto.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px
                                         ;background-color:transparent;border-color: transparent">
                                    <input type="checkbox"  class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" name="cuarto" value="cuarto" min="1" style="width:40px;margin-top: 25px;margin-left: -15px">                          
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <br>
                    <label> Agrega una descripción a tu inmuble</label>
                    <input type="text" id="descripcion" name="descripcion" maxlength="2000">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <label> Haz más atractivo tu anuncio con fotografías<span style="color:black"> (no mas de 6)</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" id="imagenes"  name="imagenes[]" multiple/>
                                        </div>
                                    <div class="col-md-2"></div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-8" style="float:right">
                                        
                                        <button type="submit" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Publicar</button>
              <button type="button" onclick="document.getElementById('id05').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Cancelar</button>
                                    </div>
                                    
                                    
                                </div>
                            </form>
                </div>
            </div>
        </div>
   </div>
</div>
<!Modal Modificar inmueble>


<div id="modificar"></div>





<div id="id07" class="modal" >
    <form class="modal-content animate" method="POST" action="conexiones/eliminarInmueble.php" style="width:50%">
        <div class="modal-header">
            <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">&times;</span>
            <h4 class="modal-titulo">Mis inmuebles</h4>
        </div>
        <div class="container">
<?php
    //session_start();
    if(isset($_SESSION['session'])){
        include('conexiones/conexionBaseDatos.php');
        $usuario=$_SESSION['session'];

        $query = "call misCasas('$usuario')";

$resultado=$conexion->query($query);  
$temporal = "";
        $foto  = "";
        $contador = 0;
        $fotosA = array();
        $idCasa = array();
        while ($rows = $resultado->fetch_assoc()) {
            # code...
            if($temporal != $rows['id_casa']){
                #echo "<br>".$rows['id_foto']." ".$rows['id_casa'];
                $temporal = $rows['id_casa'];   
                //$id_foto = $rows['imagen'];
                $contador+=1;
                ?>
                <div class="row">
                <div class="col-md-6">
                <div class="col-md-2">
                    <label><img onclick="hola(<?= $temporal?>,'<?= $rows['domicilio'] ?>'),document.getElementById('id07').style.display='none'" src="data:image/jpg;image/x-png;image/gif;image/jpeg;base64,<?php echo base64_encode( $rows['imagen']);?>"
                                         style="width:50px;height:50px;border-radius: 60px">
                    </label>
                </div>
                <div class="col-md-4">
                    <label><?=$rows['domicilio'] ?></label>
                </div>
                </div>
                <div class="col-md-6">
                    <input type="radio" name="editar" value="<?= $rows['id_casa']?>">
                </div>
            </div>        
                <?php
                //$foto = $row2['id_foto']; 
                //echo $foto."<br>";
            }
        }
        

    }    
?>
            
            


            <div class="row">
                                        <br>
                                        <div class="col-md-4">
                                            <button type="submit"  class="cancelbtn" style="background-color:#DF0174
              ;color:white;border-radius: 10px">Eliminar Inmueble</button>
                                        </div>
                                        <div class="col-md-4" style="float:left">
                                        <button type="button" onclick="mCasa(1),document.getElementById('id07').style.display='none'"  class="cancelbtn" style="background-color:#DF0174
              ;color:white;border-radius: 10px">Modificar inmueble</button>
              
                                    </div>
              
                                    </div>
                                    </div>
        </form>
</div>
            
           
        
    
<!Script crecer div simultaneamente>
<script>
    var maxHeight = 0;

$('div.simultaneo').each(function(index){
if ($(this).height() > maxHeight)
{
maxHeight = $(this).height();
}
});
$('div.simultaneo').height(maxHeight);
</script>
<!Footer>
<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="copyright">

					© 2017, Tito's Company, Todos los derechos reservados
				</div>

			</div>

		</div>
        </div>
</div>
    </body>
</form>
</div>
</div>
</div>
</div>
</form>
</div>
<script type="text/javascript">
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 21.88234, lng: -102.28259},
          zoom: 10,
          disableDefaultUI: true,
          zoomControl: true,
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });
      }

function mapaUso(origin){
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var geocoder = new google.maps.Geocoder;
        var service = new google.maps.DistanceMatrixService;

        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = origin;//'aguascalientes mexico pintores mexicanos juan soriano 558';
        var destinationA = 'aguascalientes universidad autonoma de aguascalientes';
        //var origin1 = document.getElementById('origen').value;
        //var destinationA = document.getElementById('destino').value;

        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';

        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 21.88234, lng: -102.28259},
          zoom: 10,
          disableDefaultUI: true,
          zoomControl: true
        });

        directionsDisplay.setMap(map);

        directionsService.route({
          origin: origin1,
          destination: destinationA,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });

        service.getDistanceMatrix({
          origins: [origin1],
          destinations: [destinationA],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status) {
          if (status !== 'OK') {
            alert('Error was: ' + status);
          } else {
            
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;

            //var outputDiv = document.getElementById('output');
            //outputDiv.innerHTML = '';

            deleteMarkers(markersArray);

            var showGeocodedAddressOnMap = function(asDestination) {
              var icon = asDestination ? destinationIcon : originIcon;
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  markersArray.push(new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                  }));
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };

            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
              //geocoder.geocode({'address': originList[i]},showGeocodedAddressOnMap(false));
              //geocoder.geocode({'address': originList[i]},showGeocodedAddressOnMap(false));
              
              for (var j = 0; j < results.length; j++) {
                //geocoder.geocode({'address': destinationList[j]},showGeocodedAddressOnMap(false));
                //geocoder.geocode({'address': destinationList[j]},showGeocodedAddressOnMap(true));
                //outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
                  //  ': ' + results[j].distance.text + ' in ' +
                    //results[j].duration.text + '<br>';
                var label = document.getElementById('distancia');
                label.innerHTML = "";
                label.innerHTML += "Distancia a la Universidad: "+results[j].distance.text;
              }
            }
          }
        });

      }

      function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }
      

</script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-FmCTFXtkEmklRzkboSe3gOUx49tGQfQ&callback=mapaUso">
    </script>
</body>
</html>