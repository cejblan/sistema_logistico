<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();
session_destroy();

if(@$_SESSION['usuario'] == true or @$_SESSION['administrador'] == true)
  {
    header("Location: logout.php", TRUE, 301);
    exit();
  }
require_once('php/head.php');
?>

</br>
<section id="logout" class="container">
  <div class="row">
    <div class="col-12">
        <h1 align="center">Sesión Cerrada <strong>¡Vuelva pronto!</strong></h1>
    </div>
  </div>
</section>

<?php
  require_once("php/footer.php");
?>