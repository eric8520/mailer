<?php include("../seguridad_admin.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="ajax_cliente_correo.js"></script>
<title>Detalle de la Empresa</title>
<?php
include ("../../includes/conex_cliente.php");
$link=Conectarse();
include_once("../../xajax/xajax.inc.php");
$xajax = new xajax("ajax_datos.php");
$xajax -> setCharEncoding("ISO-8859-1");
$xajax -> waitCursorOff();
$xajax -> statusMessagesOn();
$xajax -> decodeUTF8InputOn();
$xajax -> registerFunction("nuevos");
$xajax -> registerFunction("eliminar");
$xajax -> registerFunction("buscar");
$xajax -> registerFunction("modificar");

$xajax -> printJavascript("../../xajax/");
?>
<?php 
include("../../css/format.css");
$clave=$_POST['botonradio'];
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
  function modificar(){
  //alert('mensajes');
  if(document.getElementById("modi").value==''){
    alert("Introduzca la informacion a modificar");
	document.getElementById("modi").focus();
  }
  else{
	 xajax_modificar(xajax.getFormValues('forme'));
  }	
  }
  
function validar() {
	opciones = document.getElementsByName("opcion");
	 
	var seleccionado = false;
	for(var i=0; i<opciones.length; i++) {	
	  if(opciones[i].checked) {  
		seleccionado = true;		
		if(document.getElementById("valor").value==''){
		  alert("Introduzca la información para agregar");
		  document.getElementById("valor").focus();
		}
		else{
		xajax_nuevos(xajax.getFormValues('forme'));
		}
		break;
	  }
	} 
	if(!seleccionado) {
	alert("Seleccione la opción que desea agregar");
	  return false;
	}
}

</script>
</head>
<body bgcolor="#003366">

<form name="forme" id="forme" method="post">
<?php include("header.php"); ?>
  <table width="916" height="355" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
    <tr>
      <td height="43" colspan="4" align="center" valign="middle">
     <span class="titulo">Emails y Moviles</span>
     </td>
    </tr>    
    <tr>
      <td height="93" colspan="4" align="center" valign="top" bgcolor="#006699">
      <table width="481" align="center" bgcolor="#006699">
      <tr>
        <td colspan="2" align="center"><div class="subtitulos">AGREGAR NUEVO RÉGISTRO
          <input type="hidden" name="id_emp" id="id_emp" value="1" />
        </div></td>
        </tr>
      <tr>
      <td align="right">
         <input type="radio" name="opcion" id="correo" value="correo" /> Nuevo Correo      </td>
      <td align="left">
         <input type="radio" name="opcion" id="movil" value="movil"/> Nuevo Movil      </td>                  
      </tr>
      <tr>
      <td colspan="2" align="center">
         <input type="text" name="valor" id="valor" value="" size="50" />
         <input type="button" value="Agregar Nuevo" onclick="validar()"/>      </td>
      </tr>
      </table>      </td>
    </tr>
    <tr>
      <td height="35" colspan="2" align="center" ><div class="subtitulos">RÉGISTROS ENCONTRADOS</div></td>
    </tr>
    <tr>
    <td height="55" colspan="2" align="center" >
        <table width="638" border="0" cellpadding="0" cellspacing="0" >
          <td width="550" align="center" valign="top" > 
		  <div id="contenido">
             <?php include("paginador_correo.php"); ?>            
          </div>   
		  </td>                      
    </tr>
    <tr>
    <td align="center">
        <table width="879" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>--------------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        </table>
    </td>
    </tr>
    <tr>
    <td height="58" align="center">   
    <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center"><div class="subtitulos">MODIFICAR RÉGISTROS</div></td>
    </tr>
    <tr>
    <td>    
    <input type="text" name="modi" id="modi" size="50" />
    <input type="hidden" name="clave" id="clave" />
    <input type="hidden" name="status" id="status" /> 
    <input type="button" value="Modificar" onclick="modificar()" />    </td>
    </tr>
    </table>    
    </td>
    </tr>
    <tr>
    <td bgcolor="#4F7488">
     <?php include("pie.php"); ?>    
    </td>
    </tr>   
  </table>
</form>
</body>
</html>