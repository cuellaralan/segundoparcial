<?php
	session_start();
    require_once('clases/lib/nusoap.php');

    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";

//IMPLEMENTAR...

    		// Inicializa WS
		$host = 'http://localhost/cuellar/clases/ws.php';
		$client = new nusoap_client($host . '?wsdl');
		$err = $client->getError();
		if ($err) {
			echo 'ERROR AL INVOCAR AL METODO';
		}

		// Llama a metodo WS
		$resultado = $client->call("ValidarLogin", array('correo' => $usuario->Email, 'clave' => $usuario->Password));

		// Chequea errores
		if ($client->fault) {
			echo($resultado);
		} else {
			$err = $client->getError();
			if ($err) {
				echo 'ERROR EN EL CLIENTE';
			} else {
				// Todo ok, veo que respondio el WS...

				if($resultado == "admin" || $resultado == "user" ||$resultado == "invitado")
				{
					$_SESSION['usuario']=$usuario->Nombre;
					$_SESSION['registrado']=$usuario->Email;
					//$_SESSION['tipo']=$resultado;
					echo json_encode($resultado);
					//echo json_encode($obj);
				}
				else
				{
					echo "no encontrado"+$resultado;
				}
			}
		}

?>