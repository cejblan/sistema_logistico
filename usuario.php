<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

if(isset($_SESSION['administrador']))
  {
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
          }

admin:

if(isset($_SESSION['administrador']))
  {
    $bususer = $_SESSION['administrador'];
  }
  else {
        if(isset($_SESSION['usuario']))
          {
            $bususer = $_SESSION['usuario'];
          }
       }
          
require_once('php/head.php'); 
require_once('php/conexion.php'); 

$consult_user= "SELECT * FROM usuarios WHERE cedula ='$bususer'";
$result_user = mysqli_query($conexion,$consult_user);

if (mysqli_num_rows($result_user) == true)
  {
    while ($colum = mysqli_fetch_array($result_user))
      {
        echo '<section id="resolucion1" class="container FEs">
                <div class="row">
                  <div class="col-12">
                      <h1>Usuario</h1>
                  </div>
                  <div class="col-12 cuadroU">
                    <div class="container">
                      <div class="row">
                        <div class="col-4">
                          <label>
                            <h3>Nombre y apellido:</h3>
                          </label>
                        </div>
                        <div class="col-8">
                          <label>
                            <h1>&nbsp'. $colum['nombre'] .'&nbsp'. $colum['apellido'] .'</h1>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <label>
                            <h3>Cedula Identidad:</h3>
                          </label>
                        </div>
                        <div class="col-4">
                          <label>
                            <h5>&nbsp'. $colum['cedula'] .'</h5>
                          </label>
                        </div>
                        <div class="col-4 imagen">
                          <img src="data:;base64,' . base64_encode( $colum['foto'] ) . '"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <label>
                            <h3>Fecha de creación:</h3>
                          </label>
                        </div>
                        <div class="col-4">
                          <label>
                            <h5>&nbsp'. $colum['fecha'] .'</h5>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <label>
                            <h3>Admin. creador:</h3>
                          </label>
                        </div>
                        <div class="col-4">
                          <label>
                            <h5>&nbsp'. $colum['creador'] .'</h5>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <label>
                            <h3>Contraseña:</h3>
                          </label>
                        </div>
                        <div class="col">
                          <label>
                            <input type="password" value="'. $colum['contrasena'] .'" class="form-control" disabled/>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <form action="usuario.php" method="POST">
                            <label>
                              <h4 class="alig_left">Cambiar contraseña:</h4>
                            </label>
                          </div>
                          <div class="col-4">
                            <input type="password" name="contrasena" class="form-control" required/>
                          </div>
                          <div class="col-4">
                            <input class="btn btn-success cam_con_usu" type="submit" name="submit" id="submit" value="Cambiar"/>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>  
                </div>
              </section>
              <section id="resolucion2" class="container FEs">
                <div class="row">
                  <div class="col-12">
                      <h1>Usuario</h1>
                  </div>
                  <div class="col-12 cuadroU">
                    <div class="container">
                      <div class="row">
                        <div class="col-5">
                          <label>
                            <h3>Nombre y apellido:</h3>
                          </label>
                        </div>
                        <div class="col-7">
                          <label>
                            <h1>&nbsp'. $colum['nombre'] .'&nbsp'. $colum['apellido'] .'</h1>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5">
                          <label>
                            <h3>Cedula Identidad:</h3>
                          </label>
                        </div>
                        <div class="col-7">
                          <label>
                            <h5>&nbsp'. $colum['cedula'] .'</h5>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 imagen">
                          <img src="data:;base64,' . base64_encode( $colum['foto'] ) . '"/>
                        </div>
                      </div>
                      </br>
                      <div class="row">
                        <div class="col-5">
                          <label>
                            <h3>Fecha de creación:</h3>
                          </label>
                        </div>
                        <div class="col-7">
                          <label>
                            <h5>&nbsp'. $colum['fecha'] .'</h5>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5">
                          <label>
                            <h3>Admin. creador:</h3>
                          </label>
                        </div>
                        <div class="col-7">
                          <label>
                            <h5>&nbsp'. $colum['creador'] .'</h5>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5">
                          <label>
                            <h3>Contraseña:</h3>
                          </label>
                        </div>
                        <div class="col">
                          <label>
                            <input type="password" value="'. $colum['contrasena'] .'" class="form-control" disabled/>
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <form action="usuario.php" method="POST">
                            <label>
                              <h4 class="alig_left">Cambiar contraseña:</h4>
                            </label>
                          </div>
                          <div class="col-4">
                            <input type="password" name="contrasena" class="form-control" required/>
                          </div>
                          <div class="col-4">
                            <input class="btn btn-success cam_con_usu" type="submit" name="submit" id="submit" value="Cambiar"/>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>  
                </div>
              </section>
              ';
        }
  }
  else
      {
        echo "<script>
                alert('Error de consulta.');
                window.location = '/sistema_logistico/login.php';
              </script>";
        die();
      }

$contrasena = @$_POST["contrasena"];

if (isset($contrasena))
 {
  require_once('php/conexion.php');

  $actualizar = "UPDATE usuarios SET contrasena='$contrasena' WHERE cedula='$bususer'";
  $resultado = mysqli_query($conexion, $actualizar);
 }

if (isset($resultado))
 {
   echo "<script>
            alert('Contraseña cambiada.');
            window.location = 'usuario.php';
          </script>";
 }
  else {
        if (isset($contrasena))
          {
            echo "<script>
                    alert('Error al cambiar la contraseña.');
                    window.location = 'usuario.php';
                  </script>";       
          }
}

require_once("php/footer.php");
?>