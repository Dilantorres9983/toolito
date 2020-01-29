<?php
session_start();
if(!isset($_SESSION["SESSION"]))  	
 {  echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../$_SESSION[BASE]/index.php?p=login'>";
    exit();
 }
include_once("../globals.php");
include("enlace.php");  

//*****************************************************************************************************************
// INCIO // CONEXION A LA BASE DE DATOS
//*****************************************************************************************************************

//*****************************************************************************************************************
// FIN // CONEXION A LA BASE DE DATOS
//*****************************************************************************************************************
connect();

//*****************************************************************************************************************
// INICIO // INSERT CONTENIDO
//*****************************************************************************************************************
if(isset($insert))
{
$titulo=verificarcontenido($titulo);
$contenido=verificarcontenido($contenido);
$con=mysql_query("INSERT INTO contenido (id,ide,tipo,subtipo,titulo,contenido,fecha,fecha_reg,fecha_act) VALUES ('','$id','$tipo','$subtipo','$titulo','$contenido','$fecha',now(),'')") or die("Error en la consulta");
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion
/*
if($pa=='boletin')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=boletin&id=$id&listo=1'>";//redireccion
if($pa=='enlaces_insertar')
    if($aux=='seccion')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$id&listo=1'>";//redireccion
    if($aux=='boletin')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=boletin&id=$id&listo=1'>";//redireccion
    if($aux=='') echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=enlaces&id=$id&listo=1'>";//redireccion
if($pa=='galeria_insertar')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=galeria&id=$id&listo=1'>";//redireccion
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$aux&id=$id&listo=1'>";//redireccion
*/
}
//*****************************************************************************************************************
// FIN // INSERT CONTENIDO
//*****************************************************************************************************************

//*****************************************************************************************************************
// INICIO // UPDATE CONTENIDO
//*****************************************************************************************************************
if(isset($update))
{
$titulo=verificarcontenido($titulo);
$contenido=verificarcontenido($contenido);
$fecha_reg=$anio."-".$mes."-".$dia;
$con=mysql_query("UPDATE contenido SET tipo='$tipo',subtipo='$subtipo',titulo='$titulo',contenido='$contenido',fecha='$fecha',fecha_act=now() WHERE id='$id'") or die("Error en la consulta");
if($paux!='')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion
else echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion

/*/
/if($pa=='boletin_actualizar')echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=boletin_adm&id=$id&listo=1''>";//redireccion
//echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=enlaces_adm&id=$id&listo=1''>";//redireccion
if($aux=='')
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";
 //redireccion
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$aux&id=$id&listo=1'>";//redireccion
*/
}
//*****************************************************************************************************************
// FIN // UPDATE CONTENIDO
//*****************************************************************************************************************



//*****************************************************************************************************************
// INICION // ACTUALIZAR TITULO DEL MODULO
//*****************************************************************************************************************

if(isset($actualizartitulo))
{
if($titulo!='')
 {$titulo=verificarcontenido($titulo);
 $con=mysql_query("UPDATE contenido SET titulo='$titulo',fecha_act=now() WHERE id='$id'") or die("Error en la consulta");
 }
 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion 
}
//*****************************************************************************************************************
// FIN //  ACTUALIZAR TITULO DEL MODULO
//*****************************************************************************************************************



//*****************************************************************************************************************
// INICIO // DELETE CONTENIDO  
//*****************************************************************************************************************
if(isset($delete))
{ // borra del contenido y del contenido_doc
$con=mysql_query("SELECT * FROM contenido_doc WHERE id='$delete'");
while($row=mysql_fetch_object($con)) //para borrar todos los archivos 
      {
	  unlink("../archivos/$row->archivo");  
      }
$con=mysql_query("DELETE FROM contenido_doc WHERE id='$delete'");
$con=mysql_query("DELETE FROM contenido WHERE id=$delete or ide='$delete'"); //borra los enlaces relaciondados

echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux'>";//redireccion
}
//*****************************************************************************************************************
// FIN // DELETE CONTENIDO
//*****************************************************************************************************************

