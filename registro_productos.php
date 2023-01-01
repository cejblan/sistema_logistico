<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

if(isset($_SESSION['administrador']))
  {
    goto admin;
  }
if(!isset($_SESSION['usuario']))
  {
    echo "<script>
            alert('Debes iniciar sesión');
            window.location = 'login.php';
          </script>";
    session_destroy();
    die();
  }
    else {
          if(!isset($_SESSION['administrador']))
            {
              echo "<script>
                      alert('Debes ser administrador para realizar esta acción');
                      window.location = 'index.php';
                    </script>";
              die();
            }
          }
admin:

$nombre = @$_POST["nombre"];
$descripcion = @$_POST["descripcion"];
$cantidad = @$_POST["cantidad"];
$almacen = @$_POST["almacen"];
$estante = @$_POST["estante"];
$tramo = @$_POST["tramo"];

require_once('php/conexion.php');
require_once('php/head.php'); 

if(!$conexion) 
  {
    echo "<b><h3>No se ha podido conectar con el servidor</h3></b>";
    goto end;
  }
?>

<section class="container FEs">
  <div class="row">
    <div class="col-12">
        <h1>Registro de productos</h1>
    </div>
    <div class="col-2"></div>
    <div class="col-8">
      <form action="registro_productos.php" enctype="multipart/form-data" method="POST">
        <label>
          <h2>Nombre:</h2>
        </label>
        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto" required/>
        </br>
        <label>
          <h2>Descripción:</h2>
        </label>
        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripcion del producto" required/>
        </br>
        <label>
          <h2>Cantidad:</h2>
        </label>
        <input type="number" name="cantidad" placeholder="1.0" step="0.1" class="form-control" required/>
        </br>
        <label>
          <h2>Almacen:</h2>
        </label>
        <input type="text" name="almacen" class="form-control" placeholder="¿En que almacen se va a depositar?" required/>
        </br>
        <label>
          <h2>Estante:</h2>
        </label>
        <input type="text" name="estante" class="form-control" placeholder="¿En que estante se va a colocar?" required/>
        </br>
        <label>
          <h2>Tramo:</h2>
        </label>
        <input type="text" name="tramo" class="form-control" placeholder="¿En cual tramo?" required/>
        </br>
        <label>
          <h2>imagen:</h2>
        </label>
        <input type="file" name="imagen" class="form-control" accept="image/png,image/jpeg"/>
        </br>
        <div class="row">
          <div class="col-6 margin_auto registro_productos">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Registrar"/>
          </div>
          <div class="col-6 margin_auto registro_productos">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Borrar"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
</br>

<?php
if (isset($_REQUEST['submit']))
  {
    if (@$_FILES['archivo']['size'] > 100000 )
      {
        echo "No se pueden subir archivos con pesos mayores a 100KB";
      } else {
              if (isset($_FILES['imagen']['name']))
                {
                  $tipoArchivo = $_FILES['imagen']['type'];
                  $permitido = array("image/png", "image/jpeg");
                  if(in_array($tipoArchivo,$permitido) == false)
                    {
                      echo "<script>
                              alert('Archivo no permitido');
                              window.location = '/sistema_logistico/registro_productos.php';
                            </script>";
                      die("Archivo no permitido");
                    }
                  $nombreArchivo = $_FILES['imagen']['name'];
                  $tamanoArchivo = $_FILES['imagen']['size'];
                  $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
                  $binariosImagen = fread($imagenSubida,$tamanoArchivo);
                  $binariosImagen = mysqli_escape_string($conexion,$binariosImagen);
                  $registro_productos = "INSERT INTO productos (nombre, descripcion, cantidad, almacen, estante, tramo, imagen, nombre_imagen, tipo_imagen)
                            VALUES ('$nombre','$descripcion','$cantidad','$almacen','$estante','$tramo','$binariosImagen','$nombreArchivo','$tipoArchivo')";
                  $result_productos = mysqli_query($conexion,$registro_productos);

                  @mysqli_close( $conexion );
                }
              }
  }

if(@!$registro_productos) 
  {
    echo '<section class="container FEs">
            <div class="row">
              <div class="col-2"></div>
                <div class="col-8">
                  <div class="row">
                    <div class="col">
                      <h3>No se ha podido registrar el producto</h3>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
          </section>';  
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
?>