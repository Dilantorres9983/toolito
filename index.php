<?php 
   session_start();
   include_once("globals.php");
   $_SESSION["BASE"]="abogaec_cetid"; // nombre de la base de datos
   $_SESSION["ENLACE"]="abogaec_cetid"; // nombre de la base de datos 
     
   include("webpanel/enlace.php");  
   connect();
   $con=mysql_query("select * from contenido where tipo='tema'");
   $r=mysql_fetch_object($con);    
   include("temas/$r->subtipo/contenido.php");
  
?>