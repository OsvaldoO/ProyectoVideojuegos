<?php
/**
 * @package mvc
 * @subpackage controller
 * @autor
 */

//Este controlador requiere tener acceso al modelo
include_once('Model/JuegoBss.php');

//La clase controlador

class JuegoCtr{

	public $modelo;

	function __construct(){
		$this -> modelo = new JuegoBss();
	}

	function ejecutar(){
		//Si no tengo parametros listo los usuarios
		if( !isset($_REQUEST['action']) ){
			$juegos = $this->modelo->listar();
			//Incluyo la Vista
			include('View/juegoListaView.php');
		}
		else {
			switch($_REQUEST['action']) {
					case 'agrega':
					if( isset($_REQUEST['nombre']) and isset($_REQUEST['genero']) and isset($_REQUEST['cantidad']))
					{
						$juego = $this->modelo->agregar( $_REQUEST['nombre'], $_REQUEST['genero'], $_REQUEST['cantidad'] );
						include('View/juegoView.php');
					}
					else { include('View/juegoErrorView.php'); }
					break;
					case 'consulta':
					if( isset($_REQUEST['nombre']))
					{
						$juego = $this->modelo->consultar($_REQUEST['nombre']);
						if(is_object($juego))
							include('View/juegoView.php');
						else {
						include('View/juegoNoEncontradoView.php');	
						}				
					}
					break;
					case 'borra':
					if( isset($_REQUEST['nombre']))
					{
						$juego = $this->modelo->borrar($_REQUEST['nombre']);
						if($juego)
							//include('View/juegoView.php');
							echo 'Juego Borrado';
						else {
						include('View/juegoNoEncontradoView.php');	
						}				
					}
					break;
					default: echo 'Accion no Implementada';
								
				}		
		}
	}
}
?>
