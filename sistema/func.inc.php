<?
/**************************************************/
/*  ISC. Joan Machado							  */
/*  www.spacioweb.com.mx						  */
/**************************************************/

//include_once("config.php");
function redirect($url){
	?>
	<script type="text/javascript">
	window.location.href='<?=$url?>';
	</script>
	<?
}

function Pass_Aleatorio(){
	$password ="";
	//Longitud del password generado
	$tamano = 6;
	$caracteres = "abchefghjkmnpqrstuvwxyz0123456789";
	srand((double)microtime()*1000000);
	$i = 0; 
	while ($i <= $tamano) { 
		$num = rand() % 33; 
		//echo $num."<br>";
		$temp = substr($caracteres, $num, 1); 
		$password = $password . $temp; 
		$i++; 
	}
	$password2[0] = $password;
	$password2[1] = md5($password);
	return $password2;
}

//Modificar el formato de la funcion Send_Mail para ada usuario
function Send_Mail($envia,$recibe,$Datos,$Ruta_Img,$Asunto,$title=""){
	/*if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $envia) ){
		exit();
	}*/
	
	//para el envío en formato HTML
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

	//dirección del remitente
	$headers .= "From: <".$envia.">\r\n";

	//dirección de respuesta, si queremos que sea distinta que la del remitente
	$headers .= "Reply-To: ".MAIL."\r\n";

	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".MAIL."\r\n";

	//direcciones que recibián copia
	//$headers .= "Cc: joan@web-lab.com.mx\r\n";

	//direcciones que recibirán copia oculta
	$headers .= "Bcc: ".EMAILWEB."\r\n";

	$fecha = date("d-m-Y");
	$message = '
<html>
<head>
<title>$title</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table width="70%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#000000">
	<tr bgcolor="#FFFFFF"> 
		<td>
			<table width="100%">				
				<tr>
					<td align="center" height="2"  bgcolor="#FFFFFF" valign="middle" style="border:1px solid #000000"><img src="'.$Ruta_Img.'"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style="padding-left:30px;">Fecha: '.$fecha.'</td>
				</tr>
				<tr>
					<td style="padding-left:30px;" bgcolor="#FFFFFF">'.$Datos.'</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
';

	if(mail($recibe,$Asunto,$message,$headers)){
		return true;
	}else{
		return false;
	}
}

function ToMktime($date){
	$valores = split("[-/.]",$date);
	$dia = $valores[0];
	$mes = $valores[1];
	$anio = $valores[2];
	$tstamp = mktime(0, 0, 0, $mes, $dia, $anio);
	return $tstamp;
}

function ToDate($MkTime){
	$fecha = date("d-m-Y", $MkTime);
	return $fecha;	
}


function Read_GenerateFile($FileName,$HideContent){
	/* verificamos si existe el archivo Header, si no existe, lo creamos */
	if(!file_exists(ROOT."/disHTML/".$FileName)){
		$fp=fopen(ROOT."/disHTML/".$FileName,"a");
		fclose($fp);
	}
	/* abrimos en archivo Header */
	$gestor = fopen(ROOT."/disHTML/".$FileName, "r+");
	$Contenido[$HideContent] = "";
	if ($gestor) {
		while (!feof($gestor)) {
			$Contenido[$HideContent] .= fgets($gestor);
		}
		fclose ($gestor);
	}
	return $Contenido[$HideContent];
}

