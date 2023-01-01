<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

require_once("php/head.php");
require_once('php/conexion.php');

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

@$eliminar = $_POST['eliminar'];

require_once('php/conexion.php');

if(isset($eliminar))
  {
    $delete = "DELETE FROM productos WHERE id = '$eliminar'";
    $result_delete = mysqli_query($conexion,$delete);
  }

$consult_usuarios = "SELECT * FROM productos";
$result_usuarios = mysqli_query($conexion,$consult_usuarios);

if(!$result_usuarios) 
  {
  echo "No se ha podido realizar la consulta";
  }

if (mysqli_num_rows($result_usuarios) == true)
  {
?>
<section class="container FEs">
  <div class="row">
    <div class="col-12">
        <h1>Lista de Productos</h1>
    </div>
  </div>
  </br>
  </br>
  <div class="row">
    <div class="col-12">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>
              <label>ID</label>
            </th>
            <th>
              <label>Nombre</label>
            </th>
            <th>
              <label>Descripción</label>
            </th>
            <th>
              <label>Cantidad</label>
            </th>
            <th>
              <label>Imagen</label>
            </th>
            <th>
              <label>Acción</label>
            </th>
          </tr>
        </thead>
        <tbody>
  <?php
  while ($columP = mysqli_fetch_array($result_usuarios))
    {
    echo '<tr>
            <td>
              <label class="padding">
                <h6>' . $columP['id'] . '</h6>
              </label>
            </td>
            <td>
              <label class="padding">
                <h6>' . $columP['nombre'] . '</h6>
              </label>
            </td>
            <td>
              <label class="padding">
                <h6>' . $columP['descripcion'] . '</h6>
              </label>
            </td>
            <td>
              <label class="padding">
                <h6>' . $columP['cantidad'] . '</h6>
              </label>
            </td>
            <td>
              <label class="padding">
                <h6>' . $columP['almacen'] . '</h6>
              </label>
            </td>
            <td>
              <label>
                <form action="lista_productos.php" method="POST">
                  <input type="text" name="eliminar" id="eliminar" class="form-control" value="'. $columP['id'] . '" readonly required/>
                  <button id="submitEliminar" class="button-presupuesto btn btn-primery" type="submit">Eliminar</button>
                </form>
              </label>
            </td>
          </tr>';
    }

  echo '</tbody>
      </table>
    </div>
  </div>
</section>
<section class="container FEs">
  <div class="row">
    <form action="administrativo.php" method="POST">
      <div class="col-12">
        <input class="btn btn-success center" id="submit" type="submit" value="volver"/>
      </div>
    </form>
  </div>
</section>';
  }
  else
      {
      echo '</tbody>
          </table>
        </div>
      </div>
    </section>
    <section class="container FEs">
      <div class="row">
        <form action="administrativo.php" method="POST">
          <div class="col-12">
            <input class="btn btn-success center" id="submit" type="submit" value="volver"/>
          </div>
        </form>
      </div>
    </section>
    </br>';
      goto end;
  }   

end:
@mysqli_close( $conexion );

?>

      </div>
    </div>
  </div>
</section>

<?php
require_once('php/footer.php');
?>