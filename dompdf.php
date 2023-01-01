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

// Se guarda el contenido de historial_PDF.php en la variable html
ob_start();
require "historial_PDF.php";
$htmlpdf = ob_get_clean();

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($htmlpdf);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

// administrativo.php
header("Location: administrativo.php", TRUE, 301);