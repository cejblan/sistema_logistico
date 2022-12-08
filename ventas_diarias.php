<?php
$lifetime=300;
session_set_cookie_params($lifetime);
session_start();

require_once("php/head.php");
?>

<?php

require_once("php/footer.php");

?>