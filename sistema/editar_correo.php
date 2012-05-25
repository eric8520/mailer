
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar Nuevo Correo</title>



<script type="text/javascript">
function validarcampos(){
   
    if(document.getElementById('archivo').value == null || document.getElementById('archivo').length == 0 || /^\s+$/.test(document.getElementById('archivo').value)){
	  alert('Es obligatorio llenar el campo imagen');
	  document.getElementById('archivo').focus();
	  return(false);
	}
	else if(document.getElementById('from').value==null || document.getElementById('from').length == 0 || /^\s+$/.test(document.getElementById('from').value)){
	  alert('Es obligatorio llenar el campo from');
	  document.getElementById('from').focus();
	  return(false);
	}
	else if(document.getElementById('name').value==null || document.getElementById('name').length == 0 || /^\s+$/.test(document.getElementById('name').value)){
	  alert('Es obligatorio llenar el campo name');
	  document.getElementById('name').focus();
	  return(false);
	}
	else if(document.getElementById('subject').value==null || document.getElementById('subject').length == 0 || /^\s+$/.test(document.getElementById('subject').value)){
	  alert('Es obligatorio llenar el campo subject');
	  document.getElementById('subject').focus();
	  return(false);
	}
	if(confirm("¿Son correctos los datos?")){
	return(true);
	}
	else{
		  return false;
		}
  }
</script>
</head>
<body bgcolor="#003366">

<form name="forme" id="forme" action="editar_correo.php" method="post" enctype="multipart/form-data" onsubmit="return validarcampos()" >

  <table width="916" height="221" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    <table width="528" height="122" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="42" colspan="4" align="center"><p class="titulo">Cargar mail</p></td>
        </tr>
        <tr>
          <td width="59" height="39" align="left"><span class="Etiquetas">Nombre:</span></td>
          <td width="469" colspan="3">
            <input type="file" name="archivo" id="archivo" size="40" />
            
            <input name="action" type="hidden" value="upload" />                         
            </td>
        </tr>
        <tr>
          <td width="59" height="39" align="left"><span class="Etiquetas">From:</span></td>
          <td width="469" colspan="3"><label>
            <input type="text" name="from" id="from" value="" size="70" />
          </label>           </td>
        </tr>
        <tr>
          <td width="59" height="39" align="left"><span class="Etiquetas">Name:</span></td>
          <td width="469" colspan="3"><label>
            <input type="text" name="name" id="name" size="70" />
          </label>           </td>
        </tr>
        <tr>
          <td width="59" height="39" align="left"><span class="Etiquetas">Subject:</span></td>
          <td width="469" colspan="3"><label>
            <input type="text" name="subject" id="subject" size="70" />
          </label>           </td>
        </tr>
        <tr>
          <td height="41" colspan="4" align="center">            
          <input name="nuevo" id="nuevo" type="submit" value="&lt;&lt;Subir&gt;&gt;" />          </td>
        </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="#4F7488">
    
    </td>
    </tr>
  </table>
  </form>
</body>
</html>

<?php
//include("../includes/conex_cliente.php");
include("../DataBase.php");
$db=new DataBase();
if(isset($_POST['from']) && isset($_POST['name']) && isset($_POST['subject'])){
$from=$_POST['from'];
$name=utf8_decode($_POST['name']);
$subject=utf8_decode($_POST['subject']);
$status = "Activo";
$fecha=date("Y-m-d");
if(isset($_POST['nuevo'])){
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    $tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
    $prefijo = substr(md5(uniqid(rand())),0,6);
   
    if ($archivo != "" && $from != "" && $name != "" && $subject != "") {
        // guardamos el archivo a la carpeta files
       // $destino =  "../uploads/".$prefijo."_".$archivo;
         $destino= "../uploads/".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
            //$status = "Archivo subido: <b>".$archivo."</b>";
			/*mysql_query("insert into tbl_editar_correo(cmensaje, cstatus, cfrom, cname, csubject,dtfechaa) values ('$destino', '$status', '$from', '$name', '$subject', '$fecha')");*/
			$ruta="http://".$_SERVER['SERVER_NAME']."/sistema_mailing/uploads/".$archivo;
		     
		    
			
			$valores=array($ruta,$status,$from,$name,$subject,$fecha);
			
            $db->Insert($valores,"rzbac701_rolandoz_correo_clie","tbl_editar_correo",true,$total);
           
			  echo $db->mysql_error();
		   echo "<script>alert('Se guardo la información perfectamente');</script>";
		    
		   echo "<script> location.href='carga_mail.php'</script>";
			
        } else {
            echo "<script>alert('Error al subir el archivo');</script>";
        }
    } else {
        echo "<script>alert('Error al subir el archivo');</script>";
    }
}
}
}
?>
