<?php
include("../DataBase.php");
$db=new DataBase();
$result=$db->Retrive_LAST_INSERT("rzbac701_rolandoz_correo_clie","tbl_editar_correo","id_editar");
$row=$db->RetriveByRow($result,"rzbac701_rolandoz_correo_clie","tbl_editar_correo","id_editar");

$data["Nombre"]=$row[0][4];
$data["From"]=$row[0][3];
 $archivo="http://".$_SERVER['SERVER_NAME']."/sistema_mailing/uploads/madres.html";
  
 $string=file_get_contents($archivo);

$data["Mensaje"]=utf8_encode($string);

$data["Subject"]=$row[0][5];
echo json_encode($data);	
	
?>