<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();
/*
if(!@preg_match('/^[J-V]\d*$/', $cedula))
{
  setcookie("DetectMali", "cul*", time() + 60, "/sistema_logistico", "localhost", 1);
  header("Location: /sistema_logistico/registro.php", TRUE, 301);
  exit();
}
*/
require_once('php/conexion.php');

if(isset($_SESSION['administrador']))
  {
    $creador = $_SESSION['administrador'];
    goto admin;
  }
    else {
          if(isset($_SESSION['usuario']))
            {
              $creador = $_SESSION['usuario'];
              echo "<script>
                      alert('Debes ser administrador para realizar esta acción');
                      window.location = 'index.php';
                    </script>";
              die();
            }
              else {
                    echo "<script>
                            alert('Para registrarte, habla con el encargado.');
                            window.location = 'login.php';
                          </script>";
                    session_destroy();
                    die();
                    }
          }

admin:

  @$cedula = $_POST["cedula"];
  @$nombre = $_POST["nombre"];
  @$apellido = $_POST["apellido"];
  @$contrasena = $_POST["contrasena"];

if (isset($_POST["cedula"]))
  {
    if (@$_FILES['archivo']['size'] > 100000 )
      {
        echo "No se pueden subir archivos con pesos mayores a 100KB";
      } else {
              if (isset($_REQUEST['submit']))
                {
                  if (isset($_FILES['foto']['name']))
                    {
                      $tipoArchivo = $_FILES['foto']['type'];
                      $permitido = array("image/png", "image/jpeg");
                      if(in_array($tipoArchivo,$permitido) == false)
                        {
                          echo "<script>
                                  alert('Archivo no permitido');
                                  window.location = '/sistema_logistico/registro.php';
                                </script>";
                          die("Archivo no permitido");
                        }
                      $nombreArchivo = $_FILES['foto']['name'];
                      $tamanoArchivo = $_FILES['foto']['size'];
                      $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
                      $binariosImagen = fread($imagenSubida,$tamanoArchivo);
                      $binariosImagen = mysqli_escape_string($conexion,$binariosImagen);
                      $query = "INSERT INTO usuarios (cedula, nombre, apellido, contrasena, creador, foto, nombre_foto, tipo_foto)
                                VALUES ('$cedula','$nombre','$apellido','$contrasena','$creador','$binariosImagen','$nombreArchivo','$tipoArchivo')";
                      $resultado = $conexion->query($query);
                      @mysqli_close( $conexion );
                    }
                }
              }
                if($resultado)
                  {
                    echo "<script>
                            alert('Registrado con exito.');
                            window.location = '/sistema_logistico/registro.php';
                          </script>";
                    exit();
                  }
                    else {
                      echo "<script>
                              alert('Error al registrar.');
                              window.location = '/sistema_logistico/registro.php';
                            </script>";
                      exit();
                          }
  }
  
// Lo comentado a continuación, funciona, solo que no se puede filtrar por tipo de archivo, ya que, es poco especifico.
/*$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

$query = "INSERT INTO usuarios (cedula, nombre, apellido, contrasena, foto, creador)
          VALUES ('$cedula','$nombre','$apellido','$contrasena','$foto','$creador')";
$resultado = $conexion->query($query);*/

require_once("php/head.php");

?>

<section class="container FEs registro">
  <div class="row">
    <div class="col-12">
        <h1>Registro de Usuario</h1>
    </div>
    <div class="col-2"></div>
    <div class="col-8">
      <form action="registro.php" enctype="multipart/form-data" method="POST">
        <label>
          <h2>Cedula:</h2>
        </label>
        <input type="text" name="cedula" pattern="[V][0-9]*" class="form-control" placeholder="Ingrese su Cedula de Identidad" required/>
        </br>
        <label>
          <h2>Nombre:</h2>
        </label>
        <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre" required/>
        </br>
        <label>
          <h2>Apellido:</h2>
        </label>
        <input type="text" name="apellido" class="form-control" placeholder="Ingrese su Apellido" required/>
        </br>
        <label>
          <h2>Contraseña:</h2>
        </label>
        <input type="password" name="contrasena" class="form-control" placeholder="Ingrese su contraseña" required/>
        </br>
        <label>
          <h2>Foto:</h2>
        </label>
        <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg" required/>
        </br>
        <div class="row">
          <div class="col-6 margin_auto registro">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Ingresa"/>
          </div>
          <div class="col-6 margin_auto registro">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Borrar"/>
          </div>
        </div>
      </form>
      </br>
      </br>
      <div class="row">
        <div class="col-12 margin_auto">
          <h5>
            <strong>¿La foto no es 400px por 400px?</strong>
          </h5>
        </div>
      </div>
      <form name="forma" action="php/redimensionar_imagen.php" enctype="multipart/form-data" method="POST">
        <div class="row">
          <div class="col-6 margin_auto registro_2">
            <input type="file" id="inputarchivo" name="foto" class="form-control" style="display: none;" accept="image/png,image/jpeg" required/>
            <button class="btn btn-success registro" for="inputarchivo" id="labelarchivo">Subir archivo</button>
          </div>
          <div class="col-6 margin_auto registro_2">
            <button class="btn btn-success" type="submit">Redimensionar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
</br>

<?php
require_once("php/footer.php");
?>