<?php
     $json=json_decode($_POST["email"]);
	 include_once('class.phpmailer.php');
	 $mail    = new PHPMailer();
	 $mail->IsSMTP();
	 $mail->SMTPAuth = true;
	 //$mail->Host = "mail.rolandozapatamail.org"; // SMTP a utilizar. Por ej. smtp.elserver.com
	 //$mail->Username = "info@rolandozapatamail.org"; // Correo completo a utilizar
	 //$mail->Password = "info2012"; // Contraseña
	 $mail->Host="mail.rzactivate.com";
	 $mail->Username="contacto@rzactivate.com";
	 $mail->Port = 25; // Puerto a utilizar
	 require_once('../DataBase.php');
      $db=new DataBase();
	  $band=true;
	  $result=$db->Retrive_LAST_INSERT("rzbac701_rolandoz_correo_clie","tbl_editar_correo","id_editar");
	  
	 for($i=0;$i<sizeof($json->mails);$i++){
		   
	         $mail->From = "contacto@rzactivate.com";

					//nombre del correo Primer nombre

			$mail->FromName = $result["cname"];

					//Asunto del correo Subject

			$mail->Subject = $result["csubject"];

					//nose que es jaja

					//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

					
            $body=file_get_contents($result["cmensaje"]); 
			$mail->MsgHTML($body);

					
                   
					$mail->AddAddress($json->mails[$i]);

					$mail->IsHTML(true); // El correo se envía como HTML

					if(!$mail->Send()) {
                          $band=false;
						

					} 								

						     
	  }
	if($band==true){
	      $mess=true;
	 }
	 else{
		   $mess=false;
		 }
		 
	 $message["success"]=$mess;
	 echo json_encode($message);
?>