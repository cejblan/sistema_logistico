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

if (@$_POST["selectNF"] == 0)
  {
    $NotaFactura = '';
  }

if (@$_POST["selectNF"] == 1)
  {
    $NotaFactura = 'nota';
  }

if (@$_POST["selectNF"] == 2)
  {
    $NotaFactura = 'factura';
  }

$vendedor = @$_POST["vendedor"];
$cantidad = @$_POST["cantidad"];
$descripcion = @$_POST["descripcion"];
$monto = @$_POST["monto"];
$FormaPago = @$_POST["selectP"];
$NroNotaFactura = @$_POST["codigo"];
$delivery = @$_POST["selecD"];
$observaciones = @$_POST["observaciones"];
$fechaActual = date('y-m-d');

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
        <h4>Vendedor</h4>
      </div>
      <div class="col-2">
        <h4>Cantidad</h4>
      </div>
      <div class="col-6">
        <h4>Descripcion</h4>
      </div>
      <div class="col-2">
        <h4>Monto</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-2">
        <select name="vendedor" class="form-control" required>
          <option value="Denis">Denis</option>
          <option value="Alan">Alan</option>
          <option value="Cristian">Cristian</option>
          <option value="Juan">Juan</option>
          <option value="Francisco">Francisco</option>
          <option value="Manuel">Manuel</option>
        </select>
      </div>
      <div class="col-2">
        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" value="1.0" step="0.1" required/>
      </div>
      <div class="col-6">
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required/>
      </div>
      <div class="col-2">
        <input type="number" name="monto"  class="form-control" placeholder="Monto" value="1.0" step="0.1" required/>
      </div>
    </div>
    </br>
    <div class="row">
      <div class="col-2">
        <h4>Forma de pago</h4>
      </div>
      <div class="col-2">
        <h4>Nota/Factura</h4>
      </div>
      <div class="col-2">
        <h4>Código</h4>
      </div>
      <div class="col-2">
        <h4>Delivery</h4>
      </div>
      <div class="col-4">
        <h4>Observaciones</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-2">
        <select name="selectP" class="form-control" required>
          <option value="Dolares">Dolares</option>
          <option value="Euros">Euros</option>
          <option value="Zelle">Zelle</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Banca Amiga">Banca Amiga</option>
          <option value="Mercantil">Mercantil</option>
          <option value="Venezuela">Venezuela</option>
          <option value="Pago Movil">Pago Movil</option>
          <option value="Transferencia">Transferencia</option>
        </select>
      </div>
      <div class="col-2">
        <select name="selectNF" class="form-control" required>
          <option value="0">No aplica</option>
          <option value="1">Nota</option>
          <option value="2">Factura</option>
        </select>
      </div>
      <div class="col-2">
        <input type="text" name="codigo" class="form-control" placeholder="Código"/>
      </div>
      <div class="col-2">
        <select name="selecD" class="form-control" required>
          <option value="No">No</option>
          <option value="Si">Si</option>
        </select>
      </div>
      <div class="col-4">
        <input type="text" name="observaciones" class="form-control" placeholder="Observaciones"/>
      </div>
    </div>
    </br>
    <div class="row">
      <div class="col-10">
        <input class="btn btn-success" type="submit" name="submit" id="submit" value="Registrar venta"/>
      </div>
      <div class="col-2">
        <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
      </div>
    </div>
  </form>
</section>

<?php
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

$insert_ventas = "INSERT INTO ventas_diarias (fecha, vendedor, cantidad, descripcion, monto, forma_pago, $NotaFactura, delivery, observaciones)
                    VALUES ('$fechaActual','$vendedor','$cantidad','$descripcion','$monto','$FormaPago','$NroNotaFactura','$delivery','$observaciones')";
$result_ventas = $conexion->query($insert_ventas);

$consult_ventas = "SELECT * FROM ventas_diarias WHERE fecha = '$fechaActual'";
$result_consult_ventas = mysqli_query($conexion,$consult_ventas);

if (@mysqli_num_rows($result_consult_ventas) == true)
 {
   echo '</br>
         <section class="container FEs">
           <div class="row">
             <div class="col-12">
                 <h2>El día de hoy</h2>
             </div>
           </div>
           </br>
           <div class="row">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">Vendedor</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Monto</th>
                  <th scope="col">Forma de Pago</th>
                  <th scope="col">Nota</th>
                  <th scope="col">Factura</th>
                  <th scope="col">Delivery</th>
                  <th scope="col">Observaciones</th>
                </tr>
              </thead>
              <tbody>';
   while ($columP = mysqli_fetch_array($result_consult_ventas))
     {
       echo '<tr>
               <td>
                 <label>
                   <h6>' . $columP['fecha'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['vendedor'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['cantidad'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['descripcion'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['monto'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['forma_pago'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['nota'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['factura'] . '</h6>
                 </label>
               </td>
               <td>
                <label>
                  <h6>' . $columP['delivery'] . '</h6>
                </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['observaciones'] . '</h6>
                 </label>
               </td>
             <tr>';
     }
 }
   else
       {
         @mysqli_close( $conexion );
         $regNoEnc = 'Registro no encontrado'; 
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
</tr>


<?php
require_once("php/footer.php");
?>