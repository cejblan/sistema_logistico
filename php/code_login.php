<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

require_once('conexion.php');

$cedula = $_POST["cedula"] ;
$contrasena = $_POST["contrasena"] ;
/*
if(!@preg_match('/^[J-V]\d*$/', $cedula))
{
  setcookie("DetectMali", "cul*", time() + 60, "/sistema_logistico", "localhost", 1);
  header("Location: /sistema_logistico/login.php", TRUE, 301);
  exit();
}
*/
$validacion_login = mysqli_query ($conexion, "SELECT * FROM usuarios WHERE cedula = '$cedula' AND contrasena = '$contrasena'");

if($validacion_login == true and $cedula == 'V27321006')
  {
    $_SESSION['administrador'] = $cedula;
    setcookie("administrador", $cedula, time() + 3, "/sistema_logistico", "localhost", 1);
    echo "<script>
            window.location = '/sistema_logistico/index.php';
          </script>";
    exit();
  }

if(mysqli_num_rows($validacion_login) > 0)
  {
    $_SESSION['usuario'] = $cedula;
    setcookie("IngUsuario", $cedula, time() + 3, "/sistema_logistico", "localhost", 1);
    //setcookie("usuario", $cedula, time() + 600, "/sistema_logistico", "localhost", 1);
    echo "<script>
            window.location = '../index.php';
          </script>";
    exit();
  } 
    else {
          echo "<script>
                  alert('No se encuentra Registrado. Consulte con el encargado.');
                  window.location = '../login.php';
                </script>";
          exit();
          };

?>