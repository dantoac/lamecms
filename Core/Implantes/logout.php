<?php
/*
 *      logout.php
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

if(isset($logueado)){

session_destroy();

echo '<span class="sysmsge ok">Sesión activa: <em>Destruida</em> >:D</span><br /><span style="display:block;text-align:right;font:2em verdana, sans-serif;font-style:italic;">Redireccionándote a la portada...</span>';
echo '<head><meta http-equiv="refresh" content="1; url=index.php"></head>'; 

} else {
	echo '<span class="sysmsge error">Acceso Restringido.</span>';
}
?>