function acentos($Cadena){
	$Cadena = str_replace('á','&aacute;',$Cadena);
	$Cadena = str_replace('é','&eacute;',$Cadena);
	$Cadena = str_replace('í','&iacute;',$Cadena);
	$Cadena = str_replace('ó','&oacute;',$Cadena);
	$Cadena = str_replace('ú','&uacute;',$Cadena);
	$Cadena = str_replace('Á','&Aacute;',$Cadena);
	$Cadena = str_replace('É','&Eacute;',$Cadena);
	$Cadena = str_replace('Í','&Iacute;',$Cadena);
	$Cadena = str_replace('Ó','&Oacute;',$Cadena);
	$Cadena = str_replace('Ú','&Uacute;',$Cadena);
	$Cadena = str_replace('ñ','&ntilde;',$Cadena);
	$Cadena = str_replace('Ñ','&Ntilde;',$Cadena);
	$Cadena = str_replace('ä','&auml;',$Cadena);
	$Cadena = str_replace('ë','&euml;',$Cadena);
	$Cadena = str_replace('ï','&iuml;',$Cadena);
	$Cadena = str_replace('ö','&ouml;',$Cadena);
	$Cadena = str_replace('ü','&uuml;',$Cadena);
	$Cadena = str_replace('Ä','&Auml;',$Cadena);
	$Cadena = str_replace('Ë','&Euml;',$Cadena);
	$Cadena = str_replace('Ï','&Iuml;',$Cadena);
	$Cadena = str_replace('Ö','&Ouml;',$Cadena);
	$Cadena = str_replace('Ü','&Uuml;',$Cadena);
	$Cadena = str_replace('²','&sup2;',$Cadena);
	$Cadena = str_replace('¿','&iquest;',$Cadena);
	$Cadena = str_replace('¡','&iexcl;',$Cadena);
	return $Cadena;
}

function mydate($fecha){ 
    $fecha= strtotime($fecha); // conviertimos la fecha de formato yyyy-mm-dd a marca de tiempo 
    $dia=date("d",$fecha); // día del mes en número 
    $mes=date("m",$fecha); // número del mes de 01 a 12 
       switch($mes){ 
       case "01": 
          $mes="Ene"; 
          break; 
       case "02": 
          $mes="Feb"; 
          break; 
       case "03": 
          $mes="Mar"; 
          break; 
       case "04": 
          $mes="Abr"; 
          break; 
       case "05": 
          $mes="May"; 
          break; 
       case "06": 
          $mes="Jun"; 
          break; 
       case "07": 
          $mes="Jul"; 
          break; 
       case "08": 
          $mes="Ago"; 
          break; 
       case "09": 
          $mes="Sep"; 
          break; 
       case "10": 
          $mes="Oct"; 
          break; 
       case "11": 
          $mes="Nov"; 
          break; 
       case "12": 
          $mes="Dic"; 
          break; 
       } 
    $ano=date("Y",$fecha); // obtenemos el año en formato 4 digitos 
    $fecha= $dia."-".$mes."-".$ano; // unimos el resultado en una unica cadena
    return $fecha;
}

function mydatefull($fecha){ 
    $fecha= strtotime($fecha); // conviertimos la fecha de formato yyyy-mm-dd a marca de tiempo 
    $dia=date("d",$fecha); // numero del dia 
	$day=date("l",$fecha); // dia del mes 
    $mes=date("m",$fecha); // número del mes de 01 a 12 
       switch($mes){ 
       case "01": 
          $mes="Enero"; 
          break; 
       case "02": 
          $mes="Febrero"; 
          break; 
       case "03": 
          $mes="Marzo"; 
          break; 
       case "04": 
          $mes="Abril"; 
          break; 
       case "05": 
          $mes="Mayo"; 
          break; 
       case "06": 
          $mes="Junio"; 
          break; 
       case "07": 
          $mes="Julio"; 
          break; 
       case "08": 
          $mes="Agosto"; 
          break; 
       case "09": 
          $mes="Septiembre"; 
          break; 
       case "10": 
          $mes="Octubre"; 
          break; 
       case "11": 
          $mes="Noviembre"; 
          break; 
       case "12": 
          $mes="Diciembre"; 
          break; 
       } 
    $ano=date("Y",$fecha); // obtenemos el año en formato 4 digitos 
	
	$dias = array('Monday' => 'Lunes', 'Tuesday' => 'Martes','Wednesday' => 'Mi&eacute;rcoles','Thursday' => 'Jueves','Friday' => 'Viernes','Saturday' => 'Sabado','Sunday' => 'Domingo');
	
    $fecha= $dias[$day].", ".$dia." de ".$mes." de ".$ano; // unimos el resultado en una unica cadena
    return $fecha;
}

