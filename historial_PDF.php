<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

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

require_once('php/head.php'); 
require_once('php/conexion.php');

?>

  <section class="container FEs">
    <div class="row">
      <div class="col-12">
          <h1>Historial</h1>
      </div>
      <div class="col-12">
      </div>
    </div>
  </section>
  </br>

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

$consult_productos = "SELECT * FROM historial_movimientos WHERE producto = '$buspro'";
$result_productos = mysqli_query($conexion,$consult_productos);

if (@mysqli_num_rows($result_productos) == true)
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
             <div class="col-12">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>
                        <label>Vendedor</label>
                      </th>
                      <th>
                        <label>Fecha</label>
                      </th>
                      <th>
                        <label>Producto</label>
                      </th>
                      <th>
                        <label>Existencia A.</label>
                      </th>
                      <th>
                        <label>Existencia N.</label>
                      </th>
                    </tr>
                  </thead>
                  <tbody>';
   while ($columP = mysqli_fetch_array($result_productos))
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
         print('Registro no encontrado'); 
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
require_once('php/footer.php');
?>