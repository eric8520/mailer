<?php
include('../includes/conex_cliente.php');
$link=Conectarse();
$RegistrosAMostrar=30;

//estos valores los recibo por GET
if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
//caso contrario los iniciamos
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}
$Resultado=mysql_query("SELECT * FROM tbl_correo ORDER BY id_correo LIMIT $RegistrosAEmpezar, $RegistrosAMostrar");
?>
<table width="393" border="0" cellpadding="0" cellspacing="0">
<tr class="inte">
                  <td align="center" colspan="3"><span class="head">CORREOS</span></td>
                </tr>
                <?php				
                while($MostrarFila=mysql_fetch_array($Resultado)){
                  $id=$MostrarFila["id_correo"];
				  $nombre=$MostrarFila["ccorreo"];				  
				  $stat=$MostrarFila["cstatus"];
                   ?>
                <tr class="color">
                  <td width="351" align="left"><span class="registros"><?php echo $nombre;?></span></td>
				  
				  <td width="19" align="center"><img src="../img/edit.png" border="0" title="Editar" onclick="if(confirm('¿Esta seguro de modificar los datos del correo electrónico?')){ xajax_buscar(<?=$id?>,<?=$stat?>);}" style="cursor:pointer;" /></td>
				  <td width="23" align="center"><img src="../img/cancel.png" border="0" title="Eliminar" onclick="if(confirm('¿Esta seguro de querer eliminar el correo electrónico?')){ xajax_eliminar(<?=$id?>,<?=$stat?>);}" style="cursor:pointer;" /></td>
                </tr><?php
                }
                ?>                
            </table>
<?php
//******--------determinar las páginas---------******//
$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM tbl_correo"));

$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
if($Res>0) $PagUlt=floor($PagUlt)+1;

//desplazamiento
echo "<a onclick=\"Pagina('1')\" class='link_pag'>Primero</a> ";
if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\" class='link_pag'>Anterior</a> ";
echo "<strong class='cont_pag'>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\" class='link_pag'>Siguiente</a> ";
echo "<a onclick=\"Pagina('$PagUlt')\" class='link_pag'>Ultimo</a>";


?>