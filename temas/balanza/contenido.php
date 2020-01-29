<?php 
session_start();
include_once("globals.php");
?>
<SCRIPT language=JavaScript>
// Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/
<!--
function goSelect(daform) {
with(daform) {
top.window.location=options[selectedIndex].value;
}
}
//-->
</SCRIPT>
<?php

//************************************************************************************
//PROGRAMA PRINCIPAL   // OPCIONES DE LA APLICACION WEB
//************************************************************************************
connect();
//************************************************************************************
// INICIO //  CONTENIDO
//************************************************************************************
function contenido()
{
    global $p,$g,$id,$tipo,$patron;
	if($p=='login') login();
    elseif($p=='salir') salir();
    elseif($p=='contacto') contacto();
    elseif($p=='mapa') mapa();
    elseif($p=='buscar') buscar();
    elseif($p=='galeria') galeria();	
	elseif($p=='colegiados') colegiados();
	elseif($p=='buscarcolegiados') buscarcolegiados();
	elseif($p=='buscarcolegiadoslista') buscarcolegiadoslista();	
	elseif($p=='cumpleanos') cumpleanos();
	elseif($p=='listar_letra') listar_letra();		
    elseif($p=='olvide') olvide();	
    elseif($p=='integrantes') integrantes();	
    elseif($p=='mostrar_integrantes') mostrar_integrantes();	
    elseif($p=='boletin_mostrar')mostrar_boletin($id);
	elseif($p=='servicios') servicios();
	elseif($p=='mostrar_servicios')mostrar_servicios();
	else mostrar_contenido();
}  
//************************************************************************************
// INICIO // SECCION   ****   TITULO DE CADA SECCIÓN DE CONTENIDO
//************************************************************************************
function seccion($x)
{ 
  global $ide;
  if($ide!='') $x=$ide;
  if($x=='')return 'Inicio';
  if($x=='contacto')return "Consultas Jurídicas Online";
  if($x=='mapa')return "Mapa del Sitio";
  if($x=='olvide')return "Olvide Mi Nombre de Usuario y/o Contraseña";
  if($x=='login')return "Iniciar Sesión";  
  if($x=='buscar')return "Buscar en el portal";    
  
  $res=mysql_query("SELECT * FROM contenido WHERE id='$x'");
  $row=mysql_fetch_object($res);
  return $row->titulo;  

}
//************************************************************************************
// FIN // SECCION **** TITULO DE CONTENIDO
//************************************************************************************
//************************************************************************************
// INICIO // SESION
//************************************************************************************
function sesion()
{
 if($_SESSION["SESSION"]==$_SESSION["BASE"])
  {  echo"<table border='0' align='center' cellspacing='0' class='p_cuadro'>
     <tr>
     <td width='204' rowspan='2'><div align='center'><img src='../webpanel/imagenes/p_logo.jpg' alt='Logo Derechoteca' width='185' height='36' longdesc='http://www.derechoteca.com'></div></td>
     <td width='2'></td>
     <td height='21' class='p_subtit3'>Bienvenido (a) </td>
     <td><div align='center'><a href='index.php' class='p_link2'>Ver Sitio Web</a></a> <span class='p_link2'>| </span><a href='../webpanel/panel.php' class='p_link2'>Panel de Administraci&oacute;n</a> <span class='p_link2'>| </span><a href='index.php?p=salir' class='p_link2'>Cerrar Sesi&oacute;n</a></div></td>
     </tr>
     <tr>
     <td>&nbsp;</td>
     <td width='246' height='21' class='p_nombre'>$_SESSION[NOMBRE]</td>
     <td width='315'>
	  <div align='center'>
	    <select class='p_combo' onchange='goSelect(this)' size='1' name='m'>          		  
	      <option value='#' selected='selected'>MENÚ DE ADMINISTRACI&Oacute;N </option>
	      <option value='#' target='top'>__________________________________________________ </option>
	      <option value='#' target='top'> C O M U N E S </option>
	      <option value='#' target='top'>__________________________________________________ </option>		  
		  <option value='../webpanel/panel.php?pa=titulo'>Título del Sitio Web</option>
	      <option value='../webpanel/panel.php?pa=pie'>Pie de P&aacute;gina</option>
 	      <option value='../webpanel/panel.php?pa=inicio'>Inicio</option>
	      <option value='../webpanel/panel.php?pa=etiquetas'>Etiquetas</option>
	      <option value='../webpanel/panel.php?pa=usuario'>Datos del Usuario</option>
	      <option value='../webpanel/panel.php?pa=logo'>Cargar Logotipo al Sitio Web</option>
	      <option value='#' target='top'>__________________________________________________ </option>
	      <option value='#' target='top'> OPCIONES DEL MENU </option>
	      <option value='#' target='top'>__________________________________________________ </option>		  
		  <option value='panel.php?pa=nmodulo'>--- Crear una nueva opción en el menu ---</option>";
	      $res=mysql_query("SELECT * FROM contenido WHERE tipo='modular' order by nro");
          while ($row=mysql_fetch_object($res))
		  echo"<option value='../webpanel/panel.php?pa=$row->subtipo&id=$row->id'>$row->titulo</option>";
          echo"	 
          </select>

          </div></td> </tr></table>";
    }
}
//************************************************************************************
// FIN // SESION
//************************************************************************************


