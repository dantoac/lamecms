<?php
/*
 *      config.php
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

include('dbdata.php');
//inclusión de las funciones principales
include ('kernel.php');

#1. INTERFAZ GRÁFICA DE USUARIO

$templateName = 'tarreo'; //nombre del theme a utilizar

$templatePath = 'GUI/'.$templateName; //carpeta del theme
$templateCSS = $templatePath.'/'.$templateName.'.css'; //CSS principal del theme
$template = $templatePath.'/index.php'; //archivo principal del theme

//GUI del sistema
$defaultCSS = 'GUI/default.css'; //CSS predeterminado del sistema

#2. Especificación de Secciones
$sysmods = 'Core/Implantes/';
$usermods = 'Contrib/';
//$páginas = 'Core/páginas.php';
$páginas = 'Contenido/';
$jsmods = $sysmods.'js/';


#3. INFO DEL WEBSITE

$website = array(
	"name" => "tarreo",
	"copyleft" => "danthux@gxppl.net",
	"project" => "vórtex,ant,cyborg"
	);
	
$nombreWebsite = 'Tarreo 2009';
$pagina = $sysmods.'neurona.php';
$menu = 'Core/sysmenu.php';



if(isset($_SESSION['usuario'])){ //verificación raíz de si el usuario... 
	$logueado=$_SESSION['usuario']; //...está logueado...
	if($logueado){
	$esadmin = chkadmin($logueado); //...de si es administrador...
	$eslector = chkreadonly($logueado);//...o tiene permisos de sólo lectura.
}
}
?>
