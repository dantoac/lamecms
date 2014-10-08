<?php
/*
 *      modulos.php
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
#error_reporting(null);

$id = $_GET['id'];
switch ($id) {
   case "login":
	include $login;
	   break;
   case "logout":
	include $logout;
	   break;
	case "postear":
		include $postear;
		break;
	case "useradd":
		include $useradd;
		break;
	case "inicio":
		
	break;
	default:
	echo '<h1>404</h1>';
}
?>
