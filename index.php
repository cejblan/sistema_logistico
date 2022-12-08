<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();    
require_once("php/head.php");

?>
    <section id="cuadricula">
        <div class="container">
            <div class="row">

<?php

if(!isset($_SESSION['administrador']))
  {
    if(!isset($_SESSION['usuario']))
      {
        echo '<div class="col-6 cuadro c1">
                <button>
                    <a href="login.php">
                        <h1 class="ingresar_float"><strong>Ingresar</strong></h1>
                    </a>
                </button>
                </div>
                <div class="col-6 cuadro c2" style="filter: opacity(0.21);">
                  <button>
                      <a href="productos.php">
                          <h1 class="productos_float"><strong>Productos</strong></h1>
                      </a>
                  </button>
              </div>
          </div>
          <div class="row">
              <div class="col-6 cuadro c3" style="filter: opacity(0.21);">
                  <button>
                      <a href="historial.php">
                          <h1 class="historial_float"><strong>Historial</strong></h1>
                      </a>
                  </button>
              </div>
              <div class="col-6 cuadro c4" style="filter: opacity(0.21);">
                  <button>
                      <a href="administrativo.php">
                          <h1 class="productos_float"><strong>Administrativo</strong></h1>
                      </a>
                  </button>
              </div>'; 
        }
          else
              {
                echo '<div class="col-6 cuadro c1-2">
                        <button>
                            <a href="Usuario.php">
                                <h1 class="usuario_float"><strong>Usuario</strong></h1>
                            </a>
                        </button>
                      </div>
                      <div class="col-6 cuadro c2">
                        <button>
                            <a href="productos.php">
                                <h1 class="productos_float"><strong>Productos</strong></h1>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 cuadro c3">
                        <button>
                            <a href="historial.php">
                                <h1 class="historial_float"><strong>Historial</strong></h1>
                            </a>
                        </button>
                    </div>
                    <div class="col-6 cuadro c4" style="filter: opacity(0.21);">
                        <button>
                            <a href="administrativo.php">
                                <h1 class="productos_float"><strong>Administrativo</strong></h1>
                            </a>
                        </button>
                    </div>';
              }
  }
    else
        {
          echo '<div class="col-6 cuadro c1-2">
                  <button>
                      <a href="Usuario.php">
                          <h1 class="usuario_float"><strong>Usuario</strong></h1>
                      </a>
                  </button>
                </div>
                <div class="col-6 cuadro c2">
                  <button>
                      <a href="productos.php">
                          <h1 class="productos_float"><strong>Productos</strong></h1>
                      </a>
                  </button>
              </div>
          </div>
          <div class="row">
              <div class="col-6 cuadro c3">
                  <button>
                      <a href="historial.php">
                          <h1 class="historial_float"><strong>Historial</strong></h1>
                      </a>
                  </button>
              </div>
              <div class="col-6 cuadro c4">
                  <button>
                      <a href="administrativo.php">
                          <h1 class="productos_float"><strong>Administrativo</strong></h1>
                      </a>
                  </button>
              </div>';
        }

?>
                
            </div>
        </div>
    </section>

<?php
require_once("php/footer.php");

if(!isset($_SESSION['administrador']) and !isset($_SESSION['usuario']))
  {
?>
<section id="alertas">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>      
  <div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <label>
      <strong>¡Debes inciar session!</strong>
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

if (isset($_COOKIE["administrador"]) or isset($_COOKIE["IngUsuario"]))
  {
?>
<section id="alertas">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
  </svg>      
  <div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <label>
      <strong>
        <?php
        if (isset($_COOKIE["administrador"]))
          {
            echo '¡A inciado session como administrador!';
          } else {
                    echo '¡A inciado session!';
                  }
      ?>    
      </strong>
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