//*****************************************************************************************************************
// FIN // DELETE MODULO 
//*****************************************************************************************************************

if(isset($delete_modulo))     
{ 
// borra del contenido y del contenido_doc
//borrar de contenido_doc
$id=$delete_modulo;
$consulta=mysql_query("SELECT * FROM contenido WHERE ide='$id'"); 
while($row=mysql_fetch_object($consulta)) 
 {  $idid=$row->id;    
    $con=mysql_query("SELECT * FROM contenido WHERE ide='$idid'"); 
    while($r=mysql_fetch_object($con)) 
    {    $ididid=$r->id; 	
		 $con1=mysql_query("DELETE FROM contenido WHERE ide='$ididid'");  
		 $con1=mysql_query("DELETE FROM contenido WHERE id='$ididid'");  
	
	     $c=mysql_query("SELECT * FROM contenido_doc WHERE id='$idid'"); 
         while($ro=mysql_fetch_object($c)) //para borrar todos los archivos relacionados
           { 
            unlink("../archivos/$ro->archivo");  
           }	 
         $con1=mysql_query("DELETE FROM contenido_doc WHERE id='$idid'"); 
		 
	}
  $con2=mysql_query("DELETE FROM contenido WHERE id='$idid'"); 

  }	
  $con3=mysql_query("DELETE FROM contenido WHERE id=$id"); //borra los enlaces 
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion
}
//*****************************************************************************************************************
// FIN // DELETE MODULO
//*****************************************************************************************************************


