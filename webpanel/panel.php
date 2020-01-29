<?php 
session_start();
if(!isset($_SESSION["SESSION"]))  	
 {  echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php?p=login'>";
    exit();
 }
include("../globals.php"); 
include("enlace.php");   
?>
<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// -->
</script>

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
<script>  
//************************************************************************************
//PARA CONFIRMAR : ELIMIAR REGISTROS confirrmar('?p=e&id=3','3')
//************************************************************************************
function confirmar(a,b)
{
   if(confirm("     ¿  Esta seguro de eliminar ?     "))  
     {alert("     ¿ Se eliminara el registro ?    "); location.href=(a);
	 }
 }
</script>
<script language="JavaScript" type="text/JavaScript">
//************************************************************************************
//VENTANA POP PUP
//************************************************************************************
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<?php 
connect();

//************************************************************************************
// INICIO //  CONTENIDO
//************************************************************************************

function contenido_panel()
{
global $pa,$id;   
		if($pa=='pie') actualizar_contenido_comum();
		elseif($pa=='titulo') actualizar_contenido_comum();
		elseif($pa=='inicio') actualizar_contenido_comum();
		elseif($pa=='etiquetas') actualizar_contenido_comum();
		elseif($pa=='nseccion') nuevaseccion();
 	    elseif($pa=='nmodulo') nuevomodulo();
		
		elseif($pa=='logo') logo_actualizar();
        
		elseif($pa=='usuario')usuario_actualizar();

		elseif($pa=='boletin')adm_boletin();
		elseif($pa=='boletin_insertar') insertar_boletin();
		elseif($pa=='boletin_actualizar') actualizar_boletin();

		//****** 
		elseif($pa=='enlaces')adm_enlaces($id);
		elseif($pa=='enlaces_insertar')insertar_enlaces();
		elseif($pa=='enlaces_actualizar') actualizar_enlaces();
		//******
		elseif($pa=='galeria') adm_galeria();
		elseif($pa=='galeria_insertar') insertar_galeria();
		elseif($pa=='galeria_actualizar') actualizar_galeria();
		//******
		elseif($pa=='servicios') adm_servicios();
		elseif($pa=='servicios_insertar') insertar_servicios();
		elseif($pa=='servicios_actualizar') actualizar_servicios();
		//******
		elseif($pa=='integrantes') adm_integrantes();
		elseif($pa=='integrantes_insertar') insertar_integrantes();
		elseif($pa=='integrantes_actualizar') actualizar_integrantes();
	    elseif($pa=='foto_integrantes') foto_integrantes();		
		//******		
		elseif($pa=='estandar') adm_estandar();
		//*******
		elseif($pa=='actualizar_documentos')actualizar_documentos();
		elseif($pa=='insertar_documentos')insertar_documentos();
		elseif($pa=='usuario_actualizar' )usuario_actualizar();
		
		elseif($pa=='salir')salir();
		elseif($pa=='tema')tema();
		
		elseif($pa=='nro') numeracion();		
		
      //  else actualizar_contenido('');	      
       
}  

//************************************************************************************
// INICIO // SECCION   ****   TITULO DE CADA SECCIÓN DE CONTENIDO
//************************************************************************************
function seccion($x)
{  
  if($x=='')return 'Inicio';
  if($x=='contacto')return "Consultas Online";
  if($x=='mapa')return "Mapa del Sitio";
  if($x=='boletin')return "Boletín Informativo";
  if($x=='boletin_mostrar')return "Boletín Informativo";
  if($x=='olvide')return "Olvide Mi Nombre de Usuario y/o Contraseña";
  if($x=='enlaces')return "Enlaces de Interés";
  if($x=='galeria')return "Galeria de Imagenes";
  if($x=='integrantes' or $x=='mostrar_integrantes')return "Integrantes";
  if($x=='servicios' or $x=='mostrar_servicios')return "Servicios";
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
 if($_SESSION["SESSION"])
  {  echo"<table border='0' align='center' cellspacing='0' class='p_cuadro'>
  <tr>
    <td width='204' rowspan='2'><div align='center'><img src='../webpanel/imagenes/p_logo.jpg' alt='Logo Derechoteca' width='185' height='36' longdesc='http://www.derechoteca.com'></div></td>
    <td width='2'></td>
    <td height='21' class='p_subtit3'>Bienvenido (a) </td>
    <td><div align='center'><a href='../index.php' class='p_link2'>Ver Sitio Web</a></a> <span class='p_link2'>| </span><a href='panel.php' class='p_link2'>Panel de Administraci&oacute;n</a> <span class='p_link2'>| </span><a href='?pa=salir' class='p_link2'>Cerrar Sesi&oacute;n</a></div></td>
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
		  <option value='panel.php?pa=titulo'>Título del Sitio Web</option>
	      <option value='panel.php?pa=pie'>Pie de P&aacute;gina</option>
 	      <option value='panel.php?pa=inicio'>Inicio</option>
	      <option value='panel.php?pa=etiquetas'>Etiquetas</option>
	      <option value='panel.php?pa=usuario'>Datos del Usuario</option>
	      <option value='panel.php?pa=logo'>Cargar Logotipo al Sitio Web</option>
	      <option value='#' target='top'>__________________________________________________ </option>
	      <option value='#' target='top'> OPCIONES DEL MENU </option>
	      <option value='#' target='top'>__________________________________________________ </option>		  
		  <option value='panel.php?pa=nmodulo'>--- Crear una nueva opción en el menu ---</option>";
	      $res=mysql_query("SELECT * FROM contenido WHERE tipo='modular' order by nro");
          while ($row=mysql_fetch_object($res))
		  echo"<option value='panel.php?pa=$row->subtipo&id=$row->id'>$row->titulo</option>";
		  
	 
		  echo"<option value='#' target='top'>__________________________________________________ </option>
		  <option value='#' target='top'>SELECCIONAR DISEÑO </option>
		  <option value='#' target='top'>__________________________________________________ </option>		  ";
		            $d=dir("../temas");
          while($entry=$d->read())
		    {if($entry<>'.' and $entry<>'..')
               echo "<option value='sql.php?tema=$entry' target='top'>Diseño $entry</option>";
            }
         $d->close();
          echo"</select></div></td> </tr></table>";
    }
}
//************************************************************************************
// FIN // SESION
//************************************************************************************

//************************************************************************************
// SALIR O ELIMIAR LAS VARIABLES DE SESSIONES 
//************************************************************************************

function salir()
{
session_start();
session_destroy();
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";//redireccion
}

//************************************************************************************
// FIN // MUESTRA LOGO
//************************************************************************************ 		
function logo()
{  echo"<div align='center'>";
   $con=mysql_query("select * from contenido where tipo='tema'");
   $r=mysql_fetch_object($con);
   $tema=$r->subtipo;   
   if(file_exists("../archivos/logo_$tema.jpg")) echo"<img src='../archivos/logo_$tema.jpg'>"; 
   if(file_exists("../archivos/logo_$tema.gif")) echo"<img src='../archivos/logo_$tema.gif'>"; 
   if(file_exists("../archivos/logo_$tema.swf")) echo"<img src='../archivos/logo_$tema.swf'>"; 
   echo"</div>";
}
//************************************************************************************
// FIN // MUESTRA LOGO
//************************************************************************************ 	