//************************************************************************************
// INICIO // MUESTRA CONTENIDO EN EL INDEX
//************************************************************************************
function mostrar_contenido()
{
global $p,$id,$tipo;

	if($tipo=='boletin') 
	{
	 echo"<table width='517' border='1' cellpadding='2' cellspacing='1'>
    <tr>
      <td width='23' bgcolor='#FBFBFB' class='subtitulos3'><div align='center'>N&ordm;</div></td>
      <td width='55' bgcolor='#FBFBFB' class='subtitulos3'><div align='center'>TIPO</div></td>
      <td width='417' bgcolor='#FBFBFB' class='subtitulos3'><div align='center'>T&Iacute;TULO</div></td>
    </tr>";
	 $con=mysql_query("select * from contenido where ide='$p' order by subtipo,id desc");
	 $i=1;
     while($row=mysql_fetch_object($con))
        {
		//echo"<a class='boletin1' href='?p=boletin_mostrar&id=$row->id&ide=$row->ide'>&bull; $row->titulo</a><br>
	//		  &nbsp;&nbsp;&nbsp;&nbsp;<a class='l'>$row->subtipo </a> &nbsp; <a class='l'>[$row->fecha]</a><hr size='1' noshade>";
    	echo"<tr>
      <td><div class='letras' align='center'>$i</div></td>
      <td><div align='center'><a class='letras'>$row->subtipo</a></div></td>
      <td><div align='center'><a class='letras' href='?p=boletin_mostrar&id=$row->id&ide=$row->ide''>$row->titulo</a>&nbsp;<a class='fecha'>[$row->fecha]</a></div></td>
    </tr>";	$i++;
	    }
		mysql_free_result($con); 
		echo"</table>";	   
     }	
	
	if($tipo=='enlaces') 
	{$con=mysql_query("select * from contenido where ide='$p'");   
     while($row=mysql_fetch_object($con))
        {echo"<a class='cafe'>$row->titulo </a> <br><a class='letras' href='$row->contenido' target='blank'>$row->contenido</a><br><br>";
        }
      mysql_free_result($con);
    }  
		if($tipo=='galeria') 
      {
	  $res=mysql_query("SELECT * FROM contenido_doc WHERE id='$p'");
	  $i=1;
      while ($row=mysql_fetch_object($res))
          { 
		  	echo"<a class='letras' href='archivos/$row->archivo' target='_blank'>
			$row->titulo<img src='archivos/$row->archivo' width='100' heigth='100' border='0' alt='$row->tituloarchivo : $row->descripcion'></a>&nbsp;&nbsp;";
			
           if($i==4) {echo"<br>";$i=1;}
           $i++;
          }
       }
	
 	if($tipo=='servicios')   
  	 {
	   $res=mysql_query("SELECT * FROM contenido where ide='$p'");
	   echo"<br>";
       while ($row=mysql_fetch_object($res))
          {echo"&nbsp;&nbsp;&nbsp;&nbsp; &bull; <a class='titulos' href='index.php?p=mostrar_servicios&id=$row->id'>$row->titulo</a></a>
		   <br><br>"; 
          }
	 }
		
if($tipo=='integrantes')      
     {
  	  $res=mysql_query("SELECT * FROM contenido WHERE ide='$p'");
	  echo"<br>";
      while ($row=mysql_fetch_object($res))
          {echo"&nbsp;&nbsp;<a class='letras' href='index.php?p=mostrar_integrantes&id=$row->id&ide=$row->ide'>$row->titulo</a></a>
		   <br><br>"; 
          }
     }		
		
	elseif($tipo!='galeria' and $tipo!='boletin' and $tipo!='enlaces' and $tipo!='servicios' and $tipo!='integrantes')
	{   
	//MUESTRA LAS SECCIONES ESPECIALES
	 $con=mysql_query("select * from contenido where id='$p'");   
     $row=mysql_fetch_object($con);
	 $iid=$row->id;
     $texto=nl2br($row->contenido);
 	 
	    if($row->subtipo=='boletin') 
	    {
	         $con=mysql_query("select * from contenido where tipo='$tipo' order by fecha_reg desc");   
              while($row=mysql_fetch_object($con))
             {
		     echo"<a class='cafe'>$row->subtipo </a> <a class='azul'>$row->fecha</a><br><a class='letras' href='?p=boletin_mostrar&id=$row->id'>$row->titulo</a><br><br>";
              } 
		 
	   }
       else 
       {
       echo"<div id='lateral'>";
       mostrar_docs($iid);
       echo"</div><a class='letras'>$texto</a>"; 
   }
}			   

}

//************************************************************************************
// INICIO // MUESTRA PIE
//************************************************************************************
function pie()
{ connect();
   $con=mysql_query("select * from contenido where tipo='pie'");   
   $row=mysql_fetch_object($con);
   $texto=nl2br($row->contenido);
   echo"<br><a class='letras'>$texto</a>";  
}
//************************************************************************************
// INICIO // MUESTRA TITULO
//************************************************************************************
function titulo()
{  global $p; 
   $con=mysql_query("select * from contenido where tipo='titulo'");   
   $row=mysql_fetch_object($con);   
   if($p=='')echo"$row->contenido - Inicio ".seccion($p);
   else echo"$row->contenido - ".seccion($p);
   mysql_free_result($con); 
}
//************************************************************************************
// FIN // MUESTRA TITULO
//************************************************************************************

//************************************************************************************
// INICIO // MUESTRA INICIO
//************************************************************************************
function inicio()
{
   $con=mysql_query("select * from contenido where tipo='inicio'");   
   $row=mysql_fetch_object($con);
   $contenido=nl2br($row->contenido);
   echo"<br><a class='letras'>$contenido</a><br>";
   mysql_free_result($con);
}
//************************************************************************************
// FIN // MUESTRA INICIO
//************************************************************************************


//************************************************************************************
// INICIO // MUESTRA MAPA DEL SITIO
//************************************************************************************
function mapa()
  {

			   $res=mysql_query("SELECT * FROM contenido WHERE tipo='seccion'");
               while ($row=mysql_fetch_object($res))
               echo"&nbsp;&nbsp;<a class='letras' href='?p=$row->id'>$row->titulo </a></a><br>";

               echo"&nbsp;&nbsp;<a class='letras' href='index.php?p=boletin'>Boletín Informativo</a><br>
                    &nbsp;&nbsp;<a class='letras' href='index.php?p=enlaces'>Enlaces</a>	<br>
                    &nbsp;&nbsp;<a class='letras' href='index.php?p=galeria'>Galeria de fotos</a><br>
                    &nbsp;&nbsp;<a class='letras' href='index.php?p=contacto'>Consultas Jurídicas Online</a><br>";
	
  }



//************************************************************************************
// INICIO // MUESTRA LOS SERVICIOS
//************************************************************************************

function mostrar_servicios()
{ global $id;
  	  $res=mysql_query("SELECT * FROM contenido WHERE id='$id'");
	  $row=mysql_fetch_object($res);
      $texto=nl2br($row->contenido);  
     
	 echo" <table width='100%' border='0'>
              <tr>
                <td valign='top' width='100%'> 
				 <div id='lateral'>
                 ";
                  mostrar_docs($row->id);
			     echo"</div>
				 <a class='titulos2'>$row->titulo</a><br><br>
				 <a class='letras'>$texto</a><BR>
				 </td>
                 </tr>
                 </table> 
                 ";  
	 
	/*  echo"<div id='lateral'>";
      mostrar_docs($row->id);
      echo"</div>
 	       <a class='titulos2'>$row->titulo</a><br><br>
	       <a class='letras'>$texto</a>
		   "; */
				     
}

//************************************************************************************
// INICIO // MUESTRA INTEGRANTES
//************************************************************************************

