<?php 
	require_once('./lib/nusoap.php'); 
	require_once('AccesoDatos.php');
	require_once('Usuario.php');

	$server = new nusoap_server(); 

	$server->configureWSDL('WSLogin', 'wsLogin'); 

	$server->register('ValidarLogin',                	
						array('correo' => 'xsd:string', 'clave' => 'xsd:string'),  
						array('return' => 'xsd:string'),   
						'wsLogin',                		
						'',             
						'',                        		
						'',                    		
						'Valida login de usuario'    			
					); 

	function ValidarLogin($correo, $clave) {
		
		$usuario=Usuario::TraerUnUsuarioUserYCorreo($correo, $clave);

		return $usuario->nombre;

		/*if($usuario=="admin" && $clave=="admin")
		{
			return true;

		} else {	
			if(usuario::TraerUnUsuarioUserYClave($usuario, $clave))
			{
				return true;
			}
			else
			{
				return false;
			}
		}*/
	}

	$server->register('ValidarSingUp',                	
						array('usuario' => 'xsd:string', 'clave' => 'xsd:string', 'correo' => 'xsd:string'),  
						array('return' => 'xsd:boolean'),   
						'wsLogin',                		
						'',             
						'',                        		
						'',                    		
						'Valida SingUp de usuario'    			
					);

	function ValidarSingUp($usuario, $clave, $correo) 
	{	

			if(usuario::TraerUnUsuarioUserYCorreo($usuario,$correo))
			{
				return false;
			}
			else
			{
				$unUsuario = new Usuario();
				$unUsuario->usuario=$usuario;
				$unUsuario->correo=$correo;
				$unUsuario->clave=$clave; 
				$unUsuario->InsertarElUsuario();
				return true;
			}
		}
	

$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
$server->service($HTTP_RAW_POST_DATA);