<?php
@session_start(); //No lo olvides! A mi me ha dado muchos dolores de cabeza olvidarlo
unset($_SESSION["status"]);
unset($_SESSION["clave"]);
header("Location: ../index.php");
?>
