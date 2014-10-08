<?php
/*
 *      borrarPost.php
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
if(($esadmin) and (!$eslector)){

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

		//Eliminación de Mensajes
	
		if(isset($_POST['borrar'])){
		$id=$_POST["id"];
	
	
		if (($id=="")){
			echo '<script language="javascript">alert("Debe especificar el ID del mensaje a eliminar.");</script>';
			
			}else {
//delete from mensajes where id = 5
		$sqlBorrarMsge='delete from '.$db_table["post"].' where '.$db_table_item["post"]["id"].' = '.$id;
		echo $sqlBorrarMsge; //control de consulta
		$BorrarMsge = mysql_query($sqlBorrarMsge,$dbconexion);	
		echo '<span class="sysmsge ok">El mensaje ha sido eliminado.</span>';
		mysql_close($dbconexion);
		echo '<head><meta http-equiv="refresh" content="0"></head>';
	}

	}
	
?>

		<form method="post" id="form" name="form">
			ID del mensaje a eliminar:
			<br /><input type="text" name="id" />
			<br />
				<input type="submit" name="borrar" value="Eliminar Post">
			</form>	
<?php
} else {
	echo '<span class="sysmsge error">Acceso Restringido.</span>';
}
?>
