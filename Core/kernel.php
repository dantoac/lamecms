<?php
/*
 *      kernel.php
 *      
 * 		Este archivo contiene variables globales del sistema, para uso
 * 		directo en la implementación de un theme, módulo o página.
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

#FUNCIONES

function tiempo(){
echo date("l d M, Y H:m ").'Hr.';
}

/* la siguiente función nos permite
 * establecer el módulo que servirá
 * como portada y página por defecto
 * a mostrar si no se pasan parámetros.
 */

function redirPortada() {
	$tipoUrl = 'mod'; //'mod' para módulo o 'pag' para página.
	$portada = 'noticias'; //nombre del módulo o página a redireccionar
	header("location:?$tipoUrl=$portada");
}

/* FUNCIÓN DE 'LEER MÁS' 
 * le pasamos como parámetro el texto y el máximo de caracteres
 * que permitiremos. 
 * Al texto afectado se le agregará '(...)' al final, o lo que
 * se le especifique, indicando que el artículo continua.
 */ 
function readmore ($texto, $largo){
	 if (strlen ($texto) < $largo) {
	  return $texto;
	 }
	 if (preg_match ("/(.{1,$largo})\s/", $texto, $match)) {
	  return $match [1] . '...';
	 } else {
	  return substr ($texto, 0, $largo) . ".."; 
	 }
}


/* FUNCION DEL DÍGITO VERIFICADOR
 * rueda obtenida desde:
 * http://www.dcc.uchile.cl/~mortega/microcodigos
 */
function chkrut($rut){
	$s=1;
	for($m=0;$rut!=0;$rut/=10)
	$s=($s+$rut%10*(9-$m++%6))%11;
	$dv = $s?$s+47:75; //75 es el ascii de 'K'
	return chr($dv);
	
}

	$dbconexion = conectar_bdd(); 

//funcion para chequear si el usuario logueado tiene permisos de administrador
function chkadmin($logueado){
	global $dbconexion, $db_table, $db_table_item;
	$sql = 	'select isadmin from '.$db_table["user"].' where '.$db_table_item["user"]["name"].' = "'.$logueado.'"';
	
	$query = mysql_query($sql,$dbconexion);
	$fila = mysql_fetch_array($query);
	return $fila["isadmin"];
	}

//funcion para chequear si el usuario logueado tiene permisos de sólo lectura
function chkreadonly($logueado){
	global $dbconexion, $db_table, $db_table_item;
	$sql = 	'select readonly from '.$db_table["user"].' where '.$db_table_item["user"]["name"].' = "'.$logueado.'"';
	
	$query = mysql_query($sql, $dbconexion);
	$fila = mysql_fetch_array($query);
	return $fila["readonly"];
	}

//función para presentar las noticias.
function noticias(){

	global $db_table, $db_table_item, $dbconexion;
	
	
/* INICIO-PAGINACIÓN.
 * 
 * El algoritmo de paginación está basado en otro
 * hecho por Mauro Rondinelli 
 * para http://www.elguruprogramador.com.ar
 * 
 * NOTA: Falla si hay sólo 1 post.
 */

$registros = 5; //cada cuantos post paginaremos los resultados.
$pagina = $_GET["pagina"];

if(!$pagina){
 //cómo llamaremos la paginación.
 $inicio = 0; 
		$pagina = 1;

} else {
$inicio = ($pagina - 1) * $registros;
		 //mostramos la primera página de resultado
	} 
	
	//guardamos el total de post existentes.
	$resultados = mysql_query("SELECT ".$db_table_item["post"]["id"]." FROM ".$db_table["post"]."");
	
$total_registros = mysql_num_rows($resultados);
	
//$resultados = mysql_query("SELECT * FROM ".$db_table["post"]." order by ".$db_table_item["post"]["id"]." desc limit ".$inicio.",".$registros.";");
$resultados = mysql_query("SELECT * FROM ".$db_table["post"]." order by ".$db_table_item["post"]["date"]." desc;");

$total_paginas = ceil($total_registros / $registros); 	

$datalist = mysql_fetch_array($resultados);

// FIN-PAGINACIÓN
if($total_registros){
//presentación de las noticias.
while ($datalist = mysql_fetch_array($resultados)){
	
		echo '
		<div class="mensaje">
			<div class="msge_head">
		<span class="msge_title">
		<a href="?mod=noticias&id='.$datalist[$db_table_item["post"]["id"]].'">'.$datalist[$db_table_item["post"]["title"]].'</a>
		</span>
		<div class="msge_info">
			<div class="msge_autor">
			'.$datalist[$db_table_item["post"]["autor"]].'@'.$datalist[$db_table_item["post"]["date"]].'
			</div>
		</div>

	</div>
	<div class="msge_body">
		'.readmore($datalist[$db_table_item["post"]["body"]],800).'
	</div>
	<div class="msge_foot">
		<span id="togxpopuli"><a href="http://foros.gxppl.net/tarreo-2009-f-49.html">Discútelo en los foros</a></span>|
		<span id="readmore"><a href="?mod=noticias&id='.$datalist[$db_table_item["post"]["id"]].'">(leer más)</a></span>
	</div>
		</div>
		';
}
} else {
		echo "<font color='darkgray'>(sin resultados)</font>";
	}
	
	mysql_free_result($resultados);		

//INICIA-NAVEGADOR_DE_PÁGINAS
echo '<div id="paginador">';
	if(($pagina - 1) > 0) {
	echo "<a href='?mod=noticias&pagina=".($pagina-1)."'><< Anterior</a>";
	} 

	for ($i=1; $i<=$total_paginas; $i++){
if ($pagina == $i) {
echo '<span class="pagina_actual">'.$pagina.'</span>';
} else {
echo "<a href='?mod=noticias&pagina=$i'>$i</a>";

} }

if(($pagina + 1)<=$total_paginas) {
echo "<a href='?mod=noticias&pagina=".($pagina+1)."'>Siguiente >></a>";

} 

 echo '</div>';

//FIN-NAVEGADOR_DE_PÁGINAS

}//fin noticias();


//esta función nos permitirá mostrar la noticia completa, singularmente.
function noticia_completa($id){

	global $db_table, $db_table_item, $dbconexion;
$query = "SELECT * FROM ".$db_table["post"]." where ".$db_table_item["post"]["id"]." = ".$id;"";
	

$resultados = mysql_query($query,$dbconexion);

while($datalist = mysql_fetch_array($resultados)){
	
//presentación de la noticias completa.

		echo '
		<div class="mensaje">
			<div class="msge_head">
		<span class="msge_title">
		'.$datalist[$db_table_item["post"]["title"]].'
		</span>
		<div class="msge_info">
			<div class="msge_autor">
			'.$datalist[$db_table_item["post"]["autor"]].'@'.$datalist[$db_table_item["post"]["date"]].'
			</div>
		</div>

	</div>
	<div class="msge_body">
		'.$datalist[$db_table_item["post"]["body"]].'
	</div>
	<div class="msge_foot">
		<br /><a onClick="history.go(-1);"><< Volver.</a>
		<br /><a href="http://foros.gxppl.net/tarreo-2009-f-49.html"> Discútelo en los foros </a>
	</div>
		</div>
		';
}//fin noticia_completa();
}
?>	

