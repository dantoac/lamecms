<?php
/*
 *      sysmenu.php
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

<div id="sysmenu">
<ul>
<li><a href=".">portada</a></li>
<?php
	if(!isset($logueado)){ ?>
	<li> <a href="?mod=login">login</a></li>
	<?php } ?>
<?php if (isset($logueado)){?>
	<li><a href="?mod=agregarNoticia">Agregar Noticia</a></li>
	<?php if (isset($esadmin)){ //si es admin, agregamos opciones de gestión. ?>
		<li><a href="?mod=borrarPost">Eliminar Noticia</a></li>
		<li><a href="?mod=agregarUsuario">Agregar Usuario</a></li>
		<li><a href="?mod=borrarUsuario">Eliminar Usuario</a></li>
		<?php }?>
	<li><a href="?mod=listarUsuarios">Listar Usuarios</a></li>
	<li><a href="?mod=logout">Salir</a></li>
<?php } ?>
</ul>
</div>
