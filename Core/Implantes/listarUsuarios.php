<?php
/*
 *      listarUsuarios.php
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
if(isset($logueado)) {
		$sqlListarUsuarios="select * from $db_table[user];";

		$userdata = mysql_query($sqlListarUsuarios,$dbconexion);
		
		$contador_rw = 0;	
		$contador_ro = 0;	
		$contador_admin = 0;		

		echo '<table class="systable">
					<caption>Listado de Usuarios:</caption>
					<tbody>';
		echo '	<tr>';
			if($esadmin){		
		echo '		<td><strong>Usuario_ID</strong></td>';}
		echo '		<td><strong>Nombre</strong></td>
					<td><strong>E-Mail</strong></td>
					<td><strong>Administrador</strong></td>
					<td><strong>Sólo Lectura</strong></td>
					</tr>';

		while($userlist = mysql_fetch_array($userdata)){
			
			echo '	<tr>';
			if($esadmin){		
			echo '	<td>'.$userlist["usuario_rut"].'</td>';}
			echo '	<td>'.$userlist["nombre"].'</td>
					<td>'.$userlist["email"].'</td>
					<td>'.$userlist["isadmin"].'</td>
					<td>'.$userlist["readonly"].'</td>
					</tr>';
						if(($userlist["isadmin"])==1){
				$contador_admin++;
			} else { 
				
			if(($userlist["readonly"])==1){
				$contador_ro++;
				} else {
					$contador_rw++;
				}
			}
		}
		$total_usuarios = $contador_admin+$contador_ro+$contador_rw;	
		echo '
					</tbody>
				</table>
				<p />
				<br />Usuarios con permisos de rw:<strong> '.$contador_rw.' </strong>
				<br />Usuarios con permisos de ro:<strong> '.$contador_ro.' </strong>
				<br />Usuarios con permisos de Admin.:<strong> '.$contador_admin.' </strong>
				<br />Total de usuarios registrados:<strong>'.$total_usuarios.'</strong>';		
		mysql_close($dbconexion);
}	

else {
	echo '<span class="sysmsge error">Acceso Restringido.</span>';
} ?>