function mostrar_integrantes()
{ global $id;
 	  
 echo"<table width='100%' border='0' cellspacing='4' cellpadding='0'>
      <tr>
        <td height='157' valign='top' class='integrantes'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='fotos'>
            <tr>
              <td height='585'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='72%' height='142'>"; 
	 $resss=mysql_query("SELECT * FROM contenido_doc WHERE id='$id'");
  if(mysql_num_rows($resss)>0)
  {$r=mysql_fetch_object($resss);
  echo "<img src='archivos/$r->archivo' width='125' height='140'>";}
				  echo"</td>
                  <td width='28%'><img src='../temas/balanza/imagenes/fondofoto.gif' alt='Fondo' width='56' height='141'></td>
                </tr>
                <tr>
                  <td height='1' colspan='2' bgcolor='#000000'></td>
                  </tr>
              </table>
               <br>";

 $res=mysql_query("SELECT * FROM contenido WHERE id='$id' ");
	  $row=mysql_fetch_object($res);
      $texto=nl2br($row->contenido);	 		
	

  echo"<table width='182' border='0' cellpadding='0' cellspacing='1' class='t_consultas'>
                  <form action='index.php' method='post'>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='21' class='consultas'><div align='center'><img src='../temas/balanza/imagenes/consultas2.gif' alt='Consultas Jur&iacute;dicas Online' width='171' height='27'></div></td>
                    </tr>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='21' class='consultas'>Para: <a class='letras'>$row->titulo</a></td>
                    </tr>
                    
                    <tr>
                      <td width='4%' class='consultas'>&nbsp;</td>
                      <td width='96%' height='21' class='consultas'>Nombre Completo: </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><label>
                        <input name='nombre' type='text' class='consultas2' id='nombre2' size='25'>
                      </label></td>
                    </tr>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='21' class='consultas'>Correo Electr&oacute;nico:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name='correo' type='text' class='consultas2' id='correo2' value='@' size='25'></td>
                    </tr>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='21' class='consultas'>Tel&eacute;fono de Contacto:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name='telefono' type='text' class='consultas2' id='telefono2' size='25'></td>
                    </tr>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='22' class='consultas'>Materia Juridica de la Consulta:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name='tema' type='text' class='consultas2'  size='25'></td>
                    </tr>
                    <tr>
                      <td class='consultas'>&nbsp;</td>
                      <td height='21' class='consultas'>Consulta:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><label>
                        <textarea name='mensaje' cols='25' rows='5' class='consultas2' id='textarea'></textarea>
                      </label></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td height='37'>
					  <input name='integrante' type='hidden' value='$row->titulo'>
					  <input name='mail_integrante' type='hidden' value='$row->subtipo'>
					  <input name='contacto_enviar' type='hidden' class='boton' value='Enviar Mensaje'>
                      <input name='contacto_enviar' type='image' src='../temas/balanza/imagenes/consultas_enviar.gif' title='ENVIAR CONSULTA JURIDICA ONLINE'></td>
                    </tr>
                    <tr>
                      <td class='letras'>&nbsp;</td>
                      <td height='37' class='letras'>* El env&iacute;o de la consulta mediante este formulario no entabla ninguna relaci&oacute;n jur&iacute;dica cliente/abogado.</td>
                    </tr>
                  </FORM>
                </table>               <br></td>
            </tr>
                </table>
				</td>
        <td width='65%' rowspan='2' valign='top'>
		
  <br><a class='integrantes'>$row->titulo</a><br>";
  
  echo"<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#DBDBDB'>
    <tr>
      <td width='26%' height='20' valign='middle'><div align='center'>"; 
  if($row->fecha=='particular.gif') echo"<img src='../webpanel/imagenes/particular.gif'>";
  if($row->fecha=='hotmail.gif')echo"<img src='../webpanel/imagenes/hotmail.gif'>";
  if($row->fecha=='yahoo.gif')echo"<img src='../webpanel/imagenes/yahoo.gif'>";
  if($row->fecha=='aol.gif')echo"<img src='../webpanel/imagenes/aol.gif'>";
  if($row->fecha=='latinmail.gif')echo"<img src='../webpanel/imagenes/latinmail.gif'>";
  if($row->fecha=='gmail.gif')echo"<img src='../webpanel/imagenes/gmail.gif'>";
  if($row->fecha=='skype.gif')echo"<img src='../webpanel/imagenes/skype.gif'>";
  if($row->fecha=='net2phone.gif')echo"<img src='../webpanel/imagenes/net2phone.gif'>";
echo"</div></td>
      <td width='74%' class='integrantes2'> $row->subtipo  </td>
    </tr>
  </table>";
  
  
  echo"<br><br>
          <span class='letras2'>$texto</span>  </td>
      </tr>
      <tr>
        <td height='19' valign='top' class='integrantes'>&nbsp;</td>
      </tr>
    </table>";		 
}

