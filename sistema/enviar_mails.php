<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin título</title>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.json-2.3.js"></script>
<script type="text/javascript" src="../js/submit_mail.js"></script>
</head>

<body>
<table>
    <tr>
       <td>Contactos:</td>
       <td>Los correos se enviaran por bloques de 80 por minuto</td>
       <td><input type="button" id='Enviar'  value="Enviar"/></td>
       <td id='total'></td>
       <td id="minutos"></td>
    </tr>
   
</table>
<table id="listmails">
     <thead>
         <tr>
             <td>Id.</td>
             <td>Correo:</td>
         </tr>
     </thead>
     <tbody>
           
     </tbody>
     

</table>
</body>
</html>