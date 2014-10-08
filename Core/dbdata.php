<?php
/*
 *      dbdata.php
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


$db_data = array(
	'host'=>'localhost',//host del servidor de bdd
	'user'=>'root',//usuario de la base de datos
	'pass'=>'toor', //contraseña
	'database'=>'tarreo'); //nombre de la bdd a usar


/*
 * Especificamos el nombre de las tablas
 * en la base de datos con el objetivo de
 * ayudar *un poco* en la portabilidad
 * para otros proyectos o para los miles de 
 * dispersos que existimos que cambiamos
 * siempre los nombres de las tablas pensando
 * que las optimizamos semánticamente, lol.
 * Luego, lo que está a continuación es 
 * estrictamente INnecesario. lol de nuevo.
 */

$db_table = array(
	'post' => 'mensaje',
	'user' => 'usuario'
	);

/*
 * ¿Sería útil especificar el nombre de los campos también? Sí, por qué no ;P
 */


$db_table_item = array(
	'user' => array(
		'id'=>'usuario_rut',
		'name' => 'nombre',
		'password' => 'password',
		'email' => 'email'
		),
	'post' => array(
		'id' => 'mensaje_id',
		'title' => 'titulo',
		'body' => 'cuerpo',
		'autor' => 'autor',
		'date' => 'fecha'
		)
	);

//primero, verificamos que estén todos los datos de acceso al servidor.
if(($db_data["host"] AND $db_data["user"] AND $db_data["pass"] AND $db_data["database"])!=''){ 
	
	//función de crear una conexión al servidor de la base de datos
	function conectar_bdd(){
		global $db_data;
		$conectar = mysql_connect($db_data["host"], $db_data["user"], $db_data["pass"]) or 
		die('<h1>No logro <strong>conectar</strong> al servidor de la base de datos.</h1>');
		$basedatos = mysql_select_db($db_data["database"],$conectar) or 
		die('<h1>No logro <strong>conectar</strong> a la base de datos.</h1>');;
		return $conectar;
	}		
	
} else { //sino están todos los datos de acceso al servidor de la base de datos...
	die ('<div class="sysmsge error">Faltan datos de acceso a la Base de Datos.</div>');
}





?>