//************************************************************************************
// BUSCAR
//************************************************************************************
function buscar()
   { 
   global $patron;
   if($patron=='')
   {  
      echo"<div align='center' class='mensaje'><br>Error: Ingrese un criterio de búsqueda <br></div>";
   }
   else
   {
    $con=mysql_query("SELECT * FROM contenido WHERE titulo LIKE '%$patron%' 
											  OR fecha LIKE '%$patron%' 
											  OR contenido LIKE '%$patron%'");	
    echo"<br><a class='cafe'>Criterio de busqueda : $patron | Resultados : ".mysql_num_rows($con)."</a><br><br>";   
	  if(mysql_num_rows($con))
	     { while($row=mysql_fetch_object($con))
			  {  $i++;
			      $titulo=$row->titulo;       $titulo=ereg_replace("$patron","<b><u>$patron</u></b>",$titulo);			
			      $fecha=$row->fecha;         $fecha=ereg_replace("$patron","<b><u>$patron</u></b>",$fecha);			
			      $contenido=$row->contenido; $contenido=ereg_replace("$patron","<b><u>$patron</u></b>",$contenido);							  
				  $x=strchr ($contenido,$patron);
				  $contenido=substr($contenido,$x,100);
				  $tipo=seccion($row->tipo);
				  if($fecha=='--') $fecha='';
				  if($row->pie=='pie') $tipo='Pie';
				  echo"<a class='link'>$i ) </a><a class='azul' href='index.php?p=$row->id'>$ipo $titulo</a>
				       <a class='letras'><b>$row->subtipo</b></a><br>";	
			  	 if($fecha!='')  echo"<a class='letras'>$fecha</a>";
				 echo"<a class='letras'>... $contenido ...</a><hr size='1' color='#CCCCC'>";
				}	 
		      }
		} 
		 
    } 
//************************************************************************************


//************************************************************************************
// INICIO // MOSTRA BOLETIN INFORMATICO su contenido
//************************************************************************************
function mostrar_boletin($id)
{ global $p;
     $con=mysql_query("select * from contenido where id='$id' order by fecha_reg desc");   	 
     $row=mysql_fetch_object($con);
     $texto=nl2br($row->contenido);
	   echo"<div id='lateral'>";
       mostrar_docs($row->id);
       echo"</div>
	   <a class='titulos2'>$row->titulo</a><br>
	   <a class='rojo'>$row->subtipo:</a>
	   <a class='letras'>$row->fecha</a><br><br>
       <br><a class='letras'>$texto</a><br>"; 
}
//************************************************************************************
// FIN // MOSTRAR BOLETIN INFORMATICO PARA EL INDEX
//************************************************************************************

//************************************************************************************
// INICIO // MOSTRAR DOCUMENTOS
//************************************************************************************
function mostrar_docs($iid)
{
 global $p,$id;	
        //temas/estandar/imagenes***************
	    $con=mysql_query("select * from contenido_doc where id='$iid' and (tipoarchivo='gif' or tipoarchivo='jpg')");   //para las temas/estandar/imagenes
        if(mysql_num_rows($con)>0)
	    {
		//MOSTRAR INFORMACIÓN RELACIONADA EN SECCIONES COMUNES
		echo"<img src='../temas/balanza/imagenes/inforel.gif'>"; $inf='si';//imagen e informacion relacionada // y marco con si
		
	   echo"<table width='100%' border='0' cellpadding='0' cellspacing='0' class='p_cuadro5'>
        <tr>
          <td height='15' bgcolor='#666666' class='p_subtit4'><div align='right'>Im&aacute;genes &nbsp;&nbsp;</div></td>
        </tr>
              <tr>
              <td height='44' align='center'>";
			  $i=1;
  		     while($row=mysql_fetch_object($con))
               {echo"<a href='archivos/$row->archivo' target='_blank'  title='$row->tituloarchivo :: $row->descripcion'><img width='115' height='125' border='0' src='archivos/$row->archivo'/></a><br><a class='fecha'>$row->tituloarchivo</a>";
			      /* if($i==1) echo"<br>";
				  $i++;*/
				 echo"<br>";
			   }
	 	   echo"</td>
              </tr>
             </table> ";
	      }	 
		
	 //documentos********************
	 $con=mysql_query("select * from contenido_doc where id='$iid' and (tipoarchivo<>'gif' and tipoarchivo<>'jpg')");   //para las temas/estandar/imagenes
	 if(mysql_num_rows($con)>0)	
      {
	     if($inf!='si'){echo"<img src='../temas/estandar/imagenes/inforel.jpg'>"; $inf='si';}//imagen e informacion relacionada 
		 
	     echo"<table width='100%' border='0' cellpadding='0' cellspacing='0' class='p_cuadro5'>
        <tr>
          <td height='15' bgcolor='#666666' class='p_subtit4'><div align='right'>Documentos &nbsp;&nbsp;</div></td>
        </tr>
              <tr>
              <td height='44'>";
		while($row=mysql_fetch_object($con))
	     {
			if($row->tipoarchivo=='doc') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->descripcion'><img border='0' src='../temas/estandar/imagenes/word.gif'> $row->tituloarchivo</a>"; 	 
			elseif($row->tipoarchivo=='xls') echo"<a class='letras'  href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/excel.gif'> $row->tituloarchivo</a>";
			elseif($row->tipoarchivo=='ppt') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/pw.gif'> $row->tituloarchivo</a>"; 		 
			elseif($row->tipoarchivo=='pdf') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/pdf.gif'> $row->tituloarchivo</a>"; 		  
			elseif($row->tipoarchivo=='txt') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/txt.gif'> $row->tituloarchivo</a>"; 		   											 
		    elseif($row->tipoarchivo=='wma') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/wma.gif'> $row->tituloarchivo</a>"; 		   											 
		    elseif($row->tipoarchivo=='mp3') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/mp3.gif'> $row->tituloarchivo</a>"; 		   											 			
		    elseif($row->tipoarchivo=='ram') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/ram.gif'> $row->tituloarchivo</a>"; 		   											 						
			else echo"<a class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../temas/estandar/imagenes/upload.gif'> $row->tituloarchivo</a>"; 		 
		 echo"<br>";
		 }	 
		 echo"</td>
              </tr>
            </table> ";
		 }	 
	    //enlaces***************
	    $con=mysql_query("select * from contenido where ide='$iid'");   
	    if(mysql_num_rows($con)>0)	
         {
		 if($inf!='si')echo"<img src='../temas/estandar/imagenes/inforel.jpg'>";//imagen e informacion relacionada
		 
	 echo"<table width='100%' border='0' cellpadding='0' cellspacing='0' class='p_cuadro5'>
        <tr>
          <td height='15' bgcolor='#666666' class='p_subtit4'><div align='right'>Enlaces &nbsp;&nbsp;</div></td>
        </tr>
         <tr>
              <td height='44'>";
              while($row=mysql_fetch_object($con))
              {
		      echo"<a class='letras' href='$row->contenido' target='blank' title='$row->contenido'>$row->titulo</a><br>";
			  }
		 echo"</td>
              </tr>
            </table> ";			  
        }
}		
//************************************************************************************
// FIN // MOSTRAR DOCUMENTOS
//************************************************************************************

//************************************************************************************
// FIN // MOSTRAR ULTIMOS DOCUMENTOS
//************************************************************************************
function mostrar_doc_ultimos()
{ 
     $con=mysql_query("select * from contenido_doc where tituloarchivo<>'' order by id desc LIMIT 0 , 10"); 
     while($row=mysql_fetch_object($con))	 
	    {		
		 	if($row->tipoarchivo=='doc') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->descripcion'><img border='0' src='../webpanel/imagenes/word.gif'> $row->tituloarchivo</a>"; 	 
			elseif($row->tipoarchivo=='xls') echo"<a class='letras'  href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/excel.gif'> $row->tituloarchivo</a>";
			elseif($row->tipoarchivo=='ppt') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/pw.gif'> $row->tituloarchivo</a>"; 		 
			elseif($row->tipoarchivo=='pdf') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/pdf.gif'> $row->tituloarchivo</a>"; 		  
			elseif($row->tipoarchivo=='txt') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/txt.gif'> $row->tituloarchivo</a>"; 		   											 
		    elseif($row->tipoarchivo=='wma') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/wma.gif'> $row->tituloarchivo</a>"; 		   											 
		    elseif($row->tipoarchivo=='mp3') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/mp3.gif'> $row->tituloarchivo</a>"; 		   											 			
		    elseif($row->tipoarchivo=='ram') echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/ram.gif'> $row->tituloarchivo</a>"; 		   											 						
			elseif($row->tipoarchivo=='galeria' or $row->tipoarchivo=='jpg' or $row->tipoarchivo=='gif' ) echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/imagen.gif'> $row->tituloarchivo</a>"; 		   											 						
			else echo"<a  class='letras' href='archivos/$row->archivo' target='_blank' title='$row->contenido'><img  border='0' src='../webpanel/imagenes/upload.gif'> $row->tituloarchivo</a>"; 		 
            echo"<a class='letras'> [$row->tipoarchivo]</a> <br>";
		}
}
//************************************************************************************
// INICIO // LOGIN   // SALIR  // VERIFICA SESION
//************************************************************************************
function login(){
global $id;
if(isset($id)) echo"<div class='mensaje'>Error.... </div>";
echo"<table width='100%' border='0' cellspacing='1' align='center'>
     <form name='' action='../webpanel/session.php' method='POST'>
	 <tr>
     <td align='right' width='158' class='letras'><br><br>
	 </td>
     <td width='401'>
	 </td>
	 </tr>
	 <tr>
     <td align='right' width='158' class='letras'> <strong>Nombre de Usuario</strong> &nbsp;</td>
     <td width='401'><input value='' class='tform' type='text' name='login'> 
	 </td>
	 </tr>
     <tr><td align='right' width='158' class='letras'><strong>Contraseña</strong> &nbsp;</td>
     <td width='401'>
	 <input class='tform' type='password' name='password'></td></tr>
	 
     <tr><td width='158' align='right'></td>
	 <td class='flatfont'><input name='submit' type='submit' class='boton' value='Ingresar'></td></tr>
     <tr>
       <td align='right'></td>
       <td class='flatfont'><a class='letras' href='?p=olvide'>[Olvide mi nombre de usuario/contraseña]</a> </td>
     </tr>
     </form></table>";}
///*******
function salir()
{
session_start();
session_destroy();
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";//redireccion
}

//*************************************************************************************
// INICIO // formulario contacto
//*************************************************************************************

function contacto()
{  global $m;		
     if($m==1)echo"<div align='center'><a class='mensaje'>Su consulta jurídica online fue enviada correctamente, pronto le responderemos.  <br> Gracias!!!</a></div>";  //MENSAJE FUE ENVIADO
     echo"
		<form action='index.php' method='post'>
		<table width='100%' border='0' cellpadding='0' cellspacing='0'>
		<tr><td></td>
		 <td><a class='letras'>
         Indíquenos el contenido de su consulta de la forma más precisa posible, y a la mayor brevedad, le responderemos. <br>
          </a></td></tr>
			<tr>
			  <td width='32%' height='43'><div align='right'>	  
			  <a class='letras'>Nombre Completo : </a> </div></td>
			  <td width='68%'><input name='nombre' type='text' class='titulos3' size='50'>
			  </td>
			 </tr>
			<tr>
			  <td height='50'><div align='right'>
			  <a class='letras'>E-mail Remitente : </a></div></td>
			  <td><input name='correo' type='text' class='titulos3' value='@' size='50'></td>
			</tr>
			<tr>
			  <td height='50'><div align='right'>
			 <a class='letras'>Teléfonos : </a></div></td>
			 <td><input name='telefono' type='text' class='titulos3' size='50'></td>
			</tr>
			<tr>
			  <td height='50'><div align='right'>
		   <a class='letras'>Tema : </a></div></td>
			<td>
			<input name='tema' type='text' class='titulos3' size='50'></td>
			</tr>
			<tr>
			  <td height='50'><div align='right'>
			  <a class='letras'>Mensaje : </a></div></td>
			  <td>
              <textarea name='mensaje' cols='40' rows='5' class='titulos3'></textarea></td>
			</tr>
			<tr> 
			  <td height='50'>&nbsp;</td>
			  <td>
			  <input name='ip' type='hidden' value='".getRealIP()."'><br>
<input name='integrante' type='hidden' value='GENERAL'>
<input name='contacto_enviar' type='hidden' class='boton' value='Enviar Mensaje'>		
<input name='contacto_enviar' type='image' src='../temas/balanza/imagenes/consultas_enviar.gif' title='ENVIAR CONSULTA JURIDICA ONLINE'>
<br><a class='letras'>* El env&iacute;o de la consulta mediante este formulario no entabla ninguna relaci&oacute;n jur&iacute;dica cliente/abogado.</a>
	<br><br>		  
		   <a class='rojo'>			  
			  <b>Advertencia:</b>Usted esta conectado desde el <b>IP ".getRealIP()."</b>. Queda terminantemente prohibido utilizar este formulario de Consultas para enviar mensajes de contenido indebido y/o ilegal. El titular de este sitio Web se reserva el derecho de almacenar en nuestros servidores los logs de envío de este mensaje inclusive para fines judiciales.</a>
			  </td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		</form>
		"; 
}
//*******************************************************************************************************
//CONTACTO ENVIAR//
//*******************************************************************************************************
if(isset($contacto_enviar))
{
		if($nombre!='' and $correo!='@')
		 {
		  $resultado=mysql_query("select * from usuarios where cargo='WEBMASTER'"); 
		  $row=mysql_fetch_object($resultado);		  
$para=$row->correo.",".$mail_integrante;  
//$para="arielagramont@hotmail.com";
$asunto = "Contacto desde la Web: $tema";
$men = "
--------------------------
 CONSULTA JURÍDICA ONLINE
--------------------------
Para: $integrante - $mail_integrante
Nombre Completo del consultante: $nombre 
Correo Electrónico del consultante: <$correo> 
Teléfono/Fax. $telefono 
IP del consultante: $ip	
Tema : $tema
--------------------------
Mensaje:  $mensaje 

--------------------------

******************************************************************************************
Este es un mensaje que proviene del formulario de Consultas Jurídicas Online de su Oficina Jurídica Virtual. Si usted recibió este correo electrónico por error, notifiquelo a soporte@derechoteca.com y luego elimine el mismo. No intente acceder a ninguno de nuestros sistemas, caso contrario usted cometerá un delito informático sancionado bajo las leyes penales vigentes en su país.
******************************************************************************************
		  ";
		  $cabeceras = "From: $correo"; 
		  mail($para,$asunto,$men,$cabeceras); 
		 // echo"<br><br><center><a class='mail'>Su mensaje fue enviado, pronto le responderemos.  <br><br> Gracias!!!</center></br></a>";
		  echo" <META HTTP-EQUIV='Refresh' CONTENT='1;URL=index.php?p=contacto&m=1'>";exit();
		 }
		else
		 {
		 echo" <META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=contacto'>";exit();
		 }
}
//*******************************************************************************************************


//*************************************************************************************
// FIN // formulario contacto
//*************************************************************************************

//*******************************************************************************************************
// INICIO  //   OLVIDE MI CONTRASEÑA / NOMBRE DE USUARIO
//*******************************************************************************************************

function olvide()
{ 
global $m;
if($m==1) echo"<br><br><center><a class='mensaje'>Sus datos fueron enviados a su correo electrónico registrado en el sistema. <br>Gracias!!!</center><br></a>";
if($m==2) echo"<br><br><center><a class='mensaje'>&nbsp;&nbsp;&nbsp;&nbsp; En este momento el servicio no está disponible por favor contáctese con soporte@derechoteca.com &nbsp;&nbsp;&nbsp;</a></center><br>";
echo"<br>
     <form action='' method='POST'>
	 <a class='letras'>Escribe en la casilla tu <b>nombre de usuario</b> y recibirás al email registrado en el sistema la contraseña.</a><br>
	 <input class='tform' type='text' name='login'> 
	 <input name='olvide_contrasena' type='submit' class='boton' value='Enviar contraseña'>
	 </form>
	 <br>
	 <br>
	 <form action='' method='POST'>
	 <a class='letras'>Escribe en la casilla tu <b>dirección de correo electrónico registrada en el sistema</b> para recibir tú nombre de usuario y contraseña.</a><br>
	 <input value='@' class='tform' type='text' name='email'> 
	 <input name='olvide_todo' type='submit' class='boton' value='Enviar login y contraseña'>
	 </form>";
	 }	 

//*******************************************************************************************************
// REEENVÍO  DE  DATOS - OLVIDE MI CONTRASEÑA
//*******************************************************************************************************
if(isset($olvide_contrasena))
{
if($login!='')
		 {
		$resultado=mysql_query("select * from usuarios where login='$login'");        
		if(mysql_num_rows($resultado)>0)
		{$r=mysql_fetch_object($resultado);
		$para=$r->correo;	
		$asunto ="Olvide mi contraseña ";
		$con="
******************************************************************************************
Esta es una respuesta automática del WEBPANEL v.2.0. DERECHOTECA.COM 
******************************************************************************************
	NOMBRE COMPLETO: $r->usuario  
	E-MAIL : $r->correo 
	LOGIN :  $r->login
	CONTRASEÑA : $r->password
	
******************************************************************************************
Esta es una respuesta automática del sistema informático jurídico Derechoteca.com, si usted recibió este correo electrónico por error, notifiquelo a soporte@derechoteca.com y luego elimine el mismo. No intente acceder a ninguno de nuestros sistemas, caso contrario usted cometerá un delito informático sancionado bajo las leyes penales vigentes en su país.
******************************************************************************************
WEBPANEL v.2.0. DERECHOTECA.COM 1999-2006 TODOS LOS DERECHOS RESERVADOS
****************************************************************************************** ";
$cabeceras = "From: webmaster@derechoteca.com"; 
mail($para,$asunto,$con,$cabeceras); 
//echo"<br><br><center><a class='letras'>Su contraseña fue enviada a su correo electrónico registrado en el sistema. <br><br> Espere por favor <br> Gracias!!!</center></br></a>";
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=1'> ";
		} else 	{
		 //echo" <a class=''>El dato enviado está siendo verificado. <br><br>";
		 echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=2'>";
		} 	} 	else  {
		echo" <META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=2'> ";
		}   }
//*******************************************************************************************************
if(isset($olvide_todo))
{
if(($email!='') and ($email!='@'))
		 {
		$resultado=mysql_query("select * from usuarios where correo='$email'");        
		if(mysql_num_rows($resultado)>0)
		{$r=mysql_fetch_object($resultado);
		$para=$r->correo;
		$asunto ="Olvide mi nombre de usuario y contraseña";
		$con="
******************************************************************************************
Esta es una respuesta automática del WEBPANEL v.2.0. DERECHOTECA.COM 
******************************************************************************************
	NOMBRE COMPLETO: $r->usuario  
	E-MAIL : $r->correo 
	LOGIN :  $r->login
	CONTRASEÑA : $r->password
	
******************************************************************************************
Esta es una respuesta automática del sistema informático jurídico Derechoteca.com, si usted recibió este correo electrónico por error, notifiquelo a soporte@derechoteca.com y luego elimine el mismo. No intente acceder a ninguno de nuestros sistemas, caso contrario usted cometerá un delito informático sancionado bajo las leyes penales vigentes en su país.
******************************************************************************************
WEBPANEL v.2.0. DERECHOTECA.COM 1999-2006 TODOS LOS DERECHOS RESERVADOS
****************************************************************************************** ";
$cabeceras = "From: webmaster@derechoteca.com"; 
mail($para,$asunto,$con,$cabeceras); 
//echo"<br><br><center><a class='letras'>Su nombre de usuario y contraseña fueron enviados a su correo electrónico registrado en el sistema. <br><br> Gracias!!!</center></br></a>";
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=1'> ";
		} else 	{
		     //echo"<a class='important'>El dato enviado está siendo verificado. <br><br>";
			  echo" <META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=2'> ";
		} 	} 	else  {
		 echo" <META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?p=olvide&m=2'> ";
		}   }
//*******************************************************************************************************
// FIN // REEENVÍO  DE  DATOS - OLVIDE MI CONTRASEÑA
//*******************************************************************************************************

//************************************************************************************
// INICIO // FUNCIÓN PARA LA FECHA EN ESPANOL EJEMPLO  02 Enero 2006
//************************************************************************************
function fecha($fecha)
   { $dia=substr($fecha,8,2);
     $mes=substr($fecha,5,2);
     $ano=substr($fecha,0,4);
        switch($mes){ case '01':$mes="Enero";break;      case '02':$mes="Febrero";break;  case '03':$mes="Marzo";break;     case '04':$mes="Abril";break;
	   				  case '05':$mes="Mayo";break;       case '06':$mes="Junio";break;    case '07':$mes="Julio";break;     case '08':$mes="Agosto";break;
                      case '09':$mes="Septiembre";break; case '10':$mes="Octubre";break;  case '11':$mes="Noviembre";break; case '12':$mes="Diciembre";break;
                      case '00':$mes="00";break;
                     }
	 $f="$dia $mes $ano";
	 return $f;
   }
//************************************************************************************
// FIN // FECHA
//************************************************************************************ 		

//************************************************************************************
// FIN // MUESTRA LOGO
//************************************************************************************ 		
function logo()
{  
   $con=mysql_query("select * from contenido where tipo='tema'");
   $r=mysql_fetch_object($con);
   $tema=$r->subtipo; 
   if(file_exists("archivos/logo_$tema.jpg")) echo"<img src='archivos/logo_$tema.jpg'>"; 
   if(file_exists("archivos/logo_$tema.gif")) echo"<img src='archivos/logo_$tema.gif'>"; 
   if(file_exists("archivos/logo_$tema.swf")) echo"<img src='archivos/logo_$tema.swf'>"; 
}
//************************************************************************************
// FIN // MUESTRA LOGO
//************************************************************************************ 		

//************************************************************************************
// INICIO  //  IMAGEN ALEATORIA
//************************************************************************************ 

function imagen_aleatoria()
{
   $con=mysql_query("select * from contenido_doc where tipoarchivo ='jpg' or tipoarchivo ='gif' or tipoarchivo ='png'");   
   $num=mysql_num_rows($con);
   $i=1;
   while($row=mysql_fetch_object($con))
         { $imagen[$i]=$row->archivo;	
		   $i++;     
		 }
   $aleatorio=rand(1,$num);
   echo"<img src='archivos/$imagen[$aleatorio]' width='255' height='171'>";
   //echo"<img src='archivos/1.jpg' width='255' height='171'>";
   $row=mysql_fetch_object($con);   
   mysql_free_result($con);
}
//************************************************************************************
// FIN  //  IMAGEN ALEATORIA
//************************************************************************************ 

//****************************************************************************
//Funcion que obtiene la fecha del sistema  "  Lunes, 11 de Abril 2005 "
function fechasistema(){ 
	$dias = array("Monday"    => "Lunes"     ,"Lunes"     => "Monday", 
				  "Tuesday"   => "Martes"    ,"Martes"    => "Tuesday", 
				  "Wednesday" => "Miercoles" ,"Miercoles" => "Wednesday", 
				  "Thursday"  => "Jueves"    ,"Jueves"    => "Thursday", 
				  "Friday"    => "Viernes"   ,"Viernes"   => "Friday", 
				  "Saturday"  => "Sabado"    ,"Sabado"    => "Saturday", 
				  "Sunday"    => "Domingo"   ,"Domingo"   => "Sunday" ); 

	$mes = array("January"   =>"Enero"      ,"Enero"      => "January", 
				 "February"  =>"Febrero"    ,"Febrero"    => "February", 
				 "March"     =>"Marzo"      ,"Marzo"      => "March", 
				 "April"     =>"Abril"      ,"Abril"      => "April", 
				 "May"       =>"Mayo"       ,"Mayo"       => "May", 
				 "June"      =>"Junio"      ,"Junio"      => "June", 
				 "July"      =>"Julio"      ,"Julio"      => "July", 
				 "August"    =>"Agosto"     ,"Agosto"     => "August", 
				 "September" =>"Septiembre" ,"Septiembre" => "September", 
				 "October"   =>"Octubre"    ,"Octubre"    => "October", 
				 "November"  =>"Noviembre"  ,"Noviembre"  => "November", 
				 "December"  =>"Diciembre"  ,"Diciembre"  => "December"); 
	$fecha = $dias[date("l")] . ", " .date("d"). " de ". $mes[date("F")]. " ".date("Y"); 
	return $fecha; 
}

////////////////////////////////////////////////////////////////
//**************************************************************
// obtiene el ip 
function getRealIP()
{
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una dirección ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+.[0-9]+.[0-9]+.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0./',
                  '/^127.0.0.1/',
                  '/^192.168..*/',
                  '/^172.((1[6-9])|(2[0-9])|(3[0-1]))..*/',
                  '/^10..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }   
   return $client_ip;   
}
//// fin  
?>
<!--  ********************************************************************************************************************** -->
<html>
<head>
<title><?php titulo();?></title> 
<LINK href="../temas/balanza/css.css" rel=stylesheet>
<LINK href="../webpanel/css_panel.css" rel=stylesheet>
<LINK href="../temas/balanza/menu.css" rel=stylesheet>
<script>
navHover = function() {
	var lis = document.getElementById("navmenu").getElementsByTagName("LI");
	for (var i=0; i<lis.length; i++) {
		lis[i].onmouseover=function() {
			this.className+=" iehover";
		}
		lis[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" iehover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", navHover);
</script>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="<?php titulo();?>" name=description>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#ffffff">
<?php sesion();?>
<center>
<table border="0"  width="775" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td colspan="2"><div align="center">
  <?php logo();?>
  </div></td>
</tr>
<tr>
<td height="456" valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
<tr><td height="22">&nbsp;</td>
<td>&nbsp;
<a href="index.php" class="menu2"><img src="../temas/balanza/imagenes/home.gif" width="14" height="14" border="0"> Inicio</a>
<a href="?p=contacto" class="menu2"><img src="../temas/balanza/imagenes/consulta.gif" width="14" height="14" border="0"> Consultas Jurídicas Online</a></td></tr>
<tr>
<td width="210" height="399" valign="top">

<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="210"><img src="../temas/balanza/imagenes/left_top.gif" border="0" width="210" height="11" alt=""></td>
</tr>
<tr><td background="../temas/balanza/imagenes/back_left.gif">

<table width="205" border="0" cellpadding="0" cellspacing="0" background=""><form action="" method="get">
<tr>
<td style="padding-left:5"><a class="negro"><img src="../temas/balanza/imagenes/lupa.jpg" width="26" height="30"> Buscar en el sitio</a></td></tr>
<tr>
<td align="center"><input name="patron" type="Text" class="letras" size="20">
<input name="p" type="hidden" value="buscar"></td>
</tr>
<tr>
<td align="center"><input name="buscador"  type="submit"  value=" Buscar "></td>
</tr>
</form></table></td></tr>
<tr>
<td height="11"><img src="../temas/balanza/imagenes/left_bottom.jpg" border="0" width="210" height="11" alt=""></td>
</tr></table><br>

<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td><img src="../temas/balanza/imagenes/left_top.gif" border="0" width="210" height="11" alt=""></td>
</tr>
<tr><td height="18" background="../temas/balanza/imagenes/back_left.gif">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td style="padding-left:14;"><span class="t_lateral">
    <?php 					
echo"				
<ul id='navmenu'>
  <li><a href='index.php'>Inicio</a></li>";
   $res=mysql_query("SELECT * FROM contenido WHERE tipo='modular' and habilitado='on' order by nro");
      if(mysql_num_rows($res)>0)
   {
   while ($row=mysql_fetch_object($res))
      {     if($row->subtipo=='servicios' or $row->subtipo=='integrantes')
	  echo"<li><a href='#'>$row->titulo &nbsp; &rsaquo; </a></li>";
	        else 
	  echo"<li><a href='index.php?p=$row->id&tipo=$row->subtipo'>$row->titulo</a></li>";
            if($row->subtipo=='servicios')
		         {  
				 echo"<ul>";
				    $c=mysql_query("SELECT * FROM contenido WHERE ide='$row->id'");
                    while ($r=mysql_fetch_object($c)) 
				        {
	                    echo" <li><a href='?p=mostrar_servicios&id=$r->id&ide=$r->ide'>$r->titulo</a></li>";    
				  	    }
					    echo"</ul>";
				 }
            if($row->subtipo=='integrantes')
		         {  
				 echo"<ul>";
				    $c=mysql_query("SELECT * FROM contenido WHERE ide='$row->id'");
                    while ($r=mysql_fetch_object($c)) 
				        {
	                    echo" <li><a href='?p=mostrar_integrantes&id=$r->id&ide=$r->ide'>$r->titulo</a></li>";    
				  	    }
					    echo"</ul>";
				 }
		} 			 	
	}	
 echo"</ul>";
		?>
  </span></td>
  </tr></table>
</td></tr><tr>
<td><img src="../temas/balanza/imagenes/left_bottom.jpg" border="0" width="210" height="11" alt=""></td>
</tr></table><br>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="210"><img src="../temas/balanza/imagenes/left_top.gif" border="0" width="210" height="11" alt=""></td>
</tr><tr>
<td background="../temas/balanza/imagenes/back_left.gif"><table border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" style="padding-left:20"><img src="../temas/balanza/imagenes/pic_members_area.jpg" alt=""><a class="negro">Correo electr&oacute;nico</a></td>
</tr><tr>
<td width="97" align="right" ><a class="negro">Nombre:</a></td>
<td width="89" style="padding-top:5"><input type="text" name="login" size="10" maxlength="256"></td>
</tr><tr>
<td align="right"><a class="negro">Contrase&ntilde;a:</a></td>
<td style="padding-top:5"><input type="password" name="passwd" size="10" maxlength="256"></td></tr>
<tr><td colspan="2" style="padding-top:10; padding-left:80"><input type="submit" name="Input" size="10" value="Ingresar" ></td>
</tr></table></td></tr>
<tr>
<td height="11"><img src="../temas/balanza/imagenes/left_bottom.jpg" border="0" width="210" height="11" alt=""></td>
</tr></table>
<br>
<?php if(isset($p)) { 
		  
	echo"<table border='0' cellpadding='0' cellspacing='0'>
<tr>
<td><img src='../temas/balanza/imagenes/left_top.gif' border='0' width='210' height='11' alt=''></td>
</tr>
<tr><td background='../temas/balanza/imagenes/back_left.gif'>
<table width='200' border='0' cellpadding='0' cellspacing='0'>
<tr><td style='padding-left:12;'><div align='center'> 
<img src='../temas/balanza/imagenes/10documentos.gif' border='0'></div>"; 
 mostrar_doc_ultimos();  
echo"</td>
</tr></table>
</td></tr><tr>
<td><img src='../temas/balanza/imagenes/left_bottom.jpg' border='0' width='210' height='11' alt=''></td>
</tr></table>  "; 
	       }
	       ?></td>
<td background="../temas/balanza/imagenes/back_right_4.gif" valign="top">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="570"><img src="../temas/balanza/imagenes/right_2_top.gif" border="0" width="570" height="9" alt=""></td>
</tr><tr>
<td background="../temas/balanza/imagenes/back_right_4.gif" valign="top"><div align="right"></div></td></tr>
<tr><td background="../temas/balanza/imagenes/back_right_4.gif" valign="top">
<table width="533" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2" ><img src="../temas/balanza/imagenes/pic_news.jpg">    

<?php
echo "&nbsp;&nbsp;&nbsp;<a class='titulos'>".seccion($p)."</a><hr>";
?></td>
  </tr>
<tr>
  <td colspan="2" valign="top"><?php
    if (isset($p))
       { 
	 //  echo"<table width='99%'  border='0' cellspacing='0' cellpadding='0' align='center'><tr><td>";
          contenido();    
     //	  echo"</td></tr></table>";
        }
    else
   {
    echo"<table width='100%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td width='50%' valign='top'><table width='267' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='11' height='175'>&nbsp;</td>
          <td width='256' class='letras2'>"; 
		   inicio();
		  echo"</td>
        </tr>
        <tr><td height='214' background='../temas/balanza/imagenes/boletin.jpg'>&nbsp;</td>
          <td valign='top' background='../temas/balanza/imagenes/boletin.jpg'><br><br>";
		 $con=mysql_query("select * from contenido where tipo='boletin' order by id desc limit 0,10");   	 
			 $i=1;
			 while($row=mysql_fetch_object($con) and $i<=4)
				 {$texto=nl2br($row->contenido);
				  echo"<img src='../temas/balanza/imagenes/pic_plus1.gif'>
				  <a class='rojo'>$row->subtipo</a>
				  <a class='letras' href='index.php?p=boletin_mostrar&id=$row->id&ide=$row->ide'><b>$row->titulo</b> $row->fecha</a><br>";
				  }   
		 echo"</td>
        </tr>
      </table></td>
      <td width='50%' valign='top'><table width='263' border='0' cellpadding='0' cellspacing='1' class='t_consultas'>
    <form action='index.php' method='post'>  
      <tr>
        <td class='consultas'>&nbsp;</td>
        <td height='21' class='consultas'><div align='center'><img src='../temas/balanza/imagenes/consultas.gif' alt='Consultas Juridicas Online' width='224' height='35'></div></td>
      </tr>
      <tr>
        <td width='4%' class='consultas'>&nbsp;</td>
        <td width='96%' height='21' class='consultas'>Nombre Completo: </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name='nombre' type='text' class='consultas2' id='nombre' size='40'>
          </label></td>
        </tr>
      <tr>
        <td class='consultas'>&nbsp;</td>
        <td height='21' class='consultas'>Correo Electr&oacute;nico:</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name='correo' type='text' class='consultas2' id='correo' value='@' size='40'></td>
        </tr>
      <tr>
        <td class='consultas'>&nbsp;</td>
         <td height='21' class='consultas'>Teléfono de Contacto:</td>
	   </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name='telefono' type='text' class='consultas2' id='telefono' size='40'></td>
        </tr>
      <tr>
        <td class='consultas'>&nbsp;</td>
         <td height='22' class='consultas'>Materia Juridica de la Consulta:</td>
	   </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name='tema' type='text' class='consultas2' id='tema' size='40'></td>
        </tr>
      <tr>
        <td class='consultas'>&nbsp;</td>
         <td height='21' class='consultas'>Consulta:</td>
	   </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <textarea name='mensaje' cols='40' rows='5' class='consultas2'></textarea>
          </label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height='37'>
<input name='integrante' type='hidden' value='GENERAL'>
<input name='contacto_enviar' type='hidden' class='boton' value='Enviar Mensaje'>   
<input name='contacto_enviar' type='image' src='../temas/balanza/imagenes/consultas_enviar.gif' title='ENVIAR CONSULTA JURIDICA ONLINE'>	</td>
        </tr>
      <tr>
        <td class='letras'>&nbsp;</td>
        <td height='37' class='letras'>* El env&iacute;o de la consulta mediante este formulario no entabla ninguna relaci&oacute;n jur&iacute;dica cliente/abogado.</td>
        </tr></FORM>
  </table></td>
    </tr>
  </table>";
     //	 inicio();
	}
   ?></td>
  </tr>
<tr>
  <td colspan="2" valign="top"></td>
</tr>
<tr>
  <td width="270" valign="top">&nbsp;</td>
  <td width="263" valign="top"></td>
</tr>
</table></td></tr></table></td></tr>
<tr><td width="210" height="61" valign="top">&nbsp;</td>
<td width="570" valign="bottom" background="../temas/balanza/imagenes/back_right_4.gif"><table border="0" cellpadding="0" cellspacing="0" height="100%"><tr>
<td width="576" height="61" valign="bottom" background="../temas/balanza/imagenes/back_right_4.gif">
<img src="../temas/balanza/imagenes/right_4_bottom.gif" border="0" width="570" height="61" alt=""></td>
</tr></table></td>
</tr><tr>
<td colspan="2" height="17"><img src="../temas/balanza/imagenes/bottom.jpg" border="0" width="780" height="17" alt=""></td>
</tr>
<tr>
<td height="2" colspan="2" align="center" background="../temas/balanza/imagenes/back_bottom.gif" ></td>
</tr>
<tr><td height="18" colspan="2" align="center" ><a class="l_blanco">
<?php echo"<a class='letras'>".pie()."</a>";?></a></td>
</tr><tr>
<td height="18" colspan="2" align="center">
<?php 		
        if(!isset($_SESSION["SESSION"])) 
  		echo"<br><a class='derechoteca' href='?p=login'>Iniciar Sesi&oacute;n</a><br>"; 				
        echo"<a class='derechoteca'>";include ("http://www.derechoteca.com/biblioteca/copyright.php");echo"</a>";		
		echo"</a>";?></td></tr></table></td></tr></table>
</center>
</body>
</html>