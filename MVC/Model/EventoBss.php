<?php
/**
 *
 *
 */
class EventoBss{

		 //Metodos
		 
		 /*
		 * @param string 
		 * @param string 
		 * @param string 
		 * @return 
		 */

		 function publicar($numero, $detalles, $nom_juego, $tipo, $fecha)
		 {
		 	//Conectarse a la Base se Datos
			require ('EventoClass.php');
		 	require ('bd_info.inc');
		 	require ('conexion.php');
			$conexion = new DataB( $host, $user, $pass, $bd );

			if(!$conexion->conecta())
				die('No se ha podido conectar a la Base de Datos');		
			//Crear el query

			//Asignar variables al objeto
		 	$numero		= $conexion->limpiarVariable($numero);
		 	$detalles	= $conexion->limpiarVariable($detalles);
		 	$nom_juego	= $conexion->limpiarVariable($num_juego);
			$tipo	= $conexion->limpiarVariable($tipo);
			$fecha	= $conexion->limpiarVariable($fecha);

			
			$query = "INSERT INTO 
						eventos (numero, detalles, nom_juego, tipo, fecha) 
					VALUES 
						('$numero',
						'$detalles',
						'$nom_juego',
						'$tipo',
						'$fecha')"; 	
						
			//Ejecutar el query
			$resultado = $conexion->ejecutarConsulta($query); 	

		/*	if($resultado == FALSE)
			{
				echo 'Fallo en la consulta ';
				$conexion->cerrarConexion();
				return FALSE;
			}
			else
			{*/
				$num_evento = $resultado;
				$conexion->cerrarConexion();
				$evento = new EventoClass($numero, $detalles, $nom_juego, $tipo, $fecha);
				return $evento; 
			//}
		 }

		//Funcion Mostrar Clientes
		/*
		 * @return lista de clientes en array 
		 */
		 
		 function listar()
		 {
		 	require ('bd_info.inc');
		 	require ('conexion.php');
			$conexion = new DataB( $host, $user, $pass, $bd );

			if(!$conexion->conecta())
				die('Mostrar No se ha podido Realizar');			
							
			//Crear el query
			$query = "SELECT * 
						FROM 
						eventos";	
						
			//Ejecutar el query
			$resultado=$conexion->ejecutarConsulta($query); 	

			if(!$resultado)
			{
				echo 'Fallo en la consulta ';
				$conexion->cerrarConexion();
				return FALSE;
			}
			else
			{
				$conexion->cerrarConexion();
				return $resultado;
			}
		}
		 
		 
		//Funcion ConsultarCliente
		/*
		 * @param string $nick, nick de cliente a consultar
		 * @return TRUE di de encontro, FALSE si no se encontro 
		 */
		function consultar( $numero )
		{
			require ('EventoClass.php');
			require ('conexion.php');
			require ('bd_info.inc');
			$conexion = new DataB( $host, $user, $pass, $bd );

			if(!$conexion->conecta())
				die('Consultar No se ha podido Realizar');		
				
			$num_evento = $conexion->limpiarVariable($numero);		
							
			//Crear el query
			$query = "SELECT 
						* 
					FROM 
						eventos
					WHERE
						numero='$numero'";
						
			//Ejecutar el query
			$resultado=$conexion -> ejecutarConsulta($query); 	

			if(!$resultado)
			{
				echo 'Fallo en la consulta ';
				$conexion->cerrarConexion();
				return FALSE;
			}
			else
			{
				$conexion->cerrarConexion();
				if ($resultado[0]['numero'] == $numero)
				{
					$evento = new EventoClass($resultado[0]['numero'], $resultado[0]['detalles'], $resultado[0]['nom_juego'], $resultado[0]['tipo'], $resultado[0]['fecha'], $resultado[0]['nick_ganador'], $resultado[0]['participantes'] );
					return $evento;
				}
				else 
					return FALSE; 
			}
		}
}
?>