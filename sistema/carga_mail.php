<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catalogo de mails</title>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox.js"></script>
<script type="text/javascript" src="../js/carga_mail.js"></script>
<link rel="stylesheet" href="../css/colorbox.css" />
</head>

<body>
<fieldset>
     <table>
            <tr>
               <td><input type="button" id='cargamail' name="cargamail" value="Cargar Mail"/></td>
               <td><input type="button" id='enviar' name="enviar" value="Enviar"/></td>
            </tr>
     </table>
     <table id="mails">
           
                 <tr>
                   
                    <td>Nombre</td><td id="name"></td>
                 </tr>
                 <tr>   
                    <td>From</td><td id="from"></td>
                 </tr>
                 
                 <tr>
                    <td>Subject</td><td id="subject"></td>
                     
                  </tr>
                 
             
     </table>  
     <table>
               <tr>
                <td>Mensaje</td>
               </tr>
               <tr>  
                   <td id="message"></td>
                 </tr>
     </table> 
</fieldset>
</body>
</html>
