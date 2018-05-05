<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Documento</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                                    <img alt="Logo mi segunda casa" src="#" height="66">
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
                                         style="width:70px;margin-bottom: 2px;margin-top: -4px; position:absolute;border-radius: 60px;">
                    </div>
            
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:auto;background:transparent;border:none">
                    <label for="sesionusuario"><?= $_SESSION['session']?></label>
                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="document.getElementById('id04').style.display='block'">Mi Perfil</a></li>
                                    <li><a href="#" onclick="document.getElementById('id05').style.display='block'" >Agregar Inmueble</a></li>
                                    <li><a href="#">Modificar Inmuebles</a></li>
                                    <li><a href="conexiones/cerrarSesion.php">Cerrar Session</a></li>
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
   $query = "select distinct id_foto, foto.id_casa from foto inner join (SELECT id_casa FROM foto GROUP BY id_casa desc limit 6)as hola";

        $results = $conexion->query($query);
        $temporal = "";
        $foto  = "";
        $contador = 0;
        $fotosA = array();
        $idCasa = array();
        while ($rows = $results->fetch_assoc()) {
            # code...
            if($temporal != $rows['id_casa']){
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
            }
        }
?>

    <div  id="carousel2">
            <div class="col-md-12">
                <div class="carousel slide" id="myCarousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                    <img onclick="hola(<?= $idCasa[0] ?>)"  src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" 
                                         class="img-responsive" style = " width: 100%; height:100%">
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                                 style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                <a href="#">
                                    <img onclick="hola(1)" src="http://dreamicus.com/data/wall/wall-06.jpg" 
                                         class="img-responsive" style = " width:100%; height:100%">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                                 style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                <a href="#">
                                    <img onclick="hola(2)" src="https://blog.oxforddictionaries.com/wp-content/uploads/wall.jpg" 
                                         class="img-responsive" style = " width:100%; height:100%">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                                 style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                <a href="#">
                                    <img onclick="hola(3)" src="https://static.pexels.com/photos/93417/pexels-photo-93417.jpeg" 
                                         class="img-responsive" style=" width:100%; height:100%">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                        <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                             style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                            <a href="#">
                                <img onclick="hola(4)" src="http://i2.cdn.turner.com/money/dam/assets/170407104458-border-wall-concrete-780x439.jpg" 
                                     class="img-responsive" style=" width:100%; height:100%">
                            </a>
                        </div>
                        </div>
                        <div class="item">
                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" 
                                 style="border-style: solid;color:#FE642E;border-width: 5px;width:445px;height:410px"">
                                <a href="#">
                                    <img onclick="hola(5)" src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" 
                                         class="img-responsive" style=:" width:100%; height:100%;">
                                </a>
                            </div>
                        </div>
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
    function hola(idCasa){
        url ="conexiones/resultadosBusqueda.php"
        console.log(idCasa);
        valor = idCasa;
        $.ajax({
        type:"POST",
        url:url,
        data:{nombre:valor},
        success:function(res){
            $("#mostrar_datos").html(res)
            
            //console.log(res);
            document.getElementById('id03').style.display='block';
        }
    })
    }
</script>
<!Contenedor de barra de rangos e imagenes de resultados>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
<!Filtros para búsquedas>
                    <div class="col-md-3 simultaneo" id="filtros" align="center">
                        <form action="casas.php" method="POST">
                            <div>
                            <br>
                            <p><span class="glyphicon glyphicon-usd"></span></p>
                            <p></p>
                            
                            <div id="slidecontainer">
                                <input type="range" min="1" max="5000" name="mensual" value="1" class="slider" id="myRange">
                                    <p>$<span id="demo"></span></p>
                            </div>
                            <br>
                            <p><i class="fa fa-bed"></i></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="10" name="cuartos" value="1" class="slider" id="myRange1">
                                    <p><span id="demo1"></span></p>
                            </div>
                            <br>
                            <p><span>WC</span></p>
                            <p></p>
                            <div id="slidecontainer">
                                <input type="range" min="1" max="10" name="bano" value="1" class="slider" id="myRange2">
                                <p><span id="demo2"></span></p>
                            </div>
                        </div>
                        <div>
                           
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="http://simpleicon.com/wp-content/uploads/wifi-symbol-2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://www.shareicon.net/data/256x256/2016/03/30/741986_drop_512x512.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://openclipart.org/image/2400px/svg_to_png/185270/Light-Bulb-Icon.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://image.freepik.com/free-icon/pawprint-in-a-circle-of-pet-hotel-sign_318-51334.jpg"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/1153141-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/3688-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                            <button type="submit" name="buscar" class="cancelbtn" style="
              background-color: #DF0174;color:white;border-radius: 10px;"> Buscar</button>
                        </form>
                            
                        </div>
                    </div>