//*****************************************************************************************************************
// INICIO // INSERTAR DOC
//*****************************************************************************************************************
if(isset($insert_doc))	
   {		
   if($archivo!='')
			{
			$nombre_archivo = $HTTP_POST_FILES['archivo']['name']; 
			$tamano_archivo = $HTTP_POST_FILES['archivo']['size']; 
			$tipo_archivo = $HTTP_POST_FILES['archivo']['type']; 
				  if (!($tamano_archivo <2000000))
					   { 
						 //  echo "<center><br>ERROR...<br><br>El archivo excede de 1 MB de capacidad.<br><br></center> "; 
						 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=4'>";//redireccion// ARCHOV MUY GRANDE				
					   }
					  else
					   {  
									      if($id2!='') //si existe entonces se actualiza
									         {		
											  //	chmod("../archivos",777);								  
											  $nom=explode(".",$nombre_archivo);
											  $nombre_archivo=$id2.".".$nom[1];	
											  $tipoarchivo=$nom[1];							 
                                              $query=mysql_query("SELECT * FROM contenido_doc WHERE id2='$id2'");	
                                              $row=mysql_fetch_object($query);
											  $archivo_antiguo=$row->archivo;
											  
											  
											  
							  	  	          unlink("../archivos/$archivo_antiguo"); 
											  $query=mysql_query("update contenido_doc set archivo='$nombre_archivo',tipoarchivo='$tipoarchivo',fecha_act=now() where id2='$id2'"); 
										      //SUBE EL ARCHIVO CON SU NOMBRE A LA CARPETA ARCHIVO/
											  //aqui poner permisos chmod
											  if(!move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'],"../archivos/".$nombre_archivo))
													      {//chmod("../archivos",755);
														   echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=2'>";//redireccion	//ERROR AL SUBIR AL FTP			
														   }
														   
											  //chmod("../archivos",755);
											  echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion  si cargo correctamente											  
				                              }
				                            else //si no existe entonces se inserta
				                              {	
											   //chmod("../archivos",777);
											   $nom=explode(".",$nombre_archivo);									  
											   $tipoarchivo=$nom[1];
											   $con=mysql_query("INSERT INTO `contenido_doc` (id2,id,tipoarchivo,tituloarchivo,archivo,descripcion,fecha_reg,fecha_act) 
										       VALUES ('','$id','$tipoarchivo','$tituloarchivo','$nombre_archivo','$descripcion',now(),'')") or die ("Error en la consulta");
											   $con=mysql_query("SELECT * FROM contenido_doc ORDER BY id2 DESC limit 0,1");
											   $row=mysql_fetch_object($con);											   
											   $nombre_archivo=$row->id2.".".$nom[1];												   
											   $query=mysql_query("update contenido_doc set archivo='$nombre_archivo',tipoarchivo='$tipoarchivo',fecha_act=now() where id2='$row->id2'"); 									      
											  //SUBE EL ARCHIVO CON SU NOMBRE A LA CARPETA ARCHIVO/
												           if(!move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'],"../archivos/".$nombre_archivo))
													      echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=2'>";//redireccion	//ERROR AL SUBIR AL FTP			
											 	echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion  si cargo correctamente
											   //chmod("../archivos",755);
										      }												
					} 
			}
			else
			{ 
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=3'>";//redireccion
			}
	 }		

//*****************************************************************************************************************
// INICIO // INSERTAR DOC
//*****************************************************************************************************************

//*****************************************************************************************************************
// INICIO // ACTUALIZAR DOCUMENTOS
//*****************************************************************************************************************
if(isset($update_doc))
{
$con=mysql_query("UPDATE contenido_doc SET tipoarchivo='$tipoarchivo',tituloarchivo='$tituloarchivo',descripcion='$descripcion',fecha_act=now() WHERE id2='$id2'") or die("Error en la consulta");
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion
}
//*****************************************************************************************************************
// FIN //  ACTUALIZAR DOCUMENTOS  
//*****************************************************************************************************************

//*****************************************************************************************************************
// INICIO // DELETE DOCUMENTOS
//*****************************************************************************************************************
if(isset($delete_doc))
{
$con=mysql_query("SELECT * FROM contenido_doc WHERE id2=$delete_doc");
$row=mysql_fetch_object($con);
unlink("../archivos/$row->archivo");
$con=mysql_query("DELETE FROM contenido_doc WHERE id2='$delete_doc'");
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$paux&id=$aux&listo=1'>";//redireccion
}
//*****************************************************************************************************************
// FIN // DELETE DOCUMENTOS
//*****************************************************************************************************************

//*****************************************************************************************************
// ACTUALIZAR DATOS DEL USUARIO Y CONTRASEÑAS
//*****************************************************************************************************
if(isset($usuario_update))
 {
  $query=mysql_query("update usuarios set paterno='$paterno', materno='$materno', nombres='$nombres',correo='$correo',login='$login',password='$password' where id='$_SESSION[ID]'"); 
		$_SESSION["NOMBRE"]="$nombres $paterno $materno";
		$_SESSION["CORREO"]=$correo; 
		$_SESSION["LOGIN"]=$login; 
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=usuario_actualizar&m=1'>";//redireccion

 }
//*****************************************************************************************************
// ACTUALIZAR LOGOTIPO
//*****************************************************************************************************
if(isset($update_logo))
{
      if(isset($archivo))
			{
			$nombre_archivo = $HTTP_POST_FILES['archivo']['name']; 
			$tamano_archivo = $HTTP_POST_FILES['archivo']['size']; 
			$tipo_archivo = $HTTP_POST_FILES['archivo']['type']; 
				     if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "swf")) && ($tamano_archivo <1500000 ))) 
					    { 
						      /*
							  echo "<center><br>ERROR...<br><br>No es un archivo de imagen <br> o el tama&ntilde;o del archivo no es correcto. <br><br> 
							        <li>Solo se permiten archivos con extensi&oacute;n .gif o .jpg<br>
									<li>No exceder de 1 Mb  de capacidad.</td>
									<br><br><a href='panel.php?pa=logo'>Volver</a>
							   </center>";
							   */
                               echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=3'>";//redireccion			   
					     }			
					   else
					     {  
						 //SUBE EL ARCHIVO CON SU NOMBRE A LA CARPETA ARCHIVO/
						  
						 $con=mysql_query("select * from contenido where tipo='tema'");
						 $r=mysql_fetch_object($con);
						 $tema=$r->subtipo;   
						  
						 if(file_exists("../archivos/logo_$tema.jpg")) unlink("../archivos/logo_$tema.jpg"); // borra el archivo 
                         if(file_exists("../archivos/logo_$tema.gif")) unlink("../archivos/logo_$tema.gif"); // borra el archivo 
                         if(file_exists("../archivos/logo_$tema.swf")) unlink("../archivos/logo_$tema.swf"); // borra el archivo 

						 if(strpos($tipo_archivo, "gif")) $nombre_archivo="logo_$tema.gif"; //para el nombre del archivo
						 if(strpos($tipo_archivo, "jpeg"))$nombre_archivo="logo_$tema.jpg"; //para el nombre del archivo
						 if(strpos($tipo_archivo, "swf")) $nombre_archivo="logo_$tema.swf"; //para el nombre del archivo					  
						  
 					     if(move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'],"../archivos/".$nombre_archivo))
			             echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=1'>";//redireccion			                        
						 }
			}
			else
			{ 
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=2'>";//redireccion
			}
}
//**********************************************************************
// INICIO // CREAR NUEVA SECCION
//**********************************************************************

