<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

if(isset($_SESSION['administrador']))
  {
    $usuario = $_SESSION['administrador'];
    goto admin;
  }
    else {
          if(!isset($_SESSION['usuario']))
            {
              echo "<script>
                      alert('Debes iniciar Sesión');
                      window.location = 'login.php';
                    </script>";
              session_destroy();
              die();
            }
            else
                {
                  $usuario = $_SESSION['usuario'];
                }
          }
admin:

$buspro = @$_POST["buspro"] ;
$nombre = @$_POST["nombre2"] ;
$existenciaA = @$_POST["cantidadA"] ;
$existenciaN = @$_POST["cantidadN"] ;
$fechaActual = date('y-m-d');

require_once('php/head.php'); 
require_once('php/conexion.php');

if(isset($existenciaN))
  {
    $actualizar = "UPDATE productos SET cantidad='$existenciaN' WHERE nombre='$nombre'";
    $resultado = mysqli_query($conexion, $actualizar);

    $historial = "INSERT INTO historial_movimientos (vendedor, fecha, producto, existenciaA, existenciaN)
                VALUES ('$usuario','$fechaActual','$nombre','$existenciaA','$existenciaN')";
    $result_historial = mysqli_query($conexion,$historial);
  }

if (@$result_historial)
  {
    echo "<script>
            alert('Actualización realizada con exito.');
          </script>";
  }

?>

  <section class="container FEs">
    <div class="row">
      <div class="col-12">
          <h1>Busqueda</h1>
      </div>
      <div class="col-12">
        <form action="productos.php" name="" method="POST">
          <label>
            <h2>Producto:</h2>
          </label>

<?php
if (! $_POST || trim(@$_POST['buspro'])   === '')
  {
  echo '<input type="text" name="buspro" class="form-control" placeholder="Nombre de producto" required/>
        </br>
        <div class="row">
          <div class="col-6 margin_auto productos">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Buscar"/>
          </div>
          <div class="col-6 margin_auto productos">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
          </div>
        </div>
        </form>
        </div>
        </div>
        </section>
        </br>';
  goto end;
} else {
  echo '<input type="text" name="buspro" value="' . $buspro . '" class="form-control" placeholder="Nombre de producto" required/>
        </br>
        <div class="row">
          <div class="col-6 margin_auto productos">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Buscar"/>
          </div>
          <div class="col-6 margin_auto productos">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
          </div>
        </div>
        </form>
        </div>
        </div>
        </section>
        </br>';
}

if(!$conexion) 
  {
  echo "<b><h3>No se ha podido conectar con el servidor</h3></b>";
  goto end;
  }

if (!$sistema_logistico)
  {
  echo "<b><h4>No se ha podido encontrar la Tabla</h4></b>";
  goto end;
  }

$consult_productos= "SELECT * FROM productos WHERE nombre ='$buspro'";
$result_productos = mysqli_query($conexion,$consult_productos);

if (mysqli_num_rows($result_productos) == true)
  {
    echo '<section id="productos" class="container FEs">
            <div class="row">
              <div class="col-12">
                  <h1>Resultado de la busqueda</h1>
              </div>
            </div>
            </br>
            <div class="row">';

    while ($colum = mysqli_fetch_array($result_productos))
        {
          echo '<div class="cajita col-3">
                  <img class="pre" src="data:;base64,' . base64_encode( $colum['imagen'] ) . '"/>
                  <div class="cajaFlotante">
                    <label id="id">
                      <h6><strong>Código: </strong>'. $colum['id'] .'</h6>
                    </label>
                    </br>
                    </br>
                    <label id="nombre">
                      <h6><strong>Nombre: </strong>'. $colum['nombre'] .'</h6>
                    </label> 
                    </br>
                    </br>
                    <label id="descripcion">
                      <h6><strong>Descripcion: </strong>'. $colum['descripcion'] .'</h6>
                    </label>
                    </br>
                    </br>
                    <label id="almacen">
                      <h6><strong>Almacen: </strong>'. $colum['almacen'] .'</h6>
                    </label>
                    </br>
                    </br>
                    <label id="estante">
                      <h6><strong>Estante: </strong>'. $colum['estante'] .'</h6>
                    </label>
                    </br>
                    </br>
                    <label id="tramo">
                      <h6><strong>Tramo: </strong>'. $colum['tramo'] .'</h6>
                    </label>
                    </br>
                    </br>
                    <form action="productos.php" method="POST">
                      <input id="invisible" type="text" name="nombre2" value="'. $colum['nombre'] .'" class="form-control" readonly required/>
                      <input id="invisible" type="number" name="cantidadA" value="'. $colum['cantidad'] .'" class="form-control" readonly required/>
                      <input id="cantidad" type="number" name="cantidadN" value="'. $colum['cantidad'] .'" placeholder="1.0" step="0.1" class="form-control" required/>
                      </br>
                      </br>
                      <input id="cambiar" class="btn btn-success" type="submit" name="submit" id="submit" value="Cambiar"/>
                    </form>
                </div>
              </div>';
          }
        }
        else
            {
              @mysqli_close( $conexion );
                $proNoEnc = 'Producto no encontrado'; 
            }

end:
@mysqli_close( $conexion );

?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php
require_once('php/footer.php');

if (isset($proNoEnc))
  {
?>
<section id="alertas">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>   
  <div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <label>
      <strong>Producto no encontrado</strong>
    </label>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">
        <strong>
          <h1>&times;</h1>
        </strong>
      </span>
    </button>
  </div>
  <script>
    $("#alert").show();
    $(".close").click(function(){
                                  $("#alert").hide();
                                });
  </script>
</section>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").fadeOut(3000);
    },3000);
});
$(document).ready(function() {
    setTimeout(function() {
        var x = document.getElementById("alert");
        x.style.setProperty("display", "none", "important");
    },6000);
});
</script>

<?php
    
  }
?>