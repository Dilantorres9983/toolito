<?php
function connect()
 { 
 if(isset($_SESSION["ENLACE"]))
    {
	 
    //if($enlace=mysql_connect("localhost","abogaec_cetid20","21060abogado21060"))

if($enlace=mysql_connect("localhost","root",""))

	   { $base=mysql_select_db( $_SESSION["BASE"],$enlace); }
      else  { 
	  echo"<br>En este momento este sitio está fuera de servicios.
	       <br><br>Contáctenos: soporte@derechoteca.com";
		    }
	  return $enlace;	   
	  } 
	  else
	{
	echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";//redireccion
	} 
  }
?>