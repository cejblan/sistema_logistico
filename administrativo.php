<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

require_once("php/head.php");

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

?>

<section id="administrativo" class="container FEs">
  <div class="row">
    <div class="col-12">
        <h1>Modulo Administrativo</h1>
    </div>
  </div>
  </br>
  </br>
  <div class="row">
    <div class="col-4">
      <a href="registro_productos.php">
        <h2>
          <strong>Registrar productos</strong>
        </h2>
      </a>
    </div>
    <div class="col-4">
      <a href="registro.php">
        <h2>
          <strong>Registrar Usuario</strong>
        </h2>
      </a>
    </div>
    <div class="col-4">
      <a href="">
        <h2>
          <strong>Listado de Usuarios</strong>
        </h2>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <a href="imprimir.php">
        <h2>
          <strong>Imprimir Historial</strong>
        </h2>
      </a>
    </div>
    <div class="col-4">
      <a href="ventas_diarias.php">
        <h2>
          <strong>Ventas Diarias</strong>
        </h2>
      </a>
    </div>
  </div>
</section>

<?php

require_once("php/footer.php");

?>