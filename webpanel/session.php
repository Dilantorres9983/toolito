<?php
session_start();
include_once("../globals.php");
include("enlace.php");   
connect();   
$con=mysql_query("select * from usuarios where login='$login' and password='$password'") or die("Error en la consulta:");	
if(mysql_num_rows($con)>0) 
    {   
	    $row=mysql_fetch_object($con);         
		$_SESSION["NOMBRE"]="$row->nombres $row->paterno $row->materno";
	    $_SESSION["ID"]=$row->id;
		$_SESSION["CARGO"]=$row->cargo;
		$_SESSION["CORREO"]=$row->correo; 
		$_SESSION["LOGIN"]=$row->login; 
		$_SESSION["SESSION"]=$_SESSION["BASE"]; 
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";exit();//redireccion
    }
else
    {	
	   echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php?p=login&id=1'>";exit();//redireccion
    } 
?>