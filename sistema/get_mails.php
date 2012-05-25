<?php
    require_once('../DataBase.php');
     $db=new DataBase();
	 $result=$db->RetriveByLimit("rzbac701_rolandoz_correo_clie","tbl_correo",$_POST['init'],$_POST['fin']);

	 $mails=array("Id"=>array(),"Correo"=>array());
	 $i=0;
	 foreach($result as  $row){
		      $mails["Id"][]=$row["id_correo"];
			  $mails["Correo"][]=$row["ccorreo"]; 
			  
		 
		 }
	$data["mails"]=$mails;
	echo json_encode($data);
	 
?>