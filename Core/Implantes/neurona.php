<?php
/*
 *      neurona.php
 * 		La función de este fichero es de facilitar la conexión con los 
 * 		'implantes' (módulos) del sistema y de los usuarios.
 *       
 *      Copyright 2009 Daniel Aguayo Catalán <daniel.aguayo@alumnos.inacap.cl>
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

/*
 * Este archivo reemplaza el típico array con los módulos disponibles 
 * con algo que intenta cumplir el objetivo de ser mucho más flexible y 
 * dinámico a la hora de agregar módulos en forma de funciones o nuevas
 * páginas, tanto del sistema como módulos contribuidos por usuarios.
 * No obstante lo anterior, aún tengo pensado implementar otro método
 * basado en un array para los módulos del sistema, ya que éstos serían
 * más estables en el tiempo y no necesitarían una 
 * implementación 'en caliente'. 
 */

$getmodurl = 'mod'; //variable para llamar a los módulos 
$getpagurl = 'articulo'; //variable para llamar a las páginas

if($_GET[$getmodurl]){
	$mod = $_GET[$getmodurl]; //módulo o página. El archivo principal de
	$url = $mod.'.php';	   //cada módulo DEBE tener sólo una extensión: php

	/* Ahora el funcionamiento. Primero
	 * buscamos si el módulo existe entre
	 * los módulos predeterminados del Sistema:
	 */

	if (file_exists($sysmods.$url)){ //si existe entre los módulos del 
		$sysmod='true'; 			 //sistema, entonces activamos un bit
	}
	 
	if (file_exists($usermods.$url)){//si existe entre los módulos 
		$usermod='true'; // constribuidos por los usuarios, activamos un bit
		}

	/* a continuación, priorizamos las inclusión del módulo predeterminado
	 * en el sistema, en caso de que hubiese un módulo del mismo nombre
	 * entre los módulos de los usuarios
	 */

	if (isset($sysmod)){ //si existe en los módulos del sistema
		include $sysmods.$url; //incluimos el módulo del sistema
	} else 				//sólo si NO era de sistema y 
		if (isset($usermod)){ 	//existe entre los módulos de los usuarios
			include $usermods.$url; //entonces incluimos el módulo del usuario.
		} else { echo '<span class="sysmsge alerta">módulo inexistente</span>';
			
			   }
} 

/* Si se solicita una página, entonces busca la página en la 
 * carpeta /Contenido/ (configurada en conf.php como $páginas)
 * por el sólo nombre y le agrega automáticamente la extensión .php,
 * luego la incluye.
 */
if(isset($_GET[$getpagurl])){
	$mod = $_GET[$getpagurl];
	$url = $mod.'.php';	   

		if (file_exists($páginas.$url)){
			include $páginas.$url;
		} else { echo '<span class="sysmsge alerta">página inexistente</span>';
		} //si la página no existe, muestra la Portada.
}

//Si no se especifica módulo o página, muestra la Portada por defecto.

if(((isset($_GET[$getpagurl])=="")) AND (isset($_GET[$getmodurl])=='')){
redirPortada(); //función definida en kernel.php
		}

?>
