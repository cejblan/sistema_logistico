<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

require_once("php/head.php");

if(isset($_SESSION['usuario']))
{
  header('Location: index.php');
  die();
}

?>
<section class="container FEs" style="padding-top:1em;">
  <div class="row">
    <div class="col-12">
        <h1>Ingresa</h1>
    </div>
    <div class="col-12">
      <form action="php/code_login.php" name="" method="POST">
        <label>
          <h2>Cedula:</h2>
        </label>
        <input type="text" name="cedula" pattern="[V][0-9]*" class="form-control" placeholder="Ingrese su Cedula de Identidad" required/>
        </br>
        <label>
          <h2>Contraseña:</h2>
        </label>
        <input type="password" name="contrasena" class="form-control" placeholder="Ingrese su contraseña" required/>
        </br>
        <div class="row">
          <div class="col-6 margin_auto login">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Ingresa"/>
          </div>
          <div class="col-6 margin_auto login">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php

require_once("php/footer.php");

?>