if(isset($crearsec))
{
if($titulo!='')
{
$con=mysql_query("INSERT INTO contenido (id,tipo,subtipo,titulo,contenido,fecha,fecha_reg,fecha_act) VALUES ('','seccion','$subtipo','$titulo','Aqui escribe texto para tu nueva sección y agrega documentos y/o enlaces con los botones inferiores.','$fecha',now(),'')") or die("Error en la consulta");
$cons=mysql_query("select * from contenido where titulo='$titulo'");
$row=mysql_fetch_object($cons);
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$row->id&listo=1'>";//redireccion
}
else
{
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=nseccion&listo=2'>";//redireccion
}
}
//**********************************************************************
// INICIO // CREAR NUEVO MODULO
//**********************************************************************

if(isset($crearmod))
{
if($titulo!='')
{
$consul=mysql_query("select * from contenido where tipo='modular' order by id desc limit 0,1");
$r=mysql_fetch_object($consul);
$nro=$r->nro+1;
$con=mysql_query("INSERT INTO contenido (id,nro,tipo,subtipo,titulo,contenido,fecha,fecha_reg,fecha_act,habilitado) VALUES ('','$nro','modular','$subtipo','$titulo','$contenido','$fecha',now(),'','on')") or die("Error en la consulta");
$cons=mysql_query("select * from contenido where titulo='$titulo'");
$row=mysql_fetch_object($cons);
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion
}
else
{
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=nmodulo&listo=2'>";//redireccion
}
}
//**********************************************************************
// INICIO // ELIMINAR UNA SECCION CON TODOS SUS DOCUMENTOS Y ENLACES
//**********************************************************************
if(isset($delete_seccion))
{
$con=mysql_query("SELECT * FROM contenido_doc WHERE id='$delete_seccion'");//para borrar todos los archivos  realcionados
while($row=mysql_fetch_object($con)) //para borrar todos los archivos  realcionados
    {unlink("../archivos/$row->archivo");  //para borrar los acchivos del ftp
    }
$con=mysql_query("DELETE FROM contenido_doc WHERE id='$delete_seccion'"); //borra los registro de las imagenes y docs del la base
$con=mysql_query("DELETE FROM contenido WHERE tipo='enlaces' and subtipo='$delete_seccion'"); //borra los enlaces relaciondados
$con=mysql_query("DELETE FROM contenido WHERE id='$delete_seccion'"); //borra la seccion

echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion
}
//*****************************************************************************************************
// INSERTAR GALERIA DE IMAGENES
//*****************************************************************************************************
if(isset($insert_galeria))	
   {		
   if(isset($archivo))
			{
			$nombre_archivo = $HTTP_POST_FILES['archivo']['name']; 
			$tamano_archivo = $HTTP_POST_FILES['archivo']['size']; 
			$tipo_archivo = $HTTP_POST_FILES['archivo']['type']; 
				  if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") ) && ($tamano_archivo <1000000 ))) 
					   { 
						 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=galeria&id=$aux&listo=3'>";//redireccion// ARCHOV MUY GRANDE	no es gif jpg			
					   }
					  else
					   {  
									      if($id2!='') //si existe entonces se actualiza
									         {											  
											  $nom=explode(".",$nombre_archivo);
											  $nombre_archivo=$id2.".".$nom[1];	
                                              $query=mysql_query("SELECT * FROM contenido_doc WHERE id2='$id2'");	
                                              $row=mysql_fetch_object($query);
											  $archivo_antiguo=$row->archivo;
							  	  	          unlink("../archivos/$archivo_antiguo"); 
                                              $query=mysql_query("update contenido_doc set archivo='$nombre_archivo',tipoarchivo='$tipoarchivo',fecha_act=now() where id2='$id2'"); 
										      //SUBE EL ARCHIVO CON SU ID A LA CARPETA ARCHIVO/
												           if(!move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'],"../archivos/".$nombre_archivo))
													       echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=2'>";//redireccion	//ERROR AL SUBIR AL FTP			
											 	 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=galeria&id=$aux&listo=1'>";//redireccion  si cargo correctamente
				                              }
				                            else //si no existe entonces se inserta
				                              {	
											   $nom=explode(".",$nombre_archivo);									  
											   $con=mysql_query("INSERT INTO `contenido_doc` (id2,id,tipoarchivo,tituloarchivo,archivo,descripcion,fecha_reg,fecha_act) 
										       VALUES ('','$id','$tipoarchivo','$tituloarchivo','$nombre_archivo','$descripcion',now(),'')") or die ("Error en la consulta");
											   $con=mysql_query("SELECT * FROM contenido_doc ORDER BY id2 DESC limit 0,1");
											   $row=mysql_fetch_object($con);											   
											   $nombre_archivo=$row->id2.".".$nom[1];												   
											   $query=mysql_query("update contenido_doc set archivo='$nombre_archivo',tipoarchivo='$tipoarchivo',fecha_act=now() where id2='$row->id2'"); 									      
											  //SUBE EL ARCHIVO CON SU ID A LA CARPETA ARCHIVO/
												           if(!move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'],"../archivos/".$nombre_archivo))
													       echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=$pa&listo=2'>";//redireccion	//ERROR AL SUBIR AL FTP			
											 	 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=galeria&id=$aux&listo=1'>";//redireccion  si cargo correctamente										   
										      }												
					} 
			}
			else
			{ 
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php?pa=galeria&id=$aux'>";//redireccion
			}
	 }	
//****************************************************************************************
// INICIO // TEMAS 
//****************************************************************************************
if(isset($tema))	
{
 $con=mysql_query("UPDATE contenido SET subtipo='$tema',fecha_act=now() WHERE tipo='tema'") or die("Error en la consulta"); 
 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";//redireccion
}
//****************************************************************************************
// FIN // TEMAS 
//****************************************************************************************
//****************************************************************************************
// INICIO // DESHABILITAR MENUS 
//****************************************************************************************
if(isset($disable))	
{
 $con=mysql_query("UPDATE contenido SET habilitado='$valor',fecha_act=now() WHERE id='$disable'") or die("Error en la consulta"); 
 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";//redireccion
}
//****************************************************************************************
// FIN // DESHABILITAR MENUS 
//****************************************************************************************

 function verificarcontenido($contenido)
 {
  //********script para no guardar el  la  '
  $numero=strlen($contenido);
  for($i=0;$i<=$numero;$i++)
   {   $car=substr($contenido,$i,1); 
       if($car==chr(39) or $car==chr(92))
         {
		   $car=$car.$car;
         }
		$texto=$texto.$car;
   }
  //*******script para no guardar el  la  '
  return $texto;
  }
?>