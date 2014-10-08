<?php
/*
 *      agregarNoticia.php
 *      
 *      Copyright 2008 Daniel Aguayo Catalán <daniel.aguayo@alumnos.inacap.cl>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
?>

<?php

if (($logueado!='') && (!($eslector))){
	

	if(isset($_POST["enviar"])){
		
		$msgetitle=$_POST["titulo"];
		$msgebody=$_POST["mensaje"];
		
		if (($msgetitle=="") || ($msgebody=="")){
			echo '<script language="javascript">alert("Debe llenar todos los campos especificados, nótese \"Título\" y \"Mensaje\".");</script>';
			
			}else {

		$q = mysql_query('SET NAMES UTF8',$dbconexion);
		if(!($q)){
			mysql_error();
			exit();
			
		}
		
		$setMsge="insert into ".$db_table["post"]." (titulo, cuerpo, autor, fecha) values ('".$msgetitle."','".$msgebody."','".$logueado."', NOW())";
		

		$dataset = mysql_query($setMsge,$dbconexion);	
		if(!($dataset)){
			mysql_error();
			exit();
			
		}

		echo "La ID del mensaje es: " . mysql_insert_id();
		echo '<span class="sysmsge ok">Has publicado una nueva noticia.</span>';
		mysql_close($dbconexion);
		echo '<head><meta http-equiv="refresh" content="2"></head>';
	}

	}

?>

<div class="formulario">
		<form method="post" name="form">
		<p />Título:
		
		<input type="text" name="titulo" size="60"></input><br />
		<p />Mensaje:
		<textarea name="mensaje" style="width:100%;" rows="20"></textarea>
		<br />
		<input type="hidden" name="oculto" value="1">
		<input type="submit" name="enviar" value="Enviar">
		
		</form>	
	
</div>
<?php
} else {

	echo '<span class="sysmsge error">Acceso Restringido.</span>';


}
?>

