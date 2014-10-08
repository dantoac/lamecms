<?php
/*
 *      agregarUsuario.php
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
if(($esadmin)){

		
	if(isset($_POST['enviar'])){
		
		
		
		$nombre=$_POST['nombre'];
		$pass=md5($_POST['pass']);
		$email=$_POST['email'];
		$isadmin=$_POST['isadmin'];
		$rut=$_POST['rut'];
		$readonly=$_POST['readonly'];
		$dv = $_POST['digitoverificador'];
		
		$dv = strtoupper($dv); //pasamos el dígito verificador a mayúsculas, para la K.
		$rutok=chkrut($rut);
		
		
		if($dv != $rutok){
			echo '<script language="javascript">alert("ERROR EN EL DÍGITO VERIFICADOR DEL RUT");</script>';
			}
		else
		if (($nombre=="") || ($pass=="")){
			echo '<script language="javascript">alert("Debe llenar todos los campos especificados, nótese \"Título\" y \"Mensaje\".");</script>';
			
			} else {

		$dbsetUser="insert into $db_table[user] (usuario_rut, nombre, password, email, isadmin, readonly) values('$rut-$dv','$nombre', '$pass', '$email', $isadmin, $readonly);";

		$dataset = mysql_query($dbsetUser,$dbconexion);	
		if(!($dataset)){
			echo '<div class="sysmsge error">Ha ocurrido un ERROR: "'.mysql_error().'"</div>';
		} else {
		echo '<div class="sysmsge ok">"'.$nombre.'" ha sido agregado como nuevo de usuario.</div>';
		mysql_close($dbconexion);
		}	
		//echo '<head><meta http-equiv="refresh" content="0;url=?mod=listarUsuarios"></head>';
	}

	}
//} else {header("location:?id=inicio"); echo 'no eres administrador!';}

	
?>

	<div class="formulario">
	Momentáneamente, sólo es posible crear <abbr title="Administradores">admins.</abbr>
		<form method="post" id="form" name="form">
			<p />RUN: <input type="text" name="rut" maxlength="8" size="8" /> - <input type="text" name="digitoverificador" size="1" maxlength="1" />
			<p />Nombre:
			<br /><input type="text" name="nombre" />
			<p />Contraseña:
			<br /><input type="text" name="pass" type="password" />
			<p />E-mail:
			<br /><input type="text" name="email" />
			<p >Permisos de Administrador:
			<br /><input type="radio" name="isadmin" value="1" /> Si.
			<br /><input type="radio" name="isadmin" value="0" checked="checked" /> No.
			<p />Modo sólo lectura:
			<br /><input type="radio" name="readonly" value="1" /> Si.
			<br /><input type="radio" name="readonly" value="0" checked="checked"/> No.
				<p /><input type="submit" name="enviar" value="Crear Usuario">
		</form>	
	
	</div>

<?php
} else {
	echo '<span class="sysmsge error">Acceso Restringido.</span>';
}
?>
