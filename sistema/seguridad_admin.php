<?php
//Inicio de sesion
@session_start();
$autentificado=$_SESSION["status"];
//echo $autentificado = "SI";
//COMPRUEBA QUE EL USUSARIO ESTA AUTENTIFICADO
if (empty($_SESSION["status"])){
//echo "Bienvenido";
//si no existe, envio a la pagina de autenficacion
header("Location: ../index.php");
//ademas salgo de este script
exit();
}
?>