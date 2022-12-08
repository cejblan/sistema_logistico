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

$select = @$_POST["select"];
$buspro = @$_POST["buspro"];

require_once('php/head.php'); 
require_once('php/conexion.php');

?>

  <section class="container FEs">
    <div class="row">
      <div class="col-12">
          <h1>Historial</h1>
      </div>
      <div class="col-2"></div>
      <div class="col-8">
        <form action="historial.php" method="POST">
          <label>
            <h2>Busqueda:</h2>
          </label>

<?php
if (! $_POST || trim($_POST['buspro'])   === '')
  {
  echo '<div class="row">
          <div class="col-3">
            <select name="select" class="form-control" required>
              <option value="producto">producto</option>
              <option value="vendedor">vendedor</option>
              <option value="fecha">fecha</option>
            </select>
          </div>
          <div class="col-9">
            <input type="select" name="buspro" class="form-control" placeholder="Termino a buscar" required/>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="col-3">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Buscar"/>
          </div>
          <div class="col-9">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
          </div>
        </div>
        </form>
        </div>
        </div>
        </section>
        </br>';
  goto end;
} else {
  echo '<div class="row">
          <div class="col-3">
          <select name="select" class="form-control" required  multiple>
            <option value="producto">producto</option>
            <option value="vendedor">vendedor</option>
            <option value="fecha">fecha</option>
          </select>
          </div>
          <div class="col-9">
            <input type="select" name="buspro" class="form-control" placeholder="Termino a buscar" required/>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="col-3">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Buscar"/>
          </div>
          <div class="col-9">
            <input class="btn btn-success" type="reset" name="borrar" id="borrar" value="Restablecer"/>
          </div>
        </div>
        </form>
        </div>
        </div>
        </section>
        </br>';
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

if($select == 'producto')
  {
    $consult_productos = "SELECT * FROM historial WHERE 'producto' = '$buspro'";
  }

if($select == 'vendedor')
  {
    $consult_productos = "SELECT * FROM historial WHERE 'vendedor' = '$buspro'";
  }

if($select == 'fecha')
  {
    $consult_productos = "SELECT * FROM historial WHERE 'fecha' = '$buspro'";
  }

$result_productos = mysqli_query($conexion,$consult_productos);
var_dump($result_productos);

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
require_once('php/footer.php');

if (isset($regNoEnc))
  {
?>
<section id="alertas">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>   
  <div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <label>
      <strong>Registro no encontrado</strong>
    </label>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">
        <strong>
          <h1>&times;</h1>
        </strong>
      </span>
    </button>
  </div>
  <script>
    $("#alert").show();
    $(".close").click(function(){
                                  $("#alert").hide();
                                });
  </script>
</section>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").fadeOut(3000);
    },3000);
});
$(document).ready(function() {
    setTimeout(function() {
        var x = document.getElementById("alert");
        x.style.setProperty("display", "none", "important");
    },6000);
});
</script>

<?php
    
  }
?>