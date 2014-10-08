<?php
/*
 *      portada.php
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?php echo $website["name"] ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.15" />
	<link rel='stylesheet' type='text/css' href="<?php echo $defaultCSS; ?>">
	<link rel='stylesheet' type='text/css' href="<?php echo $templateCSS; ?>">
	<script type="text/javascript" src="<?php echo $jsmods.'jquery-1.2.6.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo $jsmods.'ajax.js'; ?>"></script>
	<?php if (($_GET['mod'])=='agregarNoticia'){ //al postear noticias, incluimos el wysiwyg ?> 
		<script type="text/javascript" src="<?php echo $jsmods.'tiny_mce/tiny_mce.js'; ?>"></script>	
		<script type="text/javascript" src="<?php echo $jsmods.'tinymce_init.js'; ?>"></script>	
	<?php } ?>
	<!-- <script type="text/javascript" src="<?php echo $jsmods.'jquery.corner.js'; ?>"></script> -->
	<script type="text/javascript" src="<?php echo $jsmods.'efectos.js'; ?>"></script>
</head>

<body>
<div id="sysTopPanel" class="sysPanel">
<?php 

if(isset($logueado)){
				//acá se muestra el panel de usuario
				echo 'Hola <span id="onsession_name">'.$logueado.' </span>, Tienes permisos de: ';
				
	if(($esadmin)){echo 'Admin.';}
	if(($eslector)){echo 'sólo lectura';}
	
} else {
	echo 'hola visitante';
}

?>

			<span id="botonmenu">menú</span>
</div>	
<div id="desktop">

<?php include $template; ?>
</div>
	
</body>
</html>