/*************************************************************
Funcion Dia - Función que nos regresa el nombre de los dias.
$d -	El número de día que se convertirá
$i -	Recibe dos tipos de valores 1 y 0,
			0 - Devuelve los nombre abreviados
		    1 - Devuelve los nombre Completos
**************************************************************/
function Dia($d,$i){
	$j=0;
	is_numeric($i) ? ( $i==0||$i==1 ? $j=$i : $j=0) : $j=0;
	$dia = array ( 0 => array(
							0 => "Dom",
							1 => "Lun",
							2 => "Mar",
							3 => "Mie",
							4 => "Jue",
							5 => "Vie",
							6 => "Sab"
							),
					1 => array(
							0 => "Domingo",
							1 => "Lunes",
							2 => "Martes",
							3 => "Miércoles",
							4 => "Jueves",
							5 => "Viernes",
							6 => "Sábado"
							)
				);
	return $dia[$j][$d];
}

/*************************************************************
Funcion Mes - Función que nos regresa el nombre de los meses.
$m -	El número de mes que se convertirá a letras
$i -	Recibe dos tipos de valores 1 y 0,
			0 - Devuelve los nombres abreviados
		    1 - Devuelve los nombres Completos
**************************************************************/
function Mes($m, $i = 0){
	$j=0;
	is_numeric ( $i ) ? ( $i == 0 || $i == 1 ? $j = $i : $j = 0 ) : $j = 0;
	$mes = array ( 0 => array(
					"01" => "Ene",
					"02" => "Feb",
					"03" => "Mar",
					"04" => "Abr",
					"05" => "May",
					"06" => "Jun",
					"07" => "Jul",
					"08" => "Ago",
					"09" => "Sep",
					"10" => "Oct",
					"11" => "Nov",
					"12" => "Dic"
					),
		1 => array(
				"01" => "Enero",
				"02" => "Febrero",
				"03" => "Marzo",
				"04" => "Abril",
				"05" => "Mayo",
				"06" => "Junio",
				"07" => "Julio",
				"08" => "Agosto",
				"09" => "Septiembre",
				"10" => "Octubre",
				"11" => "Noviembre",
				"12" => "Diciembre"
		)
	);
	return  $mes[$j][$m];
}

function dia_semana ($dia, $mes, $ano){
	$dias = array('Dom.', 'Lun.', 'Mar.', 'Mi&eacute;r;.', 'Jue.', 'Vie.', 'S&aacute;b.');
	return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
}

/*$URI = $_SERVER['REQUEST_URI'];	
function filtraPalabras($text) {
        $elements = array ("select","by","script","alert","'","--","*");
        for($i=0;$i<sizeof($elements);$i++) {
                if(eregi($elements[$i],trim($text))) 
				return true;
        }
        return false;
} 
if(filtraPalabras($URI)) { 
	redirect('http://'.$_SERVER['SERVER_NAME'].'/teatro');
}*/

function RestarHoras($horaini,$horafin){
    $horai=substr($horaini,0,2);
    $mini=substr($horaini,3,2);
    $segi=substr($horaini,6,2);
 
    $horaf=substr($horafin,0,2);
    $minf=substr($horafin,3,2);
    $segf=substr($horafin,6,2);
 
    $ini=((($horai*60)*60)+($mini*60)+$segi);
    $fin=((($horaf*60)*60)+($minf*60)+$segf);
 
    $dif=$fin-$ini;
 
    $difh=floor($dif/3600);
    $difm=floor(($dif-($difh*3600))/60);
    $difs=$dif-($difm*60)-($difh*3600);
    return date("H:i",mktime($difh,$difm));
    //return date("H-i-s",mktime($difh,$difm,$difs));
}

function getFolio(){
$q="SELECT folio FROM tbl_ventas_seq";
$o=mysql_query($q);

if($o){
$r=mysql_fetch_row($o);
$folio=$r[0];
return $folio;
}
else
return 0;
}


?>