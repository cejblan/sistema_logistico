<?php
session_start();

require_once('conexion.php');

$destino = "c:/Users/Usuario/Desktop/foto.jpg";
$ancho = 400;
$alto = 400;

if($_FILES['foto']['error'] === UPLOAD_ERR_OK)
  {
    $foto_original = $_FILES['foto']['tmp_name'];
    $img_original = imagecreatefromjpeg($foto_original);
    $ancho_original = imagesx($img_original);
    $alto_original = imagesy($img_original);
    $tmp = imagecreatetruecolor($ancho, $alto);
    $copy = imagecopyresized($tmp, $img_original, 0,0,0,0, $ancho, $alto, $ancho_original, $alto_original);
    imagejpeg($tmp, $destino, 100);
    echo "<script>
          alert('Redimensionada con exito y guardada en el escritorio.');
          window.location = '/registro.php';
        </script>";
  }

?>