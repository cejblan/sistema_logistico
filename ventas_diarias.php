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

if (@$_POST["selectNF"] == 0 or 1)
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

if(isset($_POST["actualizar"]))
  {
    $uno_divisa = @$_POST["uno_divisa"];
    $cinco_divisa = @$_POST["cinco_divisa"];
    $diez_divisa = @$_POST["diez_divisa"];
    $veinte_divisa = @$_POST["veinte_divisa"];
    $cincuenta_divisa = @$_POST["cincuenta_divisa"];
    $cien_divisa = @$_POST["cien_divisa"];

    if(!isset($id2))
      {
        @$insert_apertura = "INSERT INTO apertura_caja (uno_divisa, cinco_divisa, diez_divisa, veinte_divisa, cincuenta_divisa, cien_divisa)
                              VALUES ('$uno_divisa','$cinco_divisa','$diez_divisa','$veinte_divisa','$cincuenta_divisa','$cien_divisa')";
        @$result_apertura = $conexion->query($insert_apertura);

        @$insert_apertura = "UPDATE apertura_caja SET uno_divisa='$uno_divisa', cinco_divisa='$cinco_divisa', diez_divisa='$diez_divisa', veinte_divisa='$veinte_divisa', cincuenta_divisa='$cincuenta_divisa', cien_divisa='$cien_divisa' WHERE id= 1";
        @$result_apertura = $conexion->query($insert_apertura);
      } else {
              @$insert_apertura = "UPDATE apertura_caja SET uno_divisa='$uno_divisa', cinco_divisa='$cinco_divisa', diez_divisa='$diez_divisa', veinte_divisa='$veinte_divisa', cincuenta_divisa='$cincuenta_divisa', cien_divisa='$cien_divisa' WHERE id= 1";
              @$result_apertura = $conexion->query($insert_apertura);
              }
    }

  if(isset($_POST["reiniciar"]))
    {
      $uno_divisa = 0;
      $cinco_divisa = 0;
      $diez_divisa = 0;
      $veinte_divisa = 0;
      $cincuenta_divisa = 0;
      $cien_divisa = 0;

      @$restar_apertura = "UPDATE apertura_caja SET uno_divisa='$uno_divisa', cinco_divisa='$cinco_divisa', diez_divisa='$diez_divisa', veinte_divisa='$veinte_divisa', cincuenta_divisa='$cincuenta_divisa', cien_divisa='$cien_divisa' WHERE id= 1";
      @$result_restar_apertura = $conexion->query($restar_apertura);

      $resetear = "DELETE FROM apertura_caja WHERE id <> '1'";
      @$result_resetear = mysqli_query($conexion,$resetear);
      
      $restar = "ALTER TABLE apertura_caja AUTO_INCREMENT = 1";
      @$result_restar = mysqli_query($conexion,$restar);

    }

?>

