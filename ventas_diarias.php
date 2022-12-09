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

$NotaFactura = @$_POST["selectNF"];
$vendedor = @$_POST["vendedor"];
$cantidad = @$_POST["cantidad"];
$descripcion = @$_POST["descripcion"];
$monto = @$_POST["monto"];
$FormaPago = @$_POST["selectP"];
$NroNotaFactura = @$_POST["codigo"];
$observaciones = @$_POST["observaciones"];

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
        <select name="select" class="form-control" required>
          <option value="fecha">Denis</option>
          <option value="fecha">Alan</option>
          <option value="fecha">Cristian</option>
          <option value="fecha">Juan</option>
          <option value="fecha">Francisco</option>
          <option value="fecha">Manuel</option>
        </select>
      </div>
      <div class="col-2">
        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required/>
      </div>
      <div class="col-6">
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required/>
      </div>
      <div class="col-2">
        <input type="number" name="monto" class="form-control" placeholder="Monto" required/>
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
      <div class="col-6">
        <h4>Observaciones</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-2">
        <select name="selectP" class="form-control" required>
          <option value="producto">Dolares</option>
          <option value="vendedor">Efectivo</option>
          <option value="fecha">Banca Amiga</option>
          <option value="fecha">Mercantil</option>
          <option value="fecha">Venezuela</option>
          <option value="fecha">Pago Movil</option>
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
      <div class="col-6">
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

$consult_ventas = "INSERT INTO ventas_diarias (vendedor, cantidad, descripcion, monto, forma_pago, '$NotaFactura', observaciones)
                    VALUES ('$vendedor','$cantidad','$descripcion','$monto','$FormaPago','$NroNotaFactura','$observaciones')";
$result_ventas = $conexion->query($consult_ventas);
var_dump($result_ventas);

if (@mysqli_num_rows($result_ventas) == true)
 {
   echo '</br>
         </br>
         <section class="container FEs">
           <div class="row">
             <div class="col-12">
                 <h1>Resultado de la busqueda</h1>
             </div>
           </div>
           </br>
           <div class="row">
             <div class="col-1"></div>
               <div class="col-10">
                 <table class="table table-dark">
                   <thead>
                     <tr>
                       <th scope="col">Vendedor</th>
                       <th scope="col">Fecha</th>
                       <th scope="col">Producto</th>
                       <th scope="col">Existencia A.</th>
                       <th scope="col">Existencia N.</th>
                     </tr>
                   </thead>
                   <tbody>';
   while ($columP = mysqli_fetch_array($result_ventas))
     {
       echo '<tr>
               <td>
                 <label>
                   <h6>' . $columP['vendedor'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['fecha'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['producto'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['existenciaA'] . '</h6>
                 </label>
               </td>
               <td>
                 <label>
                   <h6>' . $columP['existenciaN'] . '</h6>
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