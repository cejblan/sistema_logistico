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

$select = @$_POST["select"];
$buspro = @$_POST["buspro"];

?>

<section class="container FEs">
  <div class="row">
    <div class="col-12">
        <h1>Ventas Diarias</h1>
    </div>
  </div>
  </br>
  </br>
  <form action="ventas_diarias.php" method="POST">
    <div class="row">
      <div class="col-2">
        <h4>Cantidad</h4>
      </div>
      <div class="col-6">
        <h4>Descripcion</h4>
      </div>
      <div class="col-2">
        <h4>Monto</h4>
      </div>
      <div class="col-2">
        <h4>Forma de pago</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-2">
        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required/>
      </div>
      <div class="col-6">
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required/>
      </div>
      <div class="col-2">
        <input type="number" name="monto" class="form-control" placeholder="Monto" required/>
      </div>
      <div class="col-2">
        <select name="select" class="form-control" required>
          <option value="producto">Dolares</option>
          <option value="vendedor">Efectivo</option>
          <option value="fecha">Banca Amiga</option>
          <option value="fecha">Mercantil</option>
          <option value="fecha">Venezuela</option>
          <option value="fecha">Pago Movil</option>
        </select>
      </div>
    </div>
    </br>
    <div class="row">
      <div class="col-2">
        <h4>Nota/Factura</h4>
      </div>
      <div class="col-2">
        <h4>Código</h4>
      </div>
      <div class="col-8">
        <h4>Observaciones</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-2">
        <select name="select" class="form-control" required>
          <option value="producto">No aplica</option>
          <option value="producto">Nota</option>
          <option value="vendedor">Factura</option>
        </select>
      </div>
      <div class="col-2">
        <input type="text" name="codigo" class="form-control" placeholder="Código"/>
      </div>
      <div class="col-8">
        <input type="text" name="observaciones" class="form-control" placeholder="Observaciones"/>
      </div>
    </div>
    </br>
    <div class="row">
      <div class="col-10">
        <input class="btn btn-success" type="submit" name="submit" id="submit" value="Registrar"/>
      </div>
      <div class="col-2">
        <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
      </div>
    </div>
  </form>
</section>


<?php
require_once("php/footer.php");
?>