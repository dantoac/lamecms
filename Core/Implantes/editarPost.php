<?php
/*
 *      editarPost.php
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
		$sqlListarMsges='select * from '.$db_table["post"].' order by '.$db_table_item["post"]["id"].' desc';
echo $sqlListarMsges;
		$msgedata = mysql_query($sqlListarMsges,$dbconexion);
		
		$contador = 0;		
	
		echo '<table class="systable">
					<caption>Listado de artículos:</caption>
					<tbody>
					<tr>
					<td><strong>Mensaje_ID</strong></td>
					<td><strong>Título</strong></td>
					<td><strong>Autor</strong></td>
					<td><strong>Fecha</strong></td>
					</tr>
					';

		while($msgelist = mysql_fetch_array($msgedata)){
			
			echo '
					<tr><td>'.$msgelist["mensaje_id"].'</td>
					<td>'.$msgelist["titulo"].'</td>
					<td>'.$msgelist["autor"].'</td>
					<td>'.$msgelist["fecha"].'</td>
					</tr>
					';
			$contador++;
			}
		echo '</tbody>
				</table><p />Total de Mensajes: <strong>'.$contador.'</strong>';
	
?>
