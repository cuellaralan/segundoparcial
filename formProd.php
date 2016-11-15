<?php
//require_once("verificar_sesion.php");

require_once("clases/AccesoDatos.php");
require_once("clases/Usuario.php");

/*if (!isset($usuario)) {//alta
    $nombre = "";
    $email = "";
    $id = "";
    $botonClick = "AgregarUsuario()";
    $botonTitulo = "Guardar";
} else {
    $nombre = $usuario->nombre;
    $email = $usuario->email;
    $id = $usuario->id;
    
    if(isset($usuario->accion)){
        $botonClick = $usuario->accion == "Modificar" ? "ModificarUsuario()" : "EliminarUsuario()";    
        $botonTitulo = $usuario->accion;
    }
    else {
        $botonClick = "ModificarUsuario()";    
        $botonTitulo = "Editar Perfil";        
    }
}

$perfiles = Usuario::TraerTodosLosPerfiles();*/

?>

<div id="divFrm" class="animated bounceInLeft" onsubmit="GuardarCD();return false"  style="height:330px;overflow:auto;margin-top:0px;border-style:solid">
    <br/><br/>
    <input type="hidden" id="hdnIdUsuario" value="" />
    <input type="text" placeholder="Nombre" id="nombre" value="" />
    <input type="text" placeholder="porcentaje" id="porcentaje" value="" />
    
    <br/><br/>

    <input type="button" class="MiBotonUTN" onclick="AgregarProducto()" value="Agregar"  />
    <input type="hidden" id="hdnQueHago" value="agregar" />
</div>