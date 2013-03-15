<?php

class EventoClass{
	//Atributos
	public $numero;
	public $detalles;
	public $nom_juego;
	public $tipo;
	public $fecha;
	public $nick_ganador;
	public $participantes;
	
	function __construct($nu, $de, $nj, $ti, $fe, $ng = 'N/A', $pa = 0)
	{
		$this->numero = $nu;
		$this->detalles = $de;
		$this->nom_juego = $nj;
		$this->tipo = $ti;
		$this->fecha = $fe;
		$this->nick_ganador = $ng;
		$this->participantes = $pa;
	}
}
?>