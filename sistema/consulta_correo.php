<?php include("seguridad_admin.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta correos</title>
<?php
//include("header.php");
include_once("../xajax/xajax.inc.php");
$xajax = new xajax("ajax_datos.php");
$xajax -> setCharEncoding("ISO-8859-1");
$xajax -> waitCursorOff();
$xajax -> statusMessagesOn();
$xajax -> decodeUTF8InputOn();
$xajax -> registerFunction("busca_correo");
$xajax -> registerFunction("elimina_correo");

$xajax -> printJavascript("../xajax/");
?>
<?php 
	include("../css/format.css");
	include("../includes/conex_cliente.php");
	$link=Conectarse();
	$id=$_GET[id];	
	$correo=$_GET[correo];	
?>
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:239px;
	top:58px;
	width:307px;
	height:277px;
	z-index:1;
}
</style>

<script type="text/javascript">
function validarcorreo(){
  //alert('mensajes');
    if(document.getElementById('correo').value==''){
	  alert('Es obligatorio llenar el campo empresa');
	  document.getElementById('correo').focus();
	}
	else{
	  xajax_busca_correo(xajax.getFormValues('forme'));
	}
}
</script>
</head>
<body bgcolor="#003366">
<form name="forme" id="forme" action="" method="post">
<?php include("header.php"); ?>
  <table width="916" height="195" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
    <tr>
    <td height="83" valign="top">
    <table width="435" height="73" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="33" colspan="4" align="center"><p class="titulo">BUSCAR CORREO</p></td>
        </tr>
        <tr>
          <td width="56" height="40" align="left"><span class="Etiquetas">Buscar:</span></td>
          <td width="447" colspan="3">
            <input type="text" name="correo" id="correo" size="40" onblur="validarcorreo()" />
            <input name="nuevo" id="nuevo" type="button" value="Buscar.." class="button" width="10" onclick="validarcorreo()"  /></td>
        </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td height="92">
    <table width="852" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        <td align="center"><span class="subtitulos">RÉGISTROS ENCONTRADOS</span></td>
        </tr>
        <tr>        
        <td>
        <table width="846" border="0" cellpadding="0" cellspacing="0">
            <tr class="inte">
            <td width="60" align="center"><span class="head">CLAVE</span></td>
            <td width="298" align="center"><span class="head">NAME</span></td>
            <td width="316" align="left"><span class="head">SUBJECT</span></td>
            <td width="81" align="left"><span class="head">FECHA</span></td>
            <td colspan="3" align="center"><span class="head">OPCIONES</span></td>
            </tr>
            <tr>                    
            </tr>
            <tr>
            <?php 					
			$resul=mysql_query("select * from tbl_editar_correo where cfrom LIKE '%".$correo."%' or dtfechaa='".$correo."' or csubject LIKE '%".$correo."%'");
		
			  while($row=mysql_fetch_array($resul)){		
			  $id=$row['id_editar'];	
			  $fecha=$row['dtfechaa'];	
			  $name=utf8_encode($row['cname']);
			  $subject=utf8_encode($row['csubject']);	
			  $from=utf8_encode($row['cfrom']);		  
			?>
            <tr class="color">
            <td align="center">
            <span class="registros"><?php echo $id; ?></span>
            </td>
            <td align="left">
            <span class="registros"><?php echo $name; ?></span>
            </td>
            <td align="left">
            <span class="registros"><?php echo $subject; ?></span>
            </td>
            <td align="left">
            <span class="registros"><?php echo $fecha; ?></span>
            </td>
            <td width="34" align="center" ><img src="../img/det.png" width="17" height="16" border="0" style="cursor:pointer;" title="Detalle" onclick="if(confirm('¿Ver información del correo?')){ location.href='enviar_correos.php';}" /></td>
            <td width="29" align="center" ><img src="../img/edit.png" border="0" title="Editar" onclick="if(confirm('¿Esta seguro de modificar los datos del correo?')){ location.href='mod_correo.php?id=<?=$id?>';}" style="cursor:pointer;" /></td>
				  <td width="28" align="center" ><img src="../img/cancel.png" border="0" title="Eliminar" onclick="if(confirm('¿Esta seguro de querer eliminar la información del correo?')){ xajax_elimina_correo(<?=$id?>);}" style="cursor:pointer;" /></td>
            </tr>            
            <?php							
			  }								
		 mysql_free_result($resul);	
			?>  
            <tr>
            <td colspan="6" height="15">
            </td>
            </tr>     
        </table>
        </td>
        </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td height="20" bgcolor="#4F7488">
    <?php include("pie.php"); ?>
    </td>
    </tr>
  </table>
</form>
</body>
</html>