<!Resultado de búsqueda>
<?php
    if(isset($_POST['buscar'])){
?>
    <div class="container simultaneo">
                        <div class="col-md-8">
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
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
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        </div>
                    </div>
<?php
    }else{
?>
    <div class="container simultaneo">
                        <div class="col-md-8">
                        <div class="col-md-3" id="mitad">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
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
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
                        <div class="col-md-3" id="mitad2">
                            <div>
                                <button id="close-image" data-toggle="collapse"
                                        onclick="document.getElementById('id03').style.display='block'" style="width:auto;">
                                    <img src="http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4249.png" alt="El tito"></button>
                            </div>
                        </div>
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
            <input type="text" placeholder="Ingresa tu nombre de usuario o email" name="uname" required class="informacion">
            <p></p>
            <label><b>Contraseña</b></label><p></p>
            <input type="password" placeholder="Ingresa tu contraseña" name="psw" required class='informacion'>
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
                <span class="psw" style="color:white">¿Olvidaste tu <a href="#">contraseña?</a></span>
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
            <input type="text" placeholder="Ingresa un nombre de usuario" name="unombre" required size="25" class="informacion">
            <p></p>
            <label><b>Correo Electrónico</b></label><p></p>
            <input type="email" placeholder="ejemplo@hotmail.com" name="email" required size="25" class="informacion">
            <p></p>
            <label><b>Nombre Completo</b></label><p></p>
            <input type="text" placeholder="Ingresa tu nombre completo" name="nombre" required size="100" class="informacion">
            <p></p>
            <label><b>Teléfono</b></label>
            <input type="tel" placeholder="91234567" name="tel" size="12"><label style="width:200px"></label>
            <label><b>Celular</b></label>
            <input type="tel" placeholder="4491234567" name="cel" required size="12">
            <p></p>
            <label><b>Universidad</b></label><p></p>
            <select name="universidad">
                <option value="uaa">Universidad Autónoma de Aguascalientes</option>
                <option value="ita">Instituto Técnológico de Aguascalientes</option>
                <option value="uta">Universidad Técnológica de Aguascalientes</option>
                <option value="upa">Universidad Politécnica de Aguascalientes</option>
            </select><p></p>
            <label><b>Contraseña</b></label><p></p>
            <input type="password" placeholder="Ingresa una contraseña" name="psw" required size="25" class="informacion">
            <p></p>
            <label><b>Repite Contraseña</b></label><p></p>
            <input type="password" placeholder="Repite la contraseña" name="psw2" required size="25" class="informacion">
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
                                        <div class="active item" data-slide-number="0">
                                            <img src="https://lastfm-img2.akamaized.net/i/u/770x0/60c12c736c0e6c8d3c373d43654cccfe.jpg" style="height:400px;width:800px"></div>
                                            <div class="item" data-slide-number="1">
                                                <img src="http://madafackismounderground.com/wp-content/uploads/2017/06/edd5df6f-41e1-4973-8f2d-d1121b68d213.jpg" 
                                                    style="height:400px;width:800px">
                                            </div>
                                        <div class="item" data-slide-number="2">
                                            <img src="http://www.billboard.com/files/media/Dua-Lipa-bb6-6auwh-beat-2017-billboard-1548.jpg" 
                                                 style="height:400px;width:800px">
                                        </div>
                                        <div class="item" data-slide-number="3">
                                            <img src="http://www.officialcharts.com/media/652286/dua-lipa-press-1100.jpg?width=796&mode=stretch" 
                                                 style="height:400px;width:800px">
                                        </div>
                                        <div class="item" data-slide-number="4">
                                        <img src="http://ksassets.timeincuk.net/wp/uploads/sites/55/2017/05/2017_DuaLipa1_ZoeMcConnell_170517.jpg" 
                                             style="height:400px;width:800px">
                                        </div>
                                        <div class="item" data-slide-number="5">
                                            <img src="https://ichef.bbci.co.uk/images/ic/960x540/p05341jk.jpg" 
                                                 style="height:400px;width:800px">
                                        </div>
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
                                    <label style="color:white;" for="titulo"><font size="6">Viéndole don Quijote</font></label>
                                    <br>
                                    <label style="color:white" for="descripcion">When I think of my wife, I always think of the back of her head. I picture cracking her lovely skull, 
                                    unspooling her brain, trying to get answers. The primal questions of a marriage: What are you thinking? How are you feeling? What have we done 
                                    to each other? What will we do?</label>
                                    <hr style="color:#DF0174;">
                                    <p><span class="glyphicon glyphicon-usd" style="font-size: 30px"></span><label style="color:white;font-size: 25px" for="precio">7,500.00 MXN</label></p>
                                    <p><i class="fa fa-bed" style="color:#DF0174"></i><label for="cuartos"> X3</label><i class="fa fa-wifi" style="margin-left: 62px;color:#DF0174"></i><label for="internet"> X3</label></p> 
                                    <p><i class="fa fa-cloud" style="color:#DF0174"></i><label for="aseo"> 1 semana</label><i class="fa fa-bars" style="margin-left: 20px;color:#DF0174"></i><label for="agua"> 1 semana</label></p> 
                                    <p><i class="fa fa-car" style="color:#DF0174"></i><label for="baños"> X3</label><i class="fa fa-heart" style="margin-left: 62px;color:#DF0174"></i><label for="luz"> X3</label></p>
                                    <button style="background-color:#DF0174;color:white;border-radius: 10px" type="button" class="btn btn-sucess"> 
                                    Contactar anunciante</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1"></div>
                    </div>
                </div>
<!Parte inferior carousel Imagenes casa>
                <div class="row hidden-xs" id="slider-thumbs" style="width: 70%">
                    <ul class="hide-bullets">
                        <li class="col-md-1" style="width:3cm">
                            <a class="thumbnail" id="carousel-selector-0">
                                <img src="https://lastfm-img2.akamaized.net/i/u/770x0/60c12c736c0e6c8d3c373d43654cccfe.jpg" style="height:45px;width:150px">
                            </a>
                        </li>
                        <li class="col-md-1" style="width:3cm;">
                            <a class="thumbnail" id="carousel-selector-1">
                                <img src="http://madafackismounderground.com/wp-content/uploads/2017/06/edd5df6f-41e1-4973-8f2d-d1121b68d213.jpg" 
                                          style="height:45px;width:150px">
                            </a>
                        </li>
                            <li class="col-md-1" style="width:3cm;">
                                <a class="thumbnail" id="carousel-selector-2">
                                    <img src="http://www.billboard.com/files/media/Dua-Lipa-bb6-6auwh-beat-2017-billboard-1548.jpg"
                                         style="height:45px;width:150px"></a>
                            </li>
                            <li class="col-md-1" style="width:3cm">
                                <a class="thumbnail" id="carousel-selector-3">
                                    <img src="http://www.officialcharts.com/media/652286/dua-lipa-press-1100.jpg?width=796&mode=stretch"
                                         style="height:45px;width:150px"></a>
                            </li>
                            <li class="col-md-1" style="width:3cm">
                                <a class="thumbnail" id="carousel-selector-4">
                                    <img src="http://ksassets.timeincuk.net/wp/uploads/sites/55/2017/05/2017_DuaLipa1_ZoeMcConnell_170517.jpg"
                                         style="height:45px;width:150px"></a>
                            </li>
                            <li class="col-md-1" style="width:3cm">
                                <a class="thumbnail" id="carousel-selector-5"><img src="https://ichef.bbci.co.uk/images/ic/960x540/p05341jk.jpg"
                                 style="height:45px;width:150px"></a>
                            </li>
                    </ul>                 
                </div>
            </div>
        <div class="row">
            <div class="col-md-8">
                <div id="googleMap" style="height:400px;width:675px">
                </div>
            </div>
<!Información Arrendatario>
            <div class="container">
                <div class="col-md-3">
                    <input type="text" style=" color:#DF0174;border-radius:10px;width:255px" 
                            placeholder="tito y los dinosaurios">
                    <br>
                    <input type="email" style="color:#DF0174;border-radius:10px;width:255px" 
                           placeholder="Correo: ejemplo@hotmail.com">
                    <input type="tel" style="color:#DF0174;border-radius:10px;width:255px" 
                            placeholder="Correo: 4491234567">
                    <input type="text" style="color:#DF0174;border-radius:10px;width:255px;height:200px" 
                            placeholder="Estoy interesado en...">
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
            <input type="text" name="unombre" value="<?= $rows['id_usuario']?>"  required size="25" class="informacion">
            <p></p>
            <label><b>Correo Electrónico</b></label><p></p>
            <input type="email" name="email" value="<?= $rows['correo'] ?>" required size="25" class="informacion">
            <p></p>
            <label><b>Nombre Completo</b></label><p></p>
            <input type="text" name="nombre" value="<?= $rows['nombre_completo'] ?>"  required maxlength="80" size="100" class="informacion"></input>
            <p></p>
            <label><b>Teléfono</b></label><p></p>
            <input type="tel"  name="tel" value="<?= $rows['telefono'] ?>" size="12" class="informacion">
            <p></p>
            <label><b>Celular</b></label><p></p>
            <input type="tel" name="cel" value="<?= $rows['celular'] ?>" required size="12" class="informacion">
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
            <input type="file" name="fotoG"/>
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
                    <input type="text" name="unombre" required size="25" id="inmueble">
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
                    <input type="text" name="inmueble" id="inmueble" required style="width:100%">
                </div>
                <div class="col-md-12">
                    <br>
                    <label> Selecciona los servicios con los que cuenta tu inmueble</label>
                </div>
                <div class="col-md-10">
                           
                                <div class="row">
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="http://simpleicon.com/wp-content/uploads/wifi-symbol-2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="1" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://www.shareicon.net/data/256x256/2016/03/30/741986_drop_512x512.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="2" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://openclipart.org/image/2400px/svg_to_png/185270/Light-Bulb-Icon.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="3" class="hidden">
                                </label>
                            </div>
                                
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/1153141-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="4" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2" style="margin-top: 11px">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Italian_traffic_signs_-_icona_wc.svg/2000px-Italian_traffic_signs_-_icona_wc.svg.png"
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
                                    <img src="https://image.freepik.com/free-icon/pawprint-in-a-circle-of-pet-hotel-sign_318-51334.jpg"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/3688-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                                    <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/15465-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="mueble" value="6" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://image.freepik.com/free-icon/network-cable_318-10722.jpg"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="cable" value="5" class="hidden">
                                </label>
                                </div>
                                    <div class="col-md-2" style="margin-top: 11px">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/18003-200.png"
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
                    <input type="text" id="descripcion" name="descripcion">
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
                                            <input type="file" class="form-control" id="imagenes" accept="image/x-png,image/gif,image/jpeg" name="imagenes[]" multiple/>
                                        </div>
                                    <div class="col-md-2"></div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-8" style="float:right">
                                        
                                        <button type="submit" style="float:right;background-color:#DF0174
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
<div id="id06" class="modal">
   <div class="modal-content">
          <div class="modal-header">
              <span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
              <h4 class="modal-titulo">Modificar Inmueble</h4>
          </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <label><b>Agrega un título</b></label><p></p>
                    <input type="text" name="unombre" required size="25" id="inmueble">
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
                    <input type="text" name="inmueble" id="inmueble" required style="width:100%">
                </div>
                <div class="col-md-12">
                    <br>
                    <label> Selecciona los servicios con los que cuenta tu inmueble</label>
                </div>
                <div class="col-md-10">
                            <form>
                                <div class="row">
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="http://simpleicon.com/wp-content/uploads/wifi-symbol-2.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="wifi" value="wifi" class="hidden">
                                </label>
                            </div> 
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://www.shareicon.net/data/256x256/2016/03/30/741986_drop_512x512.png" 
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height:100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="agua" value="agua" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://openclipart.org/image/2400px/svg_to_png/185270/Light-Bulb-Icon.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="luz" value="luz" class="hidden">
                                </label>
                            </div>
                                
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/1153141-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="aseo" value="aseo" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2" style="margin-top: 11px">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Italian_traffic_signs_-_icona_wc.svg/2000px-Italian_traffic_signs_-_icona_wc.svg.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px
                                         ;background-color:transparent;border-color: transparent">
                                    <input type="checkbox" name="bano" value="bano" class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" style="width:40px;margin-top: 25px;margin-left: -15px">                          
                                </div>
                                </div>
                                <div class="row">
                            <div class="col-md-2" style="">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://image.freepik.com/free-icon/pawprint-in-a-circle-of-pet-hotel-sign_318-51334.jpg"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="mascota" value="mascota" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/3688-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="libro" value="libro" class="hidden">
                                </label>
                            </div>
                                    <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/15465-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="mueble" value="mueble" class="hidden">
                                </label>
                            </div>
                                <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="https://image.freepik.com/free-icon/network-cable_318-10722.jpg"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="cable" value="cable" class="hidden">
                                </label>
                                </div>
                                    <div class="col-md-2" style="margin-top: 11px">
                                    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/18003-200.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px
                                         ;background-color:transparent;border-color: transparent">
                                    <input type="checkbox" name="cuarto" value="cuarto" class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" style="width:40px;margin-top: 25px;margin-left: -15px">                          
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <br>
                    <label> Agrega una descripción a tu inmuble</label>
                    <input type="text" id="descripcion">
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
                                            <input type="file" class="form-control" id="imagenes" name="imagenes" multiple/>
                                        </div>
                                    <div class="col-md-5"></div>
                                    
                                </div>
                                    <div class="row">
                                        <br>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4" style="float:left">
                                        <button type="button" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Eliminar Inmueble</button>
              
                                    </div>
                                    <div class="col-md-7" style="float:right">
                                        <button type="button" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Aplicar Cambios</button>
                                       <button type="button" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
              ;color:white;border-radius: 10px">Cancelar</button>
              
                                    </div>
                                    </div>
                                    
                            </form>
                </div>
            </div>
        </div>
   </div>
</<div></div>>
<button type="button" class="btn btn-info collapsed" data-toggle="collapse"
                                onclick="document.getElementById('id05').style.display='block'" style="width:auto;">
                     Agregar inmueble               
</button>
<button type="button" class="btn btn-info collapsed" data-toggle="collapse"
                                onclick="document.getElementById('id06').style.display='block'" style="width:auto;">
                     Modificar inmueble               
</button>
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

      function mapaUso(){
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var geocoder = new google.maps.Geocoder;
        var service = new google.maps.DistanceMatrixService;

        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = 'aguascalientes mexico pintores mexicanos juan soriano 558';
        var destinationA = 'aguascalientes uaa';
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8h-ZHEoAWQ3kUJVsIImMXws2-7yI4BBg&callback=mapaUso">
    </script>
</body>
</html>