<section class="container FEs">
  <div class="row">
    <div class="col-12">
        <h1>Ventas Diarias</h1>
    </div>
  </div>
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
<section class="container FEs">
  <div class="row">
    <div class="col-12">
      <h1>Caja</h1>
    </div>
  </div>
  </br>
  <div class="row">
    <form action="ventas_diarias.php" method="POST">
      <div class="row">
        <div class="col-2">
          <h4>1$</h4>
        </div>
        <div class="col-2">
          <h4>5$</h4>
        </div>
        <div class="col-2">
          <h4>10$</h4>
        </div>
        <div class="col-2">
          <h4>20$</h4>
        </div>
        <div class="col-2">
          <h4>50$</h4>
        </div>
        <div class="col-2">
          <h4>100$</h4>
        </div>
      </div>
    <?php

    @$consult_apertura = "SELECT * FROM apertura_caja WHERE id = '1'";
    @$result_apertura = mysqli_query($conexion,$consult_apertura);

    while ($columB = mysqli_fetch_array($result_apertura))
      {
    ?>
      <div class="row">
        <div class="col-2">
          <input type="number" name="uno_divisa" class="form-control" placeholder="Billetes de Uno" value="<?php echo $columB['uno_divisa'];?>" required/>
        </div>
        <div class="col-2">
          <input type="number" name="cinco_divisa" class="form-control" placeholder="Billetes de Cinco" value="<?php echo $columB['cinco_divisa'];?>" required/>
        </div>
        <div class="col-2">
          <input type="number" name="diez_divisa" class="form-control" placeholder="Billetes de Diez" value="<?php echo $columB['diez_divisa'];?>" required/>
        </div>
        <div class="col-2">
          <input type="number" name="veinte_divisa" class="form-control" placeholder="Billetes de Veinte" value="<?php echo $columB['veinte_divisa'];?>" required/>
        </div>
        <div class="col-2">
          <input type="number" name="cincuenta_divisa" class="form-control" placeholder="Billetes de Cincuenta" value="<?php echo $columB['cincuenta_divisa'];?>" required/>
        </div>
        <div class="col-2">
          <input type="number" name="cien_divisa" class="form-control" placeholder="Billestes de Cien" value="<?php echo $columB['cien_divisa'];?>" required/>
        </div>
      </div>
      </br>
      <div class="row">
        <div class="col-10">
          <input class="btn btn-success" type="submit" name="actualizar" id="submit" value="Actualizar"/>
        </div>
        <div class="col-2">
          <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
        </div>
      </div>
    </form>
  </div>
</section>
<?php
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

$insert_ventas = "INSERT INTO ventas_diarias (fecha, vendedor, cantidad, descripcion, monto, forma_pago, $NotaFactura, delivery, observaciones)
                    VALUES ('$fechaActual','$vendedor','$cantidad','$descripcion','$monto','$FormaPago','$NroNotaFactura','$delivery','$observaciones')";
$result_ventas = $conexion->query($insert_ventas);

$consult_ventas = "SELECT * FROM ventas_diarias WHERE fecha = '$fechaActual'";
$result_consult_ventas = mysqli_query($conexion,$consult_ventas);


if (@mysqli_num_rows($result_consult_ventas) == true)
 {
   echo '</br>
         </br>
         <section class="container FEs">
           <div class="row">
             <div class="col-12">
                 <h2>El día de hoy</h2>
             </div>
           </div>
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

  if ($sumatoria_ventas =mysqli_query($conexion, "SELECT SUM(monto) AS sumatoria FROM ventas_diarias WHERE fecha = '$fechaActual'")) {
    $result_sumatoria_ventas= mysqli_fetch_assoc($sumatoria_ventas);
  }
?>
      </tbody>
    </table>
  </div>
</section>
<?php

@$sumatoria_apertura = mysqli_query($conexion, "SELECT SUM(uno_divisa * 1 + cinco_divisa * 5 + diez_divisa * 10 + veinte_divisa * 20 + cincuenta_divisa * 50 + cien_divisa * 100) AS sumatoria FROM apertura_caja WHERE id = 2");
@$result_sumatoria_apertura = mysqli_fetch_assoc($sumatoria_apertura);

?>
<section class="container FEs">
  <div class="row">
    <div class="col-12">
      <h1>Totales</h1>
    </div>
  </div>
  <div class="row">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Total de Ventas</th>
          <th scope="col">Apertura de caja</th>
          <th scope="col">Apertura y Ventas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> 
            <label>
              <h6><?php print($result_sumatoria_ventas['sumatoria']);?></h6>
            </label>
          </td>
          <td>
            <label>
              <h6><?php print($result_sumatoria_apertura["sumatoria"]);?></h6>
            </label>
          </td>
          <td>
            <label>
              <h6><?php print($result_sumatoria_ventas['sumatoria'] + $result_sumatoria_apertura["sumatoria"]);?></h6>
            </label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
<?php
 }
   else
       {
         @mysqli_close( $conexion );
         $regNoEnc = 'Registro no encontrado'; 

        }

?>
        
</br>
<section class="container FEs">
  <div class="row">
    <form action="ventas_diarias.php" method="POST">
      <div class="col-12">
        <input class="btn btn-success center" type="submit" name="reiniciar" id="submit" value="Reiniciar fondo de caja"/>
      </div>
    </form>
  </div>
</section>

<?php

end:
@mysqli_close( $conexion );

require_once("php/footer.php");
?>