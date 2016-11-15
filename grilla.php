
<?php 
	require_once("clases/AccesoDatos.php");
	require_once("clases/Usuario.php");
	$arrayDeUsuarios=Usuario::TraerTodosLosUsuarios();
	//var_dump($arrayDeUsuarios)
	

// U.id, U.nombre, U.email, U.perfil, U.foto

?>
<table class="table" cellspacing="80px" style="width: 20%;">
	<thead> 
		<tr>
			<th>Editar</th><th>Borrar</th><th>id</th><th>nombre</th><th>Correo</th><th></th>
		</tr>
	 </thead> 
	<tbody>

	<?php
	//var_dump($arrayDeUsuarios);

foreach ($arrayDeUsuarios as $usuario)
 {
	echo "<tr>
			<td><a onclick='EditarUsuario($usuario->id)' class='MiBoton'>Editar</a></td>
			<td><a onclick='BorrarUsuario($usuario->id)' class='MiBoton'>Borrar</a></td>
			<td>$usuario->id</td>
			<td>$usuario->nombre</td>
			<td>$usuario->Email</td>
					</tr>   ";}//<td>$usuario->Perfil</td>


?>
		
	
	 </tbody>
	</table>
		



