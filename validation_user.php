<?php
 session_start();
 require_once('DataBase.php');
 $db=new DataBase();
if(isset($_POST['user_name']) && isset($_POST['pass'])){
	        $row=$db->RetriveByCondition("rzbac701_rolandoz_correo_clie","tbl_usuario",array("user"=>$_POST['user_name'],"pass"=>$_POST['pass']));
			if(sizeof($row)>0){
			 
			    $_SESSION['user']=$row[0]['user'];	
				 $result['result']=1;
				 echo json_encode($result);	
		    }
			else{
			     $result['result']=0;
				 echo json_encode($result);	
 			
			}
	} 

?>