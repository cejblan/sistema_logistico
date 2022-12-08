<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

if(isset($_SESSION['administrador']))
  {
    goto admin;
  }
    else {
          if(isset($_SESSION['usuario']))
            {
              echo "<script>
                      alert('Debes ser administrador para realizar esta acción');
                      window.location = 'index.php';
                    </script>";
              die();
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
                    }
          }
admin:

$nombre = @$_POST["nombre"];
$descripcion = @$_POST["descripcion"];
$cantidad = @$_POST["cantidad"];
$almacen = @$_POST["almacen"];
$estante = @$_POST["estante"];
$tramo = @$_POST["tramo"];
$imagen = @$_POST["imagen"];
$tipo = @$_POST["tipo"];

require_once('php/head.php'); 
require_once('php/conexion.php');

?>

  <section class="container FEs">
    <div class="row">
      <div class="col-12">
          <h1>Registro de productos</h1>
      </div>
      <div class="col-2"></div>
      <div class="col-8">
        <form action="registro_productos.php" name="" method="POST">

<?php
if (!$_POST || trim(@$_POST['nombre']) === '')
        {
          echo '<label>
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
                  <h2>Foto:</h2>
                </label>
                <input type="file" name="imagen" class="form-control" placeholder="¿Alguna foto?" required/>
                </br>
                <div class="row">
                  <div class="col">
                    <input class="btn btn-success" type="submit" name="submit" id="submit" value="Registrar"/>
                  </div>
                  <div class="col">
                    <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Borrar"/>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
        </br>';
        goto end;
        } else {
                  echo '</br>
                        <label>
                          <h2>¿Hacer otro registro?</h2>
                        </label>
                        <button>
                          <input class="btn btn-success" type="submit" name="submit" id="submit" value="Hacer otro registro"/>
                        </button>
                      </form>
                    </div>
                  </div>
                </section>';
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

@$registro_productos= "INSERT INTO productos (nombre, descripcion, cantidad, almacen, estante, tramo, imagen, tipo)
                       VALUES ('$nombre','$descripcion','$cantidad','$almacen','$estante','$tramo','$imagen','$tipo')";

@$result_productos = mysqli_query($conexion,$registro_productos);

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

$consult_productos= "SELECT * FROM productos WHERE nombre ='$nombre'";
$resultado = mysqli_query($conexion,$consult_productos);

if (@mysqli_num_rows($resultado) == true)
  {
    echo '</br>
          </br>
          <section class="container FEs">
            <div class="row">
              <div class="col-12">
                  <h1>Producto Registrado</h1>
              </div>
            </div>
            </br>
            <div class="row">
              <div class="col-12">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th scope="col">Código</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Almacen</th>
                      <th scope="col">Estante</th>
                      <th scope="col">Tramo</th>
                      <th scope="col">Imagen</th>
                      <th scope="col">Tipo</th>
                    </tr>
                  </thead>
                  <tbody>';
    while ($columP = mysqli_fetch_array($resultado))
      {
        echo '<tr>
                <td>
                  <label>
                    <h6>' . $columP['id'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['nombre'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['descripcion'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['cantidad'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['almacen'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['estante'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['tramo'] . '</h6>
                  </label>
                </td>
                <td>
                  <label>
                    <img style="width: 7em;" src="data:'. $columP['tipo'] .';base64,' . base64_encode( $columP['imagen'] ) . '"/>
                  </label>
                </td>
                <td>
                  <label>
                    <h6>' . $columP['tipo'] . '</h6>
                  </label>
                </td>
              <tr>';
      }
  }

  else
      {
        @mysqli_close( $conexion );
        echo "<script>
                alert('Error al mostrar producto. Consulte con el tecnico.');
              </script>";
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