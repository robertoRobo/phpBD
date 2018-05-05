<?php 
    
    session_start();
    if(isset($_SESSION['session'])){  
    include('conexionBaseDatos.php');

    $idCasa = intval($_POST['casa']);
    
    $query ="call datosCasa($idCasa)";
    $resultado = $conexion->query($query);
    $row = $resultado->fetch_assoc();
    

    #$servicio = "select cuenta_con.id_servicio from cuenta_con where id_casa = $idCasa";
    #$listaServicios = $conexion->query($servicio);

?>

<div id="id06" class="modal">
   <div class="modal-content">
          <div class="modal-header">
              <span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
              <h4 class="modal-titulo">Modificar Inmueble</h4>
          </div>
        <div class="modal-body">
            <div class="row">
                <form  method="POST" action="conexiones/alterarCasa.php" enctype="multipart/form-data">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <label><b>Agrega un título</b></label><p></p>
                    <input type="text" name="unombre" required size="25" value="<?= $row['titulo'] ?>" id="inmueble" maxlength="250">
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <label><b>Agrega el costo MXN</b></label><p></p>
                    <input type="number" name="costo" value="<?= $row['costo_mensual'] ?>" required id="inmueble">
                </div>
                <div class="col-md-1"></div>
               
                <div class="col-md-12">
                    <br>
                    <label><b>Ingresa la dirección del inmueble completa</b></label><p></p>
                    <input type="text" name="inmueble" id="inmueble" value="<?= $row['domicilio'] ?>" required style="width:100%" maxlength="100">
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
                                    <input type="checkbox" name="wifi" id="wifi"  value="1" class="hidden">
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
                                    <input type="checkbox" name="bano" value="bano" class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" value="<?= $row['num_banos'] ?>" style="width:40px;margin-top: 25px;margin-left: -15px">                          
                                </div>
                                </div>
                                <div class="row">
                            <div class="col-md-2" style="">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/gas.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 100%;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="gas" value="8" class="hidden">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/telefono.png"
                                         alt="..." class="img-thumbnail img-check" style="width:100%; height: 48px;background-color:transparent;border-color: transparent"> 
                                    <input type="checkbox" name="telefono" value="7" class="hidden">
                                </label>
                            </div>
                                    <div class="col-md-2">
                                <label class="checkbox" style="width:48px;height:48px;">
                                    <img src="Imagenes/mueble.png"
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
                                    <input type="checkbox" name="cuarto" value="cuarto" class="hidden">
                                </div>
                                <div class="col-md-2">
                                        <input type="number" value="<?= $row['num_habitaciones'] ?>" style="width:40px;margin-top: 25px;margin-left: -15px">                          
                                </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <br>
                    <label> Agrega una descripción a tu inmueble</label>
                    <input type="text" value="<?= $row['descripcion'] ?>" id="descripcion" maxlength="2000">
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
                                            <input type="file"  class="form-control" id="imagenes" name="imagenes" multiple/>
                                        </div>
                                    <div class="col-md-5"></div>
                                    
                                </div>
                                    <div class="row">
                                        <br>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4" style="float:left">
                                        
              
                                    </div>
                                    <div class="col-md-7" style="float:right">
                                        <button type="submit" name="guardar" value="<?= $idCasa ?>" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn" style="float:right;background-color:#DF0174
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
</div>
<script type="text/javascript">
    
   $(document).ready(function(e){
            $(".img-check").click(function(){
                $(this).toggleClass("check");
            });
    });
</script>
<?php 
    mysqli_close($conexion);
    }
?>