//************************************************************************************
// INICIO // OPERACIONES CON MODULOS TIPO BOLETIN
//************************************************************************************
function adm_boletin()
{ 
global $id,$listo,$pa;
if($listo==1) listo();
if($listo==2) echo"<a class='p_mensaje'>Ocurrio algun error al subir el archivo</a>";
if($listo==3) echo"<a class='p_mensaje'>No examino un archivo</a>";
if($listo==2) echo"<a class='p_mensaje'>El archivo es muy grande</a>";
echo"<br><br>";
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
	 echo"
	      <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>";
		  ?><input type='text' name='titulo' value="<?php echo"$r->titulo";?>" size='50'><?php
		  echo"</span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$r->id'>	  		  
		  </form>
		  
		  <a href='?pa=boletin_insertar&id=$id&paux=$pa'><img src='imagenes/p_insertboletin.gif' alt='Insertar nuevo registro en $r->titulo' width='193' height='19' border='0'></a><br><br>
          <table border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
          <tr class='p_subtit6'>
          <td width='14' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='52' bgcolor='#333333'><div align='center'>Subtipo</div></td>
                <td width='456' bgcolor='#333333'><div align='center'>T&iacute;tulo principal del registro </div></td>
                <td width='28' bgcolor='#333333'><div align='center'>doc.</div></td>
                <td width='21' bgcolor='#333333'><div align='center'>link</div></td>
                <td width='25' bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='34' bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";
                $i=1; 
				$consulta=mysql_query("SELECT * FROM contenido where tipo='boletin' and ide='$id' order by id desc");
				while($row=mysql_fetch_object($consulta))
				{		  
			    echo"
                <tr>
                <td class='p_linea'><div align='center' class='p_link4'><strong>$i</strong></div></td>
                <td class='p_linea'><div class='p_link5' align='center'>$row->subtipo</div></td>
                <td class='p_linea'>
				<a class='p_link3' target='_self' href='../index.php?p=boletin_mostrar&id=$row->id' title='Para ver este registro con sus documentos adjuntos hacer click aquí... Fecha de registro: $row->fecha_reg - Fecha de actualización: $row->fecha_act' target='_blank'>$row->titulo</a> <span class='p_link4'>[$row->fecha]</span> 
				<br><br>";
 	             adm_documentos($row->id,$id); //documentos relacionados
				 echo"<br>";
		         lista_enlaces($row->id,$id);  // enlaces relacionados 				 		 
				echo"</td>
                <td class='p_linea'><div align='center'><a href='?pa=insertar_documentos&id=$row->id&paux=$pa&aux=$id'>	  
	            <img src='imagenes/upload.gif' border='0' title='Adjuntar nuevo documento para : $row->titulo'></a></div></td>
                <td class='p_linea'><div align='center'><a href='?pa=enlaces_insertar&id=$row->id&paux=$pa&aux=$id'>	  
	            <img src='imagenes/enlace.jpg' border='0' title='Adjuntar nuevo enlace para : $row->titulo'></a></div></td>
                <td class='p_linea'><div align='center'><a href='?pa=boletin_actualizar&id=$row->id&ide=$row->ide&paux=$pa'><img src='imagenes/actualizar.gif' border='0' title='Actualizar: $row->titulo'></a></div></td>
                <td class='p_linea'>  <div align='center'><a href='#' onclick=confirmar('sql.php?delete=$row->id&&paux=$pa&aux=$row->ide','$row->id')> <img src='imagenes/eliminar.gif' border='0' title='Eliminar el boleitn con sus documentos adjuntos'></a></div></td>
                </tr>";
                $i++;
               }
              echo"</table>";

}
function insertar_boletin()
{ 
global $id,$titulo,$paux,$pa;
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
  	 echo"<br><a class='p_tit'>Insertar nuevo registro en: </a> <a class='p_formtit'>$r->titulo</a><br><br>";

echo"
     <table width='100%' border='0' cellpadding='0' cellspacing='1'>
    <tr>
	<form id='form1' name='form1' method='post' action='sql.php'>
    <td width='167' height='29'>
	<div class='p_formtit' align='right'>Subtipo &nbsp;</div></td>
    <td width='192'><div align='left'><select name='subtipo' class='p_link3'>
	<option>Eventos</option><option>Seminario</option><option>Anuncio</option><option>Lo último</option><option>Importante</option><option>Libros
    <option>Comentarios</option><option>Notas de prensa</option><option>Comunicados</option>
	<option>Post Grados</option><option>E-Articulo<option>Fotos</option><option>Articulo</option>
	<option>Notas</option><option>Curso</option><option>Invitación</option><option>Convocatoria</option><option>Diplomado</option><option>Maestrias</option><option>Varios</option>
    </select></div></td>
    <td width='124'><div class='p_formtit' align='right'>Fecha &nbsp;</div></td>
    <td width='265' align='left'>
	<input name='fecha' type='text' size='39'>
	</td></tr>
    <tr>
    <td><div class='p_formtit' align='right'>Título&nbsp;</div></td>
    <td colspan='3'><div align='left'><input name='titulo' type='text' size='90'>
    </div></td>
    </tr> 
    <tr>
    <td height='159'><div class='p_formtit' align='right'>Contenido&nbsp;</div></td>
    <td colspan='3'><div align='left'>
	<textarea name='contenido' style='width:565; height:150' WRAP='virtual'>$row->contenido</textarea>";
	?>
	<script language="javascript1.2">editor_generate('contenido');</script>
	<?php
    echo"</div><br></td>
     </tr>
     <tr><td></td>
     <td colspan='3'>
	 <input name='id' value='$id' type='hidden'> 
	 <input name='aux' value='$id' type='hidden'>
	 <input name='paux' value='$paux' type='hidden'>	 	 
	 <input name='pa' value='$pa' type='hidden'>	 	 
	 <input name='tipo' value='boletin' type='hidden'>	 
	 <input type='hidden' name='insert'/>
 	 <input type='image' src='imagenes/p_insertboletin.gif' border='0'>
	 </td></form>
	 </tr></table>";
}

function actualizar_boletin()
{ 
global $id,$ide,$paux;
$con=mysql_query("SELECT * FROM contenido WHERE id='$ide'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
           
           $consulta=mysql_query("SELECT * FROM contenido WHERE id='$id'"); 
           $row=mysql_fetch_object($consulta);
  	     echo"<br>
              <a class='p_tit'>Actualizar: </a> <a class='p_formtit'>$r->titulo</a><br><br>";		   
           echo"
		   <form id='form1' name='form1' method='post' action='sql.php'>
				<table>
				<tr>
				<td width='167' height='29'><div class='p_formtit' align='right'>Subtipo &nbsp;</div></td>
				<td width='192'><div align='left'><select name='subtipo'>
                <option>$row->subtipo</option>
				<option>Eventos</option><option>Seminario</option><option>Anuncio</option><option>Lo último</option><option>Importante</option><option>Libros
				<option>Comentarios</option><option>Notas de prensa</option><option>Comunicados</option>
				<option>Post Grados</option><option>E-Articulo<option>Fotos</option><option>Articulo</option>
				<option>Notas</option><option>Curso</option><option>Invitación</option><option>Convocatoria</option><option>Diplomado</option><option>Maestrias</option><option>Varios</option>
				</select></div></td>
				<td width='124'><div class='p_formtit' align='right'>Fecha &nbsp;</div></td>
				<td width='265'>
				   <input name='fecha' type='text' size='50' value='$row->fecha'>
				</td>
			  </tr>
			  <tr>
				<td><div class='p_formtit' align='right'>Título </div></td>
				<td colspan='3'><div align='left'><input name='titulo' type='text' size='90' value='$row->titulo'>
				</div></td>
			  </tr> 
			  <tr>
				<td height='159'><div class='p_formtit' align='right'>Contenido&nbsp;</div></div></td>
				<td colspan='3'><div align='left'>
				  <textarea name='contenido' style='width:565; height:150'  WRAP='virtual'>$row->contenido</textarea>";
				  ?>
				  <script language="javascript1.2">editor_generate('contenido');</script>
				  <?php
				   cuadrotexto(); 
				  echo"</div><br></td>
                  </tr><td colspan='4' align='center'>
			      <br>
                  <a class='p_subtit4'>Fecha de Registro: $row->fecha_reg' - Fecha de última actualización: $row->fecha_act'</a>  <br>
		          <input type='hidden' name='id' value='$row->id'/>
	              <input name='aux' value='$ide' type='hidden'>	 				  
 		          <input type='hidden' name='tipo' value='$row->tipo'>
		          <input type='hidden' name='pa' value='$pa'/><br>		  
		          <input type='hidden' name='paux' value='$paux'/><br>				  
		          <input type='hidden' name='update'/>
 	              <input type='Image' src='imagenes/p_act.jpg' border='0'>
				  </td>
				  </tr>
			      </table>	
				 </form> 		   			   
			   ";
}
//************************************************************************************
// FIN // OPERACIONES CON MODULOS TIPO BOLETIN
//************************************************************************************

//************************************************************************************
// INICIO // OPERACIONES CON MODULOS TIPO ENLACES
//************************************************************************************
function adm_enlaces($id)
{
global $pa,$aux,$listo;
if($listo==1)listo();
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo

echo" 	  <br>
          <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>
		  ";
		  ?><input type='text' name='titulo' value="<?php echo"$r->titulo";?>" size='50'><?php
		  echo"
		  </span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$r->id'>	  		  
		  </form>			  
     <a href='?pa=enlaces_insertar&id=$id&paux=$pa&aux=$id'><img src='imagenes/p_insertenlace.gif' border='0'></a><br><br>"; //para que el boton insertar
     lista_enlaces($r->id,$id);
}
function lista_enlaces($id,$id3)
{  global $pa,$aux;
   $consulta=mysql_query("SELECT * FROM contenido where ide='$id'");	
   if(mysql_num_rows($consulta)>0)
   {
            echo"<table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr>
            <td width='100%' height='16' colspan='5'> 			
			
			<img src='imagenes/p_enl.gif' width='348' height='18'>			
			</td>
            </tr>
            </table>
            <table width='100%' border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
            <tr class='p_subtit6'>
                <td width='4%' height='14' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='76%' bgcolor='#333333'><div align='center'>T&iacute;tulo del enlace </div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>ver</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='6%' bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";
			  $i=1; 
		 	
          while($row=mysql_fetch_object($consulta))
          {
	      echo"
         <tr><td class='p_linea' align='center' bgcolor='#FFFFFF'><a class='p_link4'><b>$i</b></a></td>
	     <td class='p_linea'>
         <a class='p_link3' href='$row->contenido' title='Fecha de registro: $row->fecha_reg - Fecha de actualización: $row->fecha_act' target='_blank'>$row->titulo</a>
         &nbsp; - &nbsp;
         <a class='p_link5' href='$row->contenido' title='Para ver este enlace haga click aquí... Fecha de registro: $row->fecha_reg - Fecha de actualización: $row->fecha_act' target='_blank'>$row->contenido</a>
         <td class='p_linea' align='center'><a href='$row->contenido' target='_blank' class='p_link3'>Ver</a></td>
	 
         <td class='p_linea'><div align='center'>
	     <a href='?pa=enlaces_actualizar&id=$row->id&ide=$row->ide&paux=$pa&aux=$id3'><img src='imagenes/actualizar.gif' border='0' title='Actualizar: $row->titulo'></a></div></td>
         <td class='p_linea'>";
		     if ($id3=='') $id4=$id;  else $id4=$id3;
		 echo"<div align='center'><a href='#' onclick=confirmar('sql.php?delete=$row->id&paux=$pa&aux=$id4','$row->id')> <img src='imagenes/eliminar.gif' border='0' title='Eliminar: $row->titulo'></a></div></td>
         ";
         $i++;
        }
        echo"</table>";	
	  }
}

function insertar_enlaces()
{
  global $id,$listo,$pa,$paux,$aux;
    if($listo==1)listo(); 
	$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
    $r=mysql_fetch_object($con);//para el titulo

	echo"<form id='form1' name='form1' method='post' action='sql.php'>";
    echo"<br>
	<a class='p_tit'>Insertar registro en:</a> <a class='p_formtit'>$r->titulo</a><br><br>";		
 	echo"
	<table width='100%' border='0' cellpadding='0' cellspacing='1'>
    <tr>
    <td><div class='p_formtit' align='right'>Título del enlace&nbsp;</div></td>
    <td colspan='3'><div align='left'>
	<input name='titulo' type='text' size='60'>
    </div></td></tr>
    <tr>
    <td height='28'><div class='p_formtit' align='right'>Dirección URL&nbsp;</div></td>
    <td colspan='3'>
	<div align='left'><input name='contenido' type='text' value='http://'size='60'>
     </div></td>
     </tr>
	 <tr><td colspan='3' align='center'>
	 <br>	 
     <input name='id' value='$id' type='hidden'>";

	 if($aux!='')  echo"<input name='aux' value='$aux' type='hidden'>"; //para la redireccion
     else echo"<input name='aux' value='$id' type='hidden'>";	 				  	 
	 
	 echo"<input name='pa' value='$pa' type='hidden'>	
	 <input name='paux' value='$paux' type='hidden'>		 
	 <input name='tipo' value='enlaces' type='hidden'>
	 <input type='hidden' name='insert'/>
 	 <input type='Image' src='imagenes/p_insertenlace.gif' border='0'>
	 </td></tr>
	 </table>";
     echo"</form>";
} 
function actualizar_enlaces()
{ global $id,$ide,$paux,$aux; 
	$con=mysql_query("SELECT * FROM contenido WHERE id='$ide'");//para el titulo			
    $r=mysql_fetch_object($con);//para el titulo
	echo"<form id='form1' name='form1' method='post' action='sql.php'>";
    echo"<br>
	<a class='p_tit'>Actualizar:</a> <a class='p_formtit'>$r->titulo</a><br><br>";		
	  $con=mysql_query("SELECT * FROM contenido WHERE id='$id'"); 	     
      $row=mysql_fetch_object($con);
 	         echo"
			 <table><tr><td>
			 <input name='subtipo' type='hidden' value='$row->subtipo'>
		     <a class='p_formtit'>Título del enlace&nbsp;: </a>
			 <input name='titulo' type='text' size='70' value='$row->titulo'><br>
			 <a class='p_formtit'>Dirección URL&nbsp;: &nbsp;&nbsp;</a>
	         <input name='contenido' type='text' value='$row->contenido'size='80'>
			 </td>
			 </tr><td colspan='4' align='center'>
             <a class='p_subtit4'>Fecha de Registro: $row->fecha_reg' - Fecha de última actualización: $row->fecha_act'</a>  <br>
		     <input type='hidden' name='id' value='$row->id'>
		     <input type='hidden' name='pa' value='$pa'><br>";			 
             
			 if($aux!='')echo"<input name='aux' value='$aux' type='hidden'>";
			   else echo"<input name='aux' value='$ide' type='hidden'>";
			 
			 echo"<input name='paux' value='$paux' type='hidden'>	 				  			 
		     <input type='hidden' name='tipo' value='$row->tipo'>
		     <input type='hidden' name='update'>
 	         <input type='Image' src='imagenes/p_act_enl.gif' border='0'>
		     </td></tr></table>
			 "; 		 
	
}
//************************************************************************************
// FIN // OPERACIONES CON MODULOS TIPO ENLACES
//************************************************************************************

//************************************************************************************
// INICIO //INSERTAR EN LA GALERIA DE FOTOS
//************************************************************************************
function adm_galeria()
{
global $id,$pa,$listo,$aux,$paux;
  if($listo==1) echo"<div align='center' class='p_mensaje'>Se cargo el archivo con éxito !!!</div>";
  if($listo==2) echo"<div align='center' class='p_mensaje'>Debe especificar un archivo valido !!!</div>";
  if($listo==3) echo"<div align='center' class='p_mensaje'>No es un archivo valido gif o jpg !!!</div>";
  
         $con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
         $r=mysql_fetch_object($con);//para el titulo
  		 echo"<br>
          <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>
		  ";
		  ?><input type='text' name='titulo' value="<?php echo"$r->titulo";?>" size='50'><?php
		  echo"
		  </span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$r->id'>	  		  
		  </form>			 
			  
	          <a href='?pa=galeria_insertar&id=$id'><img src='imagenes/p_inser_foto.gif' border='0'></a><br><br>
              <table border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
              <tr class='p_subtit6'>
                <td width='28' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='485' bgcolor='#333333'><div align='center'>T&iacute;tulo de la foto y otros datos </div></td>
                <td width='30' bgcolor='#333333'><div align='center'>ver</div></td>
                <td width='34' bgcolor='#333333'><div align='center'>tipo</div></td>
                <td width='29' bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='32' bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";
			$i=1;
$consulta=mysql_query("SELECT * FROM contenido_doc WHERE id='$id' order by id2 desc");			
while($row=mysql_fetch_object($consulta))
     {     echo"<tr>
                <td class='p_linea'><div align='center' class='p_link4'><b>$i</b></div></td>
                <td class='p_linea'><a href='../archivos/$row->archivo' title='$row->descripcion - Fecha de registro: $row->fecha_reg  - Fecha de actualización: $row->fecha_act' target='_blank' class='p_link3'>$row->tituloarchivo</a></td>
                <td class='p_linea'><a href='../archivos/$row->archivo' target='_blank' class='p_link3'>Ver</a></td>
                <td class='p_linea'><a class='p_link5'>$row->tipoarchivo</a></td>
                <td class='p_linea'><a href='?pa=galeria_actualizar&id2=$row->id2&id=$row->id&paux=$pa'><img src='imagenes/actualizar.gif' border='0' title='Actualizar Registro'></a></td>
                <td class='p_linea'><a href='#' onclick=confirmar('sql.php?delete_doc=$row->id2&paux=$pa$aux=$id','$row->id2')><img src='imagenes/eliminar.gif' border='0' title='Eliminar Registro'></a></td>
                </tr>";
				$i++;
	 }		
echo"</table>";
}
function insertar_galeria()
{
global $id,$pa,$listo;
  if($listo==1) echo"<div align='center' class='mensaje'><br>Se cargo el archivo con éxito !!!<br><br></div>";
  if($listo==2) echo"<div align='center' class='mensaje'><br>Debe especificar un archivo valido !!!<br><br></div>";
  if($listo==3) echo"<div align='center' class='mensaje'><br>No es un archivo valido gif o jpg !!!<br><br></div>";
          $con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
          $r=mysql_fetch_object($con);//para el titulo

  		 echo"<br>
              <a class='p_tit'>Insertar registro en: </a>
			  <a class='p_formtit'>$r->titulo</a> &nbsp;
	         <br><br>";
echo"<table width='100%' border='0' align='center' cellpadding='0' cellspacing='1'>
  <form  method='post' action='sql.php' enctype='multipart/form-data'>
    <tr>
      <td width='22%' height='28' class='p_formtit'><div align='right'>Título de la foto&nbsp;</div></td>
      <td width='78%' colspan='2'><input name='tituloarchivo' type='text' size='50'></td>
    </tr> 
	<tr>
    <td height='40' class='p_formtit'><div align='right'>Examinar imagen &nbsp;</div></td>
    <td><input name='archivo' type='file'><a class='p_link2'>* Solo archivos  .gif o .jpg hasta 800 Kb max.</a>    </td>
    </tr>	
  <tr>
    <td height='62' valign='top'>
	<div class='subtitulos2' align='right'><span class='p_formtit'>Breve descripción &nbsp;</span><br>
    </div></td>
    <td>
      <textarea name='descripcion' cols='40' rows='3'  WRAP='virtual'></textarea>
      <a class='p_link2'>(Opcional)</a> </td>
  <tr> 
  <tr>
     <td></td>
     <td>
	 <div align='left'>
	 <input name='tipoarchivo' value='galeria' type='hidden'>
     <input name='id' value='$id' type='hidden'>
     <input name='aux' value='$id' type='hidden'>	 				  
     <input name='paux' value='$pa' type='hidden'>	 				  
     <input name='pa' value='$pa' type='hidden'>
     <input name='tipo' value='galeria' type='hidden'>	 
	 <input type='hidden' name='insert_galeria'/>
 	 <input type='Image' src='imagenes/p_inser_foto.gif' border='0'></div>
	 </td>
   </tr> 
   </form>
  </table>";
 }

function actualizar_galeria()
{
global $pa,$id2,$id,$aux,$paux;
  if($listo==1) echo"<div align='center' class='mensaje'>Se cargo el archivo con éxito !!!</div>";
  if($listo==2) echo"<div align='center' class='mensaje'>Debe especificar un archivo valido !!!</div>";
  if($listo==3) echo"<div align='center' class='mensaje'>No es un archivo valido gif o jpg !!!</div>";
  if($listo==1) listo();
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
  
$consulta=mysql_query("SELECT * FROM contenido_doc where id2='$id2'");
$row=mysql_fetch_object($consulta);
  		 echo"<a class='p_subtit'>Secci&oacute;n Modular</a><br>
              <a class='p_tit'>Actualizar: </a>
			  <a class='p_formtit'>$r->titulo</a>";

echo"<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='324' valign='top'><table width='317' border='0' align='left' cellpadding='4' cellspacing='1' bgcolor='#333333'>
      <form action='sql.php' method='post' enctype='multipart/form-data'>
        <tr>
          <td colspan='2'><div align='center' class='p_subtit2'>ACTUALIZAR DATOS DE LA FOTO </div></td>
        </tr>

        <tr>
          <td width='111' valign='middle'><div class='p_formtit' align='right'>T&iacute;tulo </div></td>
          <td width='187' ><input name='tituloarchivo' type='text' value='$row->tituloarchivo' size='30' /></td>
        </tr>
        <tr>
          <td><div class='p_formtit' align='right'>Breve Descripci&oacute;n</div></td>
          <td ><textarea name='descripcion' cols='25' rows='3'  WRAP='virtual'>$row->descripcion</textarea></td>
        </tr>
        <tr>
          <td>
		      <input name='id2' value='$row->id2' type='hidden'/>
              <input name='pa' value='$atras' type='hidden'/>
			  <input name='aux' value='$id' type='hidden'/>
		      <input name='paux' value='$paux' type='hidden'>				  
			  <input name='tipoarchivo' value='$row->tipoarchivo' type='hidden'/>
			  </td>
          <td ><input name='update_doc' type='submit' class='boton' value='Actualizar datos de la imagen' /></td>
        </tr>
      </form>
    </table></td>
    <td width='319' align='right' valign='top'>
	<table width='287' border='0' align='center' cellpadding='4' cellspacing='1' bgcolor='#333333'>
  <form action='sql.php' method='post' enctype='multipart/form-data'>
    <tr>
      <td colspan='2'><div align='center' class='p_subtit2'>REEMPLAZAR LA FOTO POR OTRA</div></td>
    </tr>
    <tr>
      <td height='74' colspan='2'><div class='p_formtit' align='right'>
        <div align='left'>Examinar nuevo documento</div>
      </div>
        <input name='archivo' type='file' class='enlace' value='$row->archivo' size='20'/><br>
        <a class='p_link2'>Max. 2 MB</a></td>
      </tr>
    <tr>
      <td width='188' height='43'><input name='insert_galeria' type='submit' class='boton' value='Reemplazar imagen'/></td>
      <td width='80' valign='top'><input name='id3' value='$row->id' type='hidden'/>
        <input name='tipoarchivo' value='galeria' type='hidden'/>
	    <input name='id2' value='$row->id2' type='hidden'/>
        <input name='aux' value='$id' type='hidden'>
		<input name='paux' value='$paux' type='hidden'>	 				  		
        <input name='pa' value='$atras' type='hidden'/>
    </tr>
  </form>
</table>
	</td>
  </tr>
</table>";
}
//****************************************************************
// FIN //INSERTAR EN LA GALERIA DE imagenes
//*****************************************************************


//*****************************************************************
//INICIO //  OPERACIONES CON TIPO DE PAGINAS ESTANDAR
//*****************************************************************
function adm_estandar()
{
global $id,$pa,$listo;
		  if($listo==1) listo1(); 
		  if($listo==2)  echo"<div align='center' class='p_mensaje'>Debe especificar un titulo</a></div>";

		  $consulta=mysql_query("SELECT * FROM contenido where id='$id'");
		  $row=mysql_fetch_object($consulta);
		  echo"<br>
		  <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>
		  ";
		  ?><input type='text' name='titulo' value="<?php echo"$row->titulo";?>" size='50'><?php
		  echo"
		  </span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$row->id'>	  		  
		  </form>
		  
		  <form id='form1' name='form1' method='post' action='sql.php'>		
		  <input type='hidden' name='titulo' value='$row->titulo'>  
          <textarea name='contenido' style='width:650; height:150' WRAP='virtual'>$row->contenido</textarea> ";
		  ?>          
          <script language="javascript1.2">editor_generate('contenido');</script>
		  <?php
		  cuadrotexto(); echo"<br>		  
		  <input type='hidden' name='fecha_reg' value='$row->fecha_reg' disabled/>
		  <a class='sesion'>Fecha de última actualización: $row->fecha_act</a>
		  <input type='hidden' name='fecha_act' value='$row->fecha_act' disabled/><br>
          <input type='hidden' name='subtipo' value='estandar'>
		  
		  <input type='hidden' name='id' value='$row->id'>
		  <input type='hidden' name='tipo' value='modular'>	
		  <input type='hidden' name='subtipo' value='estandar'>			  	  
		  <input type='hidden' name='aux' value='$row->id'>		  
 		  <input type='hidden' name='paux' value='$pa'>
		  <br>
		  <input name='update' type='hidden'>
		  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td width='23%'><input type='Image' src='imagenes/p_act.jpg' border='0'></td>
                  <td width='38%'><a href='panel.php?pa=insertar_documentos&id=$row->id&paux=$pa'><img src='imagenes/p_adjuntar.gif' alt='Adjuntar documentos' width='231' height='20' border='0' /></a></td>
                  <td width='39%'><a href='panel.php?pa=enlaces_insertar&id=$row->id&paux=$pa'><img src='imagenes/p_enlaces.gif' alt='Insertar enlaces a otros sitios en esta sección' width='256' height='20' border='0' /></a></td>
                </tr>
              </table></form></div>";
         adm_documentos($row->id,'');
         echo"<br>";
         lista_enlaces($row->id,'');	 

}
//*****************************************************************
//FIN //  OPERACIONES CON TIPO DE PAGINAS ESTANDAR
//*****************************************************************

//*****************************************************************
//FIN // 
//*****************************************************************

function listo()
{
global $pa;
echo"<div align='center' class='p_mensaje'>      Cambios realizados con  éxito...         </div><br><br>";
}
function listo1()
{
global $pa,$id;
echo"<table width='400' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><div align='center' class='p_mensaje'>Cambios realizados con éxito en esta sección...</div></td>
    <td><a href='../index.php?p=$id&tipo=$pa' class='p_ver'>Ver Cambios</a></td>
  </tr>
</table><br><br>
";
}
function cuadrotexto()
{
echo"<span class='p_subtit4'>Este cuadro de texto tiene formato de letra, acepta saltos de línea y html . <br>";
}
//************************************************************************************
// INICIO // ACTUALIZAR CONTENIDO SI ES QUE EXISTE EL REGISTRO EN LA BD
//************************************************************************************
function actualizar_contenido_comum()
{
global $pa,$listo,$id;
		 $consulta=mysql_query("SELECT * FROM contenido where tipo='$pa'");		
		 $row=mysql_fetch_object($consulta);
		  echo"<span class='p_subtit'>Secci&oacute;n Est&aacute;ndar</span><br>
              <span class='p_tit'>Actualizar:</span>  <span class='p_nombre'> $pa";
          if($listo==1) listo(); 		   
		  echo "</span> <br> <form id='form1' name='form1' method='post' action='sql.php'>
		  <textarea name='contenido' cols='55' rows='3'  WRAP='virtual'>$row->contenido</textarea><br>";
		  	    cuadrotexto(); 
		  echo"Fecha de última actualización: $row->fecha_act</span>
		  <input type='hidden' name='fecha_act' value='$row->fecha_act' disabled/><br><br>
		  <input type='hidden' name='id' value='$row->id'>
		  <input type='hidden' name='tipo' value='$pa'>
		  <input type='hidden' name='pa' value='$pa'>
		  <input type='hidden' name='aux' value='$pa'>	  
		  <input name='update' type='hidden'>
          <input name='buscador' type='Image' src='imagenes/p_act.jpg' border='0'> <br>
		   </form></div>";
}

//************************************************************************************
// FIN // ACTUALIZAR CONTENIDO
//************************************************************************************


//*************************************************************************************
// INICIO // INSERTAR DOCUMENTOS EN LAS SECCIONES DEL CONTENIDO 
//*************************************************************************************
function adm_documentos($id,$id3)
{
global $pa;
$consulta=mysql_query("SELECT * FROM contenido_doc WHERE id='$id' order by id2 desc");
if(mysql_num_rows($consulta)>0)
{
//cuadrito para modificar eliminar documentos de una sección 
echo"
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td height='16' colspan='5'>
				<img src='imagenes/p_doc.gif'>
				</td>
              </tr>
              
            </table>
            <table width='100%' border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
              <tr class='p_subtit6'>
                <td width='4%' height='14' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='75%'  bgcolor='#333333'><div align='center'>T&iacute;tulo del documento y otros datos </div></td>
                <td width='5%'  bgcolor='#333333'><div align='center'>ver</div></td>
                <td width='6%'  bgcolor='#333333'><div align='center'>tipo</div></td>
                <td width='4%'  bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='6%'  bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";
			  
			  $i=1;
while($row=mysql_fetch_object($consulta))
     { echo"<tr>";
	   echo"<td class='p_linea' align='center'><a class='p_link4'> <b>$i</b> </a></td>";
       echo"<td class='p_linea'>
	        <a class='p_link4' href='../archivos/$row->archivo' title='$row->descripcion ** Fecha de registro: $row->fecha_reg ** Fecha de actualización: $row->fecha_act' target='_blank'><b>$row->tituloarchivo</b></a>
	        </td>";
  	   echo"<td class='p_linea' align='center'><a href='../archivos/$row->archivo' class='p_link4'> Ver </a></td>";
	   echo"<td class='p_linea' align='center' bgcolor='#FFFFFF'><a href='../archivos/$row->archivo' target='_blank' class='p_link4' title='$row->archivo'>$row->tipoarchivo</a></td>";			
       echo"<td class='p_linea'><a href='?pa=actualizar_documentos&id2=$row->id2&id=$row->id&aux=$id3&paux=$pa'><img src='imagenes/actualizar.gif' border='0' title='Actualizar Registro'></a></td>"; 
	   if ($id3=='') $id4=$row->id; else $id4=$id3;
	   echo"<td class='p_linea'><a href='#' onclick=confirmar('sql.php?delete_doc=$row->id2&paux=$pa&aux=$id4','$row->id2')><img src='imagenes/eliminar.gif' border='0' title='Eliminar Registro'></a></td>";     
       echo"</tr>"; 
	   $i++;
     }			  
 echo"</table>";		
}
}
//************
function insertar_documentos()
{
global $pa,$listo,$id,$paux,$aux;

if($listo==1) echo"<div align='center' class='mensaje'><br>Se cargo el archivo con éxito !!!<br><br></div>";

echo" <a class='p_tit'>Adjuntar Documento en:</a> <a class='p_formtit'>$sec ".seccion($id)."</a><br><br>"; 
echo"<table width='100%' border='0' align='center' cellpadding='0' cellspacing='1'>
<form action='sql.php' method='post' enctype='multipart/form-data'>";
echo"
    <tr>
    <td ><div class='p_formtit' align='right'>Título del documento&nbsp;</div></td>
    <td  colspan='3'><div align='left'><input name='tituloarchivo' type='text' size='50'>
    </div>
    </td>
    </tr> 
	<tr>
    <td height='40'><div class='p_formtit' align='right'>Examinar documento&nbsp;</div></td>
    <td colspan='3'><input name='archivo' type='file'><div align='left'>  
    </div></td>
    </tr>
	
  <tr>
    <td valign='top''><div class='p_formtit' align='right'>Descripción del documento&nbsp;</div></div></td>
    <td colspan='3'><div align='left'>
      <textarea name='descripcion' cols='40' rows='3' WRAP='virtual'></textarea>
   </td>
  <tr> 
  <td colspan='4' align='center'>";cuadrotexto();echo"<br>
  
     <input name='id' value='$id' type='hidden'>";     
	      
	 if($aux!='')  echo"<input name='aux' value='$aux' type='hidden'>"; //para la redireccion
     else echo"<input name='aux' value='$id' type='hidden'>";
	 
     echo"<input name='paux' value='$paux' type='hidden'>	 
     <input name='insert_doc' type='submit' class='boton' value='      Cargar archivo     '></form>
   </td> </tr>
   </table>"; 
}
//*************************************************************************************
// FIN // INSERTAR DOCUEMENTOS 
//*************************************************************************************
//**  INICIO ** ACTUALIZAR DOCUMENTOS
//*************************************************************************************
function actualizar_documentos()
{
global $pa,$aux,$id2,$id,$paux;
if($listo==1) listo();

$consulta=mysql_query("SELECT * FROM contenido_doc where id2='$id2'");
$row=mysql_fetch_object($consulta);

if($aux=='boletin')echo"<a class='p_subtit'>Sección Modular</a><br>";
          else     echo"<a class='p_subtit'>Sección Personalizada</a><br>";
echo" <a class='p_tit'>Adjuntar Documento en:</a> <a class='p_formtit'>$sec ".seccion($id).">>></a> <a class='p_subtit3'>$row->tituloarchivo</a><br><br>"; 

echo"
<table width='100%' border='0' align='center' cellpadding='3' cellspacing='0'>
  <tr>
    <td width='50%' valign='top'>
	  <table width='100%' border='0' align='center' cellpadding='4' cellspacing='1' bgcolor='#333333'>
      <form action='sql.php' method='post' enctype='multipart/form-data'>
        <tr>
          <td colspan='2'><div align='center' class='p_subtit2'>ACTUALIZAR DATOS DEL DOCUMENTO </div></td>
        </tr>
        <tr>
          <td valign='middle'><div class='p_formtit'  align='right'>T&iacute;tulo </div></td>
          <td ><input name='tituloarchivo' type='text' value='$row->tituloarchivo' size='30' /></td>
        </tr>
        <tr>
          <td><div class='p_formtit'  align='right'>Descripci&oacute;n</div></td>
          <td ><textarea name='descripcion' cols='25' rows='3'  WRAP='virtual'>$row->descripcion</textarea></td>
        </tr>
        <tr>
          <td>
 		      <input name='tipoarchivo' value='$row->tipoarchivo' type='hidden'/>
		      <input name='id2' value='$row->id2' type='hidden'/>
              <input name='pa' value='$pa' type='hidden'/>";
		      if($aux!='')echo"<input name='aux' value='$aux' type='hidden'/>";		 
		       else echo"<input name='aux' value='$id' type='hidden'/>";		 			  
		      echo"<input name='paux' value='$paux' type='hidden'/>				   
			  </td>
          <td ><input name='update_doc' type='submit' class='boton' value='Actualizar datos'/></td>
        </tr>
      </form>
    </table>
	</td>
    <td width='50%' align='right' valign='top'>
	<table width='100%' border='0' align='center' cellpadding='0' cellspacing='4' bgcolor='#333333'>
    <form action='sql.php' method='post' enctype='multipart/form-data'>
    <tr>
      <td bgcolor='#D1D7DB'>
	  <div align='center' class='p_subtit2'>REEMPLAZAR DOCUMENTO POR OTRO </div></td>
    </tr>
    <tr>
      <td><a class='p_formtit' align='right'>Achivo actual :</a>
	   <a class='p_subtit3' href='../archivos/$row->archivo' target='_blank'> $row->archivo[ Ver ]</a>
	  </td>
    </tr>
    <tr>
      <td>
	  <a class='p_formtit'>Examinar nuevo documento</a><br>
	  <input name='archivo' type='file' class='enlace' value='$row->archivo' size='15'/><br>
	  <a class='p_link2'>Max. 2 MB</a>
	  </td>
    </tr>
    <tr>
      <td height='55'>
          <input name='id' value='$row->id' type='hidden'/>
	      <input name='id2' value='$row->id2' type='hidden'/>
          <input name='pa' value='$pa' type='hidden'/>";
   if($aux!='')echo"<input name='aux' value='$aux' type='hidden'/>";		 
   else echo"<input name='aux' value='$id' type='hidden'/>";		 			  
echo"<input name='paux' value='$paux' type='hidden'/>		 		  
     <input name='insert_doc' type='submit' class='boton' value='Reemplazar doc'/>
	 </td>
    </tr>
  </form>
</table>
	</td>
  </tr>
</table>
";
}
//*************************************************************************************
//FIN // ACTAUALIZAR DOCUMENTOS
//*************************************************************************************

//*************************************************************************************
// INICIO // formulario cambiar datos del USUARIO
//*************************************************************************************
function usuario_actualizar()
 {
global $m;
if($m==1)  listo();
         $res=mysql_query("SELECT * FROM usuarios WHERE id='$_SESSION[ID]'");
         $row=mysql_fetch_object($res);
		 
		 echo"	<span class='p_subtit'>Secci&oacute;n Est&aacute;ndar </span><BR>
                <span class='p_tit'>Actualizar mis datos</span></span></p>
	        	 
		 <table border='0' width='95%' align='center'><form action='sql.php' method='post'>
		 <tr>
		   <td width='22%'  class='p_formtit'>Apellido Paterno </td>
		 <td width='78%' class='p_subtit3'><input name='paterno' type='text' value='$row->paterno' size='25' class=''></td></tr>
		 <tr>
		   <td  class='p_formtit'>Apellido Materno </td>
		 <td class='p_subtit3'><input name='materno' type='text' value='$row->materno' size='25' class=''></td></tr>
 		 <tr>
 		   <td  class='p_formtit'>Nombres </td>
 		 <td class='p_subtit3'><input name='nombres' type='text' value='$row->nombres' size='25' class=''></td></tr>
		 <tr>
		   <td height='24'  class='p_formtit'>Email del sistema</td>
		   <td class='p_subtit3'><input name='correo' type='text' value='$row->correo' size='25' class=''>         
		   <tr>
		 <td height='49'>&nbsp;</td>
		 <td valign='top'>
		 <a class='p_link2'><strong>Nota.-</strong> A este correo electrónico se enviarán automáticamente las consultas online de su página Web, nombre de usuario y 
		 contraseñas en caso de olvido y otro tipo de información jurídica.</a>
		 <tr>
		   <td class='p_subtit3'>Nombre de Usuario</td><td><input name='login' type='text' value='$row->login' size='25' class=''> <span class='p_link2'>*</span></td></tr>
		 <tr>
		   <td class='p_subtit3'>Contraseña</td><td><input name='password' type='text' value='$row->password' size='25' class=''> <span class='p_link2'>*</span></td></tr>
		 <tr>
		   <td></td>
		   <td>
		    <input type='hidden' name='usuario_update'/>
  	        <input type='Image' src='imagenes/p_act_datos.gif' border='0'>
		  </td>
		   </tr>
         <tr><td height='26' colspan='2' class='link3'><span class='p_link2'>* Estos datos deben ser de de conocimiento exclusivo del usuario, en caso de olvido su nombre de usuario y contraseña
		 serán enviados automáticamente a su correo electrónico registrado en esta p&aacute;gina.</span> </td>
         </tr></form>
		 </table>";
   }
//*****************************************************************************
// LOGO // ACTUALIZAR LOGOTIPO
//*****************************************************************************
function logo_actualizar()
{
global $pa,$listo;
	  
if($listo==1) listo();
if($listo==2) echo"<div align='center' class='mensaje'>Debe examinar un archivo !!!</div>";
if($listo==3) echo"<div align='center' class='mensaje'>ERROR... No es un archivo de imagen <br>
                   o el tama&ntilde;o del archivo no es correcto.			       </div>";   			   
echo"<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' >
  <form action='sql.php' method='post' enctype='multipart/form-data'>
    <tr>
      <td width='20%' height='46' valign='middle' bgcolor='#FFFFFF' colspan='2'>";	  
      logo();		
      echo"</td>
    </tr>
    <tr>
      <td height='48' valign='top' bgcolor='#FFFF99'>
	  <div align='right'><a class='p_link4'><strong>Examinar logo &nbsp;</strong></a></div>	  </td>
      <td align='center' valign='top' bgcolor='#FFFF99'>
	    <div align='left'>
	       <input name='archivo' type='file' class='p_link4'>
	      <span class='p_link4'>M&aacute;x. 1 MB. Solo archivos.gif , .jpg  o .swf (flash)</span><br>
	      <input type='hidden' name='update_logo'/>
 	      <input type='Image' src='imagenes/p_cargar_logo.gif' border='0'>
	      <input type='hidden' name='tipo' value='$tipo'/>
		  <input name='id' value='$id' type='hidden'>
          <input name='pa' value='$pa' type='hidden'>
     </div></td>
    </tr>
  </form>
</table>

";   
}
//*****************************************************************************   
// INICIO // NUEVAS SECCIONES
//*****************************************************************************   
function nuevaseccion()
{
 global $listo; 
     echo" <span class='p_subtit'>Secci&oacute;n Personalizada</span><br>
              <span class='p_tit'>Función:</span>  <span class='p_nombre'>Crear Nueva Sección Personalizada</span>";		  
		  if($listo==1)listo();
		  if($listo==2)echo"<div align='center' class='p_mensaje'> Debe especificar un titulo</a></div>";
		  echo"<br>
		  <form id='form1' name='form1' method='post' action='sql.php'>
		  <a class='p_formtit'>Titulo de la nueva sección</a> <br>
		  <input type='text' name='titulo' size='64'><br>
          <br>
		  <input type='hidden' name='pa' value='$pa'>
		  <input type='hidden' name='crearsec'/>
 	      <input type='Image' src='imagenes/p_crear_sec.gif' border='0'>
		  </form>";
}
//*****************************************************************************   
// INICIO // NUEVO MODULO
//*****************************************************************************   
function nuevomodulo()
{
 global $listo; 
     echo"<br>
          ";		  
		  if($listo==1) listo();
		  if($listo==2) echo "<div align='center' class='p_mensaje'> Debe especificar el titulo</a></div><br><br>";
		  echo"<span class='p_tit'>Crear nueva opción en el menu</a><br><br>
		  <form id='form1' name='form1' method='post' action='sql.php'>		  
		  <a class='p_subtit3'>Paso 1</a><a class='p_nombre'>&nbsp;&nbsp; Seleccione el tipo de página Web que desea</a>

		  <br>
		  <a class='p_link2'>
		  <input name='subtipo' type='radio' value='estandar' checked><a class='p_subtit'>Tipo A.</a> <a class='p_link2'>Página única estandar. (Ej. Presentación, Hoja de vida, etc.)</a><br>
          <input name='subtipo' type='radio' value='boletin'><a class='p_subtit'>Tipo B.</a> <a class='p_link2'>Ideal para boletines y/o tablones de anuncios.</a><br>	  
		  <input name='subtipo' type='radio' value='servicios'><a class='p_subtit'>Tipo C.</a> <a class='p_link2'>Ideal para una sección de áreas de trabajo y/o servicios.</a><br>
		  <input name='subtipo' type='radio' value='integrantes'><a class='p_subtit'>Tipo D.</a> <a class='p_link2'>Ideal para una sección de Miembros, Integrantes y/o Equipo de Trabajo.</a><br>
		  <input name='subtipo' type='radio' value='galeria'><a class='p_subtit'>Tipo E.</a> <a class='p_link2'>Sección especial para colocar una galería de fotos.</a><br>
		  <input name='subtipo' type='radio' value='enlaces'><a class='p_subtit'>Tipo F.</a> <a class='p_link2'>Sección especial para sistematizar enlaces a otros sitios.</a><br>
		  </a>	<br>	 
		   <a class='p_subtit3'>Paso 2</a><a class='p_nombre'>&nbsp;&nbsp;Titulo de la página</a> <br>
		  <input type='text' name='titulo' size='64'><br> 
		  <br>      
		  <input type='hidden' name='pa' value='$pa'>
		  <input type='hidden' name='crearmod'/>
 	      <input type='submit' value='Crear nuevo modulo' border='0'>
		  </form>
		  <a class='p_mensaje'>NOTA.- Recuerde que una vez creada su tipo de página Web, usted podrá cambiar el título, agragarle enlaces e inclusive documentos (fotos, word, pdf, etc), pero no podrá intercambiarla automáticamente por otro tipo de página Web.</a>";
}
//*****************************************************************************   
// INICIO // CALCULA EL TAMAÑO DE LA CARPETA archivos
//*****************************************************************************   
function directorio($dir){ 
    global $total; 
    $x = opendir($dir); 
    while ($file = readdir ($x))
	  { 
        if (eregi("^\.{1,2}$",$file)) 
            continue; 
        if(is_dir($dir)){ 
			$f=$dir.'/'.$file;
            $size=filesize($f); 
            $total=$total+$size; 
		   }       
    } 
    closedir($x); 
    //echo "<br>$total bytes";
	$total2=$total/1024;
    //echo "<br>$total2 KB";	
	$total3=$total2/1024;
	$total4=($total3+10);
	echo " <span class='p_subtit4'>".round($total4,1)." MB usados de 300 MB</span>"; 
	  
} 
//*****************************************************************************
// INICIO //  SERVICIOS
//*****************************************************************************
function adm_servicios()
{
global $pa,$id,$listo;
if($listo=='1')listo();
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
 echo"<br>
                <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>
		 ";
		  ?><input type='text' name='titulo' value="<?php echo"$r->titulo";?>" size='50'><?php
		  echo"
		  </span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$r->id'>	  		  
		  </form>			  
      <a href='?pa=servicios_insertar&id=$id&paux=$pa'><img src='imagenes/p_insertservicio.gif' border='0'></a><br><br>"; //para que el boton insertar
$consulta=mysql_query("SELECT * FROM contenido where ide='$id' order by id desc");
if(mysql_num_rows($consulta)>0)
{
echo"    <table width='100%' border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
              <tr class='p_subtit6'>
                <td width='4%' height='14' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='76%' bgcolor='#333333'><div align='center'>T&iacute;tulo del $r->titulo </div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>ver</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>doc.</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>link</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='6%' bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";			  
			  $i=1;
while($row=mysql_fetch_object($consulta))
     {
	 echo"
     <tr><td class='p_linea' align='center' bgcolor='#FFFFFF'><a class='p_link4'><b>$i</b></a></td>
	     <td class='p_linea'>
         <a class='p_link3' href='../index.php?p=mostrar_servicios&id=$row->id' title='Fecha de registro: $row->fecha_reg - Fecha de actualización: $row->fecha_act'>$row->titulo</a>
		 <br><br>";
 	     adm_documentos($row->id,$id); //documentos relacionados
		 echo"<br>";
		 lista_enlaces($row->id,$id);  // enlaces relacionados
		            
     echo"</td>
     <td class='p_linea' align='center'><a href='../index.php?p=mostrar_servicios&id=$row->id' class='p_link3'>Ver</a></td>
	 <td class='p_linea'><div align='center'><a href='?pa=insertar_documentos&id=$row->id&paux=$pa&aux=$id'>	  
	 <img src='imagenes/upload.gif' border='0' title='Adjuntar nuevo documento para : $row->titulo'></a></div></td>
     <td class='p_linea'><div align='center'><a href='?pa=enlaces_insertar&id=$row->id&paux=$pa&aux=$id'>	  
	 <img src='imagenes/enlace.jpg' border='0' title='Adjuntar nuevo enlace para : $row->titulo'></a></div></td>

     <td class='p_linea'><div align='center'>
	 <a href='?pa=servicios_actualizar&id=$row->id&ide=$row->ide&paux=$pa&aux=$id'><img src='imagenes/actualizar.gif' border='0' title='Actualizar: $row->titulo'></a></div></td>
     <td class='p_linea'>
	 <div align='center'><a href='#' onclick=confirmar('sql.php?delete=$row->id&paux=$pa&aux=$id','$row->id')> <img src='imagenes/eliminar.gif' border='0' title='Eliminar: $row->titulo'></a></div></td>
     ";
     $i++;
      }
    echo"</table>";
	}
}
function insertar_servicios()
{ 
   global $id,$pa,$paux;
   $con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
   $r=mysql_fetch_object($con);//para el titulo
    echo"<form id='form1' name='form1' method='post' action='sql.php'>
    <a class='p_subtit'>Secci&oacute;n Modular</a><br>
    <a class='p_tit'>Insertar:</a> <a class='p_formtit'>$r->titulo</a><br><br>			
	<table width='100%' border='0' cellpadding='0' cellspacing='1'>
    <tr>
    <td><div class='p_formtit' align='right'>Título </div></td>
    <td colspan='3'><div align='left'>
	<input name='titulo' type='text' size='60'>
    </div></td></tr>
    <tr>
    <td height='28'><div class='p_formtit' align='right'>Contenido</div></td>
    <td colspan='3'>
	<div align='left'>
	<textarea name='contenido' style='width:565; height:150'  WRAP='virtual'></textarea>";
	?>
	<script language="javascript1.2">editor_generate('contenido');</script>
	<?php
    echo"</div></td>
    </tr>
	<tr><td colspan='3' align='center'>
	 <br>
     <input name='id' value='$id' type='hidden'>
     <input name='aux' value='$id' type='hidden'>
	 <input name='paux' value='$paux' type='hidden'>	 	 				  	 
	 <input name='pa' value='$pa' type='hidden'>	
	 <input name='tipo' value='servicios' type='hidden'>
	 <input type='hidden' name='insert'/>
 	 <input type='Image' src='imagenes/p_insertservicio.gif' border='0'>
	 </td></tr>
	 </table> 
	 </form>
     ";
}
function actualizar_servicios()
{
global $pa,$id,$ide,$paux,$aux;
$con=mysql_query("SELECT * FROM contenido WHERE id='$ide'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo

$consulta=mysql_query("SELECT * FROM contenido where id='$id'");
		     $row=mysql_fetch_object($consulta);
 	         echo"
             <form id='form1' name='form1' method='post' action='sql.php'> 
             <a class='p_subtit'>Secci&oacute;n Modular</a><br>
             <a class='p_tit'>Actualizar:</a> <a class='p_formtit'>$r->titulo</a><br><br>				 
			 <table><tr><td>
			 <input name='subtipo' type='hidden' value='$row->subtipo'>
		     <a class='p_formtit'>Título &nbsp;</a></td><td>
			 <input name='titulo' type='text' size='70' value='$row->titulo'><br>
			 </td>
			 </tr><td>
			 <a class='p_formtit'>Contenido &nbsp;</a></td><td>
	        <textarea name='contenido' style='width:565; height:150'  WRAP='virtual'>$row->contenido</textarea>";
	        ?>
	        <script language="javascript1.2">editor_generate('contenido');</script>
	        <?php
			echo"</td>
			 </tr><td colspan='4' align='center'>
             <a class='p_subtit4'>Fecha de Registro: $row->fecha_reg' - Fecha de última actualización: $row->fecha_act'</a>  <br>
		     <input type='hidden' name='id' value='$row->id'/>
             <input name='aux' value='$ide' type='hidden'>	 				  			 
		     <input type='hidden' name='tipo' value='$row->tipo'>
		     <input type='hidden' name='pa' value='$pa'/><br>
		     <input type='hidden' name='paux' value='$paux'/><br>
		     <input type='hidden' name='update'/>
 	         <input type='Image' src='imagenes/p_actservicio.gif' border='0'>
		     </td></tr></table>
			 </form>
			 "; 		 

}
//**********************************************************************************
// FIN // SERVICO 
//**********************************************************************************

//*****************************************************************************
// INICIO //  integrantes
//*****************************************************************************
function adm_integrantes()
{
global $pa,$id,$listo;
if($listo==1) listo();
$con=mysql_query("SELECT * FROM contenido WHERE id='$id'");//para el titulo			
$r=mysql_fetch_object($con);//para el titulo
 echo"<br>
          <form action='sql.php' method='post'>
          <a class='p_tit'>Administrar: </a>
		  ";
		  ?><input type='text' name='titulo' value="<?php echo"$r->titulo";?>" size='50'><?php
		  echo"
		  </span> <input type='Image' src='imagenes/p_acttit.jpg' border='0'>
		  <input type='hidden' name='actualizartitulo' value='$r->id'>
		  <input type='hidden' name='id' value='$r->id'>	  		  
		  </form>			  
      <a href='?pa=integrantes_insertar&id=$id&paux=$pa'><img src='imagenes/p_insertintegrante.gif' border='0'></a><br><br>"; //para que el boton insertar
$consulta=mysql_query("SELECT * FROM contenido where ide='$id' order by id desc");
if(mysql_num_rows($consulta)>0)
{
echo"    <table width='100%' border='0' cellpadding='0' cellspacing='1' class='p_cuadro3'>
              <tr class='p_subtit6'>
                <td width='4%' height='14' bgcolor='#333333'><div align='center'>N&ordm;</div></td>
                <td width='50%' bgcolor='#333333'><div align='center'>T&iacute;tulo del Integrantes </div></td>	
				<td width='30%' bgcolor='#333333'><div align='center'>Cargar/Actualizar foto</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>ver</div></td>
                <td width='7%' bgcolor='#333333'><div align='center'>act.</div></td>
                <td width='6%' bgcolor='#333333'><div align='center'>elim.</div></td>
              </tr>";			  
			  $i=1;
while($row=mysql_fetch_object($consulta))
     {
	 echo"
     <tr><td class='p_linea' align='center' bgcolor='#FFFFFF'><a class='p_link4'><b>$i</b></a></td>
	     <td class='p_linea'>
         <a class='p_link3' href='../index.php?p=mostrar_integrantes&id=$row->id' title='Fecha de registro: $row->fecha_reg - Fecha de actualización: $row->fecha_act'>$row->titulo</a>
		 <td class='p_linea'>";
         $resss=mysql_query("SELECT * FROM contenido_doc WHERE id='$row->id'");
  	     if(mysql_num_rows($resss)>0)
		     {$r=mysql_fetch_object($resss);
			  echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='../archivos/$r->archivo' width='50' height='50'>
			  <a href='panel.php?pa=foto_integrantes&id=$row->id&id2=$r->id2&paux=$pa&aux=$id'><img src='imagenes/actualizar.gif' border='0' title='Actualizar foto'></a>
			  <a href='#' onclick=confirmar('sql.php?delete_doc=$r->id2&pa=$pa&paux=$pa&aux=$id','$r->id2')><img src='imagenes/eliminar.gif' border='0' title='Eliminar foto'></a>
			  ";
			  $id2=$r->id2; 
			  }	 
 		 else  
         echo"&nbsp;&nbsp;&nbsp;   <a class='p_link3' href='panel.php?pa=foto_integrantes&id=$row->id&id2=$id2&paux=$pa&aux=$id' ><img src='imagenes/integrante.jpg' border='0' title='Actualizar foto'> Cargar foto</a>";
		   
     echo"</td>          
     <td class='p_linea' align='center'><a href='../index.php?p=mostrar_integrantes&id=$row->id' class='p_link3'>Ver</a></td>
     <td class='p_linea'><div align='center'>
	 <a href='?pa=integrantes_actualizar&id=$row->id&paux=$pa&aux=$id'><img src='imagenes/actualizar.gif' border='0' title='Actualizar: $row->titulo'></a></div></td>
     <td class='p_linea'>
	 <div align='center'><a href='#' onclick=confirmar('sql.php?delete=$row->id&paux=$pa&aux=$id','$row->id')> <img src='imagenes/eliminar.gif' border='0' title='Eliminar: $row->titulo'></a></div></td>
     ";
     $i++;
      }
    echo"</table>";
	}
}
function insertar_integrantes()
{ 
global $id,$pa,$paux;
 $tipo="integrantes";
    echo"<form id='form1' name='form1' method='post' action='sql.php'>
    <br>
    <a class='p_tit'>Insertar:</a> <a class='p_formtit'>Integrantes</a><br><br>	
		
	<table width='100%' border='0' cellpadding='0' cellspacing='1'>
    <tr>
    <td><div class='p_formtit' align='right'>Nombre Completo </div> </td>
    <td colspan='3'><div align='left'>
	<input name='titulo' type='text' size='60'>
    </div></td></tr>
    <tr>
    <td><div class='p_formtit' align='right'>Correo Electrónico </div> </td>
    <td colspan='3'><div align='left'>
	<input name='subtipo' type='text' size='30' value='@'>
	  <a class='p_formtit'>TIPO DE ÍCONO &nbsp;</a>
  <select name='fecha'>
  <option value='particular.gif'>PARTICULAR</option>
  <option selected value='hotmail.gif'>Hotmail.com</option>
  <option value='yahoo.gif'>Yahoo.com</option>
  <option value='yahoo.gif'>Yahoo.es</option>
  <option value='aol.gif'>Aol.com</option>
  <option value='latinmail.gif'>Latinmail.com</option>
  <option value='gmail.gif'>Gmail.com</option>
  <option value='skype.gif'>Nick Skype</option>
  <option value='net2phone.gif'>Nick Net2Phone</option>
</select>

    </div></td></tr>
    <tr>
    <td height='28'><div class='p_formtit' align='right'>Resumen de su Curriculum</div></td>
    <td colspan='3'>
	<div align='left'>
	<textarea name='contenido' style='width:500; height:150'  WRAP='virtual'>  
[estudios]<br>
[idiomas]<br>
[especialidad en el ejercicio del Derecho]<br>
[practica jurídica]<br>
[otros] <br>
 	</textarea>";
	?>
	<script language="javascript1.2">editor_generate('contenido');</script>
	<?php
    echo"</div></td>
    </tr>
	<tr><td colspan='3' align='center'>
	 <br>
     <input name='aux' value='$tipo' type='hidden'>
     <input name='id' value='$id' type='hidden'>	 
     <input name='aux' value='$id' type='hidden'>
	 <input name='paux' value='$paux' type='hidden'>	
	 <input name='tipo' value='integrantes' type='hidden'>
	 <input type='hidden' name='insert'/>
 	 <input type='Image' src='imagenes/p_insertintegrante.gif' border='0'>
	 </td></tr>
	 </table> 
	 </form>
     ";
}
function actualizar_integrantes()
{
global $pa,$id,$listo,$paux,$aux;
if($listo==1) listo();
$con=mysql_query("SELECT * FROM contenido where id='$id'");
		     $row=mysql_fetch_object($con);
 	         echo"
             <form id='form1' name='form1' method='post' action='sql.php'> 
             <br>
             <a class='p_tit'>Actualizar:</a> <a class='p_formtit'>Integrantes</a><br><br>				 
			 <table><tr><td>
			 
		     <a class='p_formtit'>Nombre Completo &nbsp;</a></td><td>
			 <input name='titulo' type='text' size='70' value='$row->titulo'><br>
			 </td>
			 </tr>
			 <tr>
			 <td>			 
		     <a class='p_formtit'>Correo electrónico &nbsp;</a></td>
			 <td><input name='subtipo' type='text' value='$row->subtipo' size='30'>
  <a class='p_formtit'>TIPO DE ÍCONO &nbsp;</a>
  <select name='fecha'>
  <option value='$row->fecha'>$row->fecha</option>
  <option>----------------</option>
  <option value='particular.gif'>PARTICULAR</option>
  <option value='hotmail.gif'>Hotmail.com</option>
  <option value='yahoo.gif'>Yahoo.com</option>
  <option value='yahoo.gif'>Yahoo.es</option>
  <option value='aol.gif'>Aol.com</option>
  <option value='latinmail.gif'>Latinmail.com</option>
  <option value='gmail.gif'>Gmail.com</option>
  <option value='skype.gif'>Nick Skype</option>
  <option value='net2phone.gif'>Nick Net2Phone</option>
</select>
			 
			 </td>
			 </tr>
			 <tr>			 
			 
			 <td>
			 <a class='p_formtit'>Contenido &nbsp;</a></td><td>
	         <textarea name='contenido' style='width:565; height:150'  WRAP='virtual'>$row->contenido</textarea>";
	         ?>
	         <script language="javascript1.2">editor_generate('contenido');</script>
	         <?php
			 echo"</td>
			 </tr><td colspan='4' align='center'>
             <a class='p_subtit4'>Fecha de Registro: $row->fecha_reg' - Fecha de última actualización: $row->fecha_act'</a>  <br>
		     <input type='hidden' name='id' value='$row->id'/>
		     <input type='hidden' name='tipo' value='$row->tipo'>
		     <input type='hidden' name='pa' value='$pa'/><br>
             <input name='aux' value='$aux' type='hidden'>	
		 	 <input name='paux' value='$paux' type='hidden'>	
			 <input type='hidden' name='update'/>
 	         <input type='Image' src='imagenes/p_actintegrante.gif' border='0'>
		     </td></tr></table>
			 </form>
			 "; 		 
}

function foto_integrantes()
{
global $pa,$listo,$id,$aux,$id2,$paux;
echo"<a class='p_subtit'>Sección Modular</a><br>
<a class='p_tit'>Cargar Foto </a> <a class='p_formtit'> Integrantes </a><br><br> 
<form action='sql.php' method='post' enctype='multipart/form-data'>
 <center>
    <a class='p_formtit'>Examinar Foto </a>
    <input name='archivo' type='file'><div align='left'>  
    </div><br><br>	 
     <input name='id2' value='$id2' type='hidden'>
	 <input name='id' value='$id' type='hidden'>
     <input name='pa' value='$pa' type='hidden'>
	 <input name='aux' value='$aux' type='hidden'>	 
	 <input name='paux' value='$paux' type='hidden'>	 	 
     <input name='insert_doc' type='submit' class='boton' value='      Cargar foto     '>
     </center>	 
	 </form>
"; 

}
//**********************************************************************************
// FIN // integrantes
//**********************************************************************************
?>
<!--**************************************************************************************************************************-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css_panel.css">
<META NAME="Googlebot" CONTENT="nofollow"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title> Web Panel </title>
<style type="text/css">
<!--
body {
	background-color: #333333;
}
-->
</style>
</head>
<body>
<span class="menu01"></span> <span class="menu01"><a href=""></a>
<?php sesion();?>
</span>

  <table border="0" align="center" cellpadding="1" cellspacing="0" class="p_cuadro2">
    <tr>
      <td height="36" valign="top">
	      <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr><td valign='top'>
         <?php 
   if(!isset($pa)) 
      {
	   echo"	
	    <table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF'>
              <tr>
                <td height='19' colspan='3' bgcolor='#666666' class='p_sesion'>
				<div align='center'>M E N &Uacute; &nbsp;&nbsp;D E&nbsp;&nbsp; A D M I N I S T R A C I &Oacute; N </div></td>
                </tr>
    <tr>
      <td width='30%' class='p_subtit2'>A. Opciones Comunes</td>
      <td width='50%' class='p_subtit2'>B. Hosting y Soporte Técnico</td>
	  <td width='20%' class='p_subtit2'>C. Seleccionar Diseño</td>
    </tr>
	<tr>
    <td bgcolor='#DDDDFF'><a href='panel.php?pa=titulo' class='p_link5'>&middot; T&iacute;tulo del Portal (Del Browser)</A><BR>
		  <a href='panel.php?pa=etiquetas' class='p_link5'>&middot; Etiquetas Metatags</a><BR>
		  <a href='panel.php?pa=inicio' class='p_link5'>&middot; Inicio</a><br>
          <a href='panel.php?pa=pie' class='p_link5'>&middot; Pie de P&aacute;gina</a><BR>                 
          <a href='panel.php?pa=usuario' class='p_link5'>&middot; <strong>Datos del Usuario</strong></a><BR>
          <a href='panel.php?pa=logo' class='p_link5'>&middot; Cargar Logotipo</a><br></td>
      <td bgcolor='#333333' class='p_link2' align='center'>HOSTING:";
	  directorio("../archivos"); 
	  echo"<br><br>Dudas, consultas y/o sugerencias comunicarse a: <br>
	       <a class='p_subtit4' href='mailto:soporte@derechoteca.com'>soporte@derechoteca.com</a></td>
	    <td  bgcolor='#FFCC00'><div align='center'>
	    <select class='p_link6' onchange='goSelect(this)' size='4' name='m'>  ";
	     $d=dir("../temas");
          while($entry=$d->read())
		    {if($entry<>'.' and $entry<>'..')
               echo "<option value='sql.php?tema=$entry' target='top'>Diseño $entry</option>";
            }
         $d->close();		     
      echo"</select></div></td></tr>
	<tr>
    <td colspan='3' class='p_subtit2'>D. Titulos de todas las secciones del menu del Sitio Web</td>
    </tr>
	<tr>
    <td colspan='3'>
	<a href='panel.php?pa=nmodulo' class='p_crear'>Crear una nueva opcion en el menu </a>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
           $res=mysql_query("SELECT * FROM contenido WHERE tipo='modular' order by nro");
		   $nu=mysql_num_rows($res);
           while ($row=mysql_fetch_object($res))
		   {    
		         echo"<tr>";
			 //inicio//combo del numeracion				
				  echo"<td>&nbsp;
				  <select class='p_link5' onchange='goSelect(this)' size='1' name='nro'>";    
				  echo"<option value='#' selected='selected'>$row->nro</option>";				
				  echo"<option value='#'>--</option>";      		  
				    for($i=1;$i<=$nu;$i++)
					{
					 $r=mysql_fetch_object($con);
					 echo"<option value='?pa=nro&id=$row->id&nro=$i'>$i</option>";					  					  		  
					}
                  echo"</select></td>";
				  //fin//combo del numeracion	
	
				 
				 echo"<td width='75%'> <div class='p_link'> &nbsp; <a class='p_link' href='panel.php?pa=$row->subtipo&id=$row->id' title='Actualizar contenido de $row->titulo'>$row->titulo</a> </div></td>";
               
			     if($row->habilitado=='off')
				 {
                 echo"<td align='right' class='p_link5'>[$row->subtipo] </td>
				 <td>&nbsp;&nbsp;<a href='sql.php?disable=$row->id&valor=on'><img src='imagenes/p_habilitar.gif' alt='Habilita esta opción en el menú del sitio Web y todas sus opciones de administración.' border='0'>
					  </a></td>";
				 }
				   else
					  { 
					  echo"
					  <td align='right' class='p_link5'>[$row->subtipo] </td>
					  <td width='10%' align='center'><a href='../index.php?p=$row->id&tipo=$row->subtipo&id' class='p_link3' title='Ver en el sitio web'>Ver</a></td>
					  <td width='10%' align='center'>&nbsp;&nbsp;<a href='?pa=$row->subtipo&id=$row->id' class='p_link5'>Admi.</a></td>
					  <td width='8%'>
					  <a href='sql.php?disable=$row->id&valor=off'>
					  <img src='imagenes/p_deshabilitar.gif' alt='Inhabilita esta sección en el menú del sitio Web y todas sus opciones de administración. La Información contenida en la sección no es eliminada.' border='0'></a>
					  </td>
					  <td width='8%'>  &nbsp;<a href='#' onclick=confirmar('sql.php?delete_modulo=$row->id','$row->id') title='Elimina la opción con toda su información relacionada'><img src='imagenes/eliminar.gif' border='0'></a></td>
					  ";  
					  }
			//ELIMIAR  echo"<td width='8%'> <a href='#' onclick=confirmar('sql.php?delete_modulo=$row->id','$row->id')> <img src='imagenes/eliminar.gif' border='0'></a> </td>";			
		   }   
		echo"</td>
        </tr>
		 </table>";	
	  }	   
   else
      { contenido_panel(); 
	  }
   ?>
        
          </td>
          </tr>
      </table></td></tr>
	  <tr><td colspan='3'><a class="derechoteca">
  <?php 		
        if(!isset($_SESSION["SESSION"])) 
  		echo"<a class='derechoteca' href='panel.php'>Iniciar Sesi&oacute;n</a><br>"; 				
        include ("http://www.derechoteca.com/biblioteca/copyright.php");		
		?>
</a>  </td></tr>
</table>
</body>
</html>
<?php
function numeracion()
{
 global $nro,$id;
 $i=0;
 $con=mysql_query("UPDATE contenido SET nro='$nro' WHERE id='$id'") or die("Error en la consulta");
 
 
 /*
 $res=mysql_query("SELECT * FROM contenido WHERE tipo='modular'order by nro");
 
 while ($row=mysql_fetch_object($res))
     { 
	   if($nro<=$row->nro)	
	      { $nro++;
           $cons=mysql_query("UPDATE contenido SET nro='$nro' WHERE id='$row->id'") or die("Error en la consulta");
		  }
     } 
	 */
echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=panel.php'>";

}	
?>