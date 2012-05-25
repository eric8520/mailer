
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cargar registros</title>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="../../css/progressbar.css" />


<script type="text/javascript">

function validarcampos(){
  //alert('mensajes');
    
    if(document.getElementById('archivo').value==''){
	  alert('Es obligatorio llenar el campo imagen');
	  document.getElementById('archivo').focus();
	  return(false);
	}
	else if(document.getElementById('from').value==''){
	  alert('Es obligatorio llenar el campo from');
	  document.getElementById('from').focus();
	  return(false);
	}
	else if(document.getElementById('name').value==''){
	  alert('Es obligatorio llenar el campo name');
	  document.getElementById('name').focus();
	  return(false);
	}
	else if(document.getElementById('subject').value==''){
	  alert('Es obligatorio llenar el campo subject');
	  document.getElementById('subject').focus();
	  return(false);
	}
	
	return(true);	 
	
  }
</script>
</head>
<body>

<form name="forme" id="forme" action="cargar_db.php" method="post" enctype="multipart/form-data" onsubmit="return validarcampos()" >

  <table width="916" height="221" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    <table width="528" height="122" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="42" colspan="4" align="center"><p class="titulo">Cargar db</p></td>
        </tr>
        <tr>
          <td width="59" height="39" align="left"><span class="Etiquetas">Seleccione un archivo:</span></td>
          <td width="469" colspan="3">
            <input type="file" name="archivo" id="archivo" size="40" />
            <input type="submit" name="importar" value="Importar"  id='importar'/>
            <input name="action" type="hidden" value="upload" />                         
            </td>
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
include("../DataBase.php");
$db=new DataBase();

$fecha=date("Y-m-d");
if(isset($_POST['importar'])){
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    $tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
    $prefijo = substr(md5(uniqid(rand())),0,6);
   
    if ($archivo != "") {
        // guardamos el archivo a la carpeta files
        //$destino =  "../cargar_db/".$prefijo."_".$archivo;
        $destino="../cargar_db/".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
           
		            $archivo="http://".$_SERVER['SERVER_NAME']."/sistema_mailing/cargar_db/".$archivo;
					$arrResult = array();
  					$handle = fopen($archivo, "r");
					$total=0;
					$coneccion=mysql_connect($db->host,$db->user,$db->pass);
					mysql_select_db("rzbac701_rolandoz_correo_clie",$coneccion);
					$sql="INSERT INTO tbl_correo (ccorreo) VALUES";
					$total=sizeof($arrResult);
					
					$i=1;
  					if( $handle ) {
    				while (($data = fgetcsv($handle, 1000,";")) !== FALSE) {
      					      
						        $sql.=sprintf("('%s'),", $data[1]);
								
								
								
						   
						 
						   $i++;  
					 
    				}
    				fclose($handle);
  					}
					
					$sql=rtrim($sql,',');
					
					$res=mysql_query($sql,$coneccion);
					
				   
					
					
					echo "<script>alert('Se ha importado correctamente')</script>";
                  
                  
			
        } else {
            echo "<script>alert('Error al subir el archivo');</script>";
        }
    } else {
        echo "<script>alert('Error al subir el archivo');</script>";
    }
}
}

?>

