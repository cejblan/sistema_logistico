<?php

@$servidor = "localhost"; 
@$cedula = "root";
@$clave = "";

@$conexion = mysqli_connect($servidor, $cedula, $clave);
if($conexion) 
  {
    @$conexion->set_charset("utf8");
  }

@$BD = "sistema_logistico";
@$sistema_logistico = mysqli_select_db($conexion,$BD);

?>