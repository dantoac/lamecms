<?php
/*
 *      login.php
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
if (!isset($logueado)){

/* $logueado = $_SESSION['usuario'] y contiene el 
 * nombre del usuario en la sesión actual. 
 * Se inicializa en GUI/portada.php 
 */


?>

<?php
	if(isset($_POST["login"])) //verificamos que el botón enviar al menos haya sido presionado.
	{
		$username = $_POST['usuario'];
		$userpass = md5($_POST['password']);

//creamos la consulta a la bdd
$dbquery = 'select * from '.$db_table["user"].' where '.$db_table_item["user"]["name"].'="'.$username.'" and password="'.$userpass.'"';
$getUsuario = mysql_query($dbquery,$dbconexion);
$datalist = mysql_fetch_array($getUsuario);

		if(($username!='') AND ($userpass!='')){
/* si el usuario y contraseña ingresados desde el formulario corresponden
 * al mismo par existente en la base de datos, pasa, sino devuelve error 
 */
		if(($username == $datalist['nombre'])) 
		{		
				echo "<span class='sysmsge ok'>Has ingresado correctamente.</span>";
				$_SESSION['usuario']=$username;
				$logueado=$_SESSION['usuario'];
				
				echo '<head><meta http-equiv="refresh" content="1; url=index.php"></head>';
			} else {
			echo '<div class="sysmsge error">Par Usuario+Contraseña desconocido, verifique los datos ingresados.</div>';
			}
		} else {echo '<script language="javascript">alert("Error, los campos están vacíos.");</script>';} 
	
}

?>


<div class="formulario">
<p />Ingresa tu nombre de usuario y contraseña a continuación:
<form method="post" id="formlogin">
	<br />NOMBRE:<br /><input name="usuario" />
	<br />CONTRASEÑA:<br /><input name="password" type="password" />
	<br /><input type="submit" value="Ingresar" name="login" />
</form>
</div>
<?php } else {
	echo '<script language="javascript">alert("Ya tienes una sesión activa.");</script>';
	 echo '<head><meta http-equiv="refresh" content="1; url=index.php"></head>';}
	?>

