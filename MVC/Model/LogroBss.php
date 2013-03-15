<?php
/**
 *
 *
 */
class LogroBss{
	//Atributos

		 //Metodos
		 
		 /*
		 * @param string 
		 * @param string 
		 * @param string 
		 * @return 
		 */

		 function otorgar($clave, $detalles, $puntos_otorgados, $cliente_premiado, $nom_juego, $fecha)
		 {
		 	//Conectarse a la Base se Datos
			require ('LogroClass.php');
		 	require ('bd_info.inc');
		 	require ('conexion.php');
			$conexion = new DataB( $host, $user, $pass, $bd );

			if(!$conexion->conecta())
				die('No se ha podido conectar a la Base de Datos');

			//Asignar variables al objeto
		 	$clave		= $conexion->limpiarVariable($clave);
		 	$detalles		= $conexion->limpiarVariable($detalles);
		 	$cliente_premiado	= $conexion->limpiarVariable($cliente_premiado);
		 	$puntos_otorgados	= $conexion->limpiarVariable($puntos_otorgados);
		 	$fecha	= $conexion->limpiarVariable($fecha);
		 	$nom_juego	= $conexion->limpiarVariable($nom_juego);

			
			$query = "INSERT INTO 
						logros (detalles,puntos_otorgados, cliente_premiado, fecha,nom_juego) 
					VALUES 
						('$detalles',
						'$puntos_otorgados',
						'$cliente_premiado',
						'$nom_juego',
						'$fecha')"; 	
						
			//Ejecutar el query
			$resultado = $conexion->ejecutarConsulta($query); 	

			/*if($resultado == FALSE)
			{
				echo 'Fallo en la consulta ';
				$conexion->cerrarConexion();
				return FALSE;
			}
			else
			{*/
				$clave = $resultado;
				$conexion->cerrarConexion();
				$logro = new LogroClass($clave, $detalles, $puntos_otorgados, $cliente_premiado, $nom_juego, $fecha);
				return $logro; 
			//}
		 }

		//Funcion Mostrar 
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
						logros";	
						
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
		 
		 
		//Funcion Consultar
		/*
		 * @param string $nick, nick de cliente a consultar
		 * @return TRUE di de encontro, FALSE si no se encontro 
		 */
		function consultar( $clave )
		{
			require ('LogroClass.php');
			require ('conexion.php');
			require ('bd_info.inc');
			$conexion = new DataB( $host, $user, $pass, $bd );

			if(!$conexion->conecta())
				die('Consultar No se ha podido Realizar');		
				
			$clave = $conexion->limpiarVariable($clave);
					
			//Crear el query
			$query = "SELECT 
						* 
					FROM 
						logros
					WHERE
						clave='$clave'";
						
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
				if ($resultado[0]['clave'] == $clave)
				{
					$logro = new LogroClass($resultado[0]['clave'], $resultado[0]['detalles'], $resultado[0]['puntos_otorgados'], $resultado[0]['cliente_premiado'], $resultado[0]['nom_juego'], $resultado[0]['fecha']);
					return $logro;
				}
				else 
					return FALSE; 
			}
		}
}
?>