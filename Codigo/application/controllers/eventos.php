<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos extends CI_Controller {


	 public function __construct()
    {
    parent:: __construct();
    date_default_timezone_set('UTC');
    $this->load->model('evento');
    $this->load->model('get_db');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
     $this->load->library('my_validation');
    }
    
	public function index()
	{
		$this->listar();
	}
	
	public function listar() {
		$this->vista('eventos/listar');
		}
		
		public function getEventos($eventos = false) {		
		$eventos = $this->evento->listaLast();
		echo json_encode($eventos);
		}
		
	public function Evento($numero)
	{
		$data['evento'] = $this->evento->getEvento($numero);
		$this->vista('eventos/listar',$data);
	}
		
	public function nuevo(){
					$data = array();
					$error =false;
				if(!isset($_POST['juego']))
        {
        		$data['juegos'] = $this->get_db->getlista('juegos','nombre');
							$this->vista('eventos/nuevo',$data); //si no recibimos datos por post, cargamos la vista del formulario
        }
        else
        {
        //definimos las reglas de validación
        $this->form_validation->set_rules('detalles','Detalles','min_lenght[3]|required|max_lenght[200]');
        if(!$this->my_validation->valid_url($this->input->post('img')) || !$this->my_validation->validaUrl($this->input->post('img')))
        {
       				$data['message'] = "Url de la imagen no valida";
       				$error = true;
       	}
       	 if($this->input->post('fecha') == "")
        {
       				$data['message'] = "Ingresa Una fecha valida";
       				$error = true;
       	}
       	 if($this->form_validation->run() == FALSE || $error)   //si no supera las reglas de validación se recarga la vista del formulario
	      {
	      	$data['juegos'] = $this->get_db->getlista('juegos','nombre');
	     		$this->vista('eventos/nuevo',$data);
	      }
	      else 
	      {
			 			$data = array(
	       'detalles' => $this->input->post('detalles'),
	       	'img' => "http://3.bp.blogspot.com/-yQpjEhqNqW0/UZsYH9P4G_I/AAAAAAAAM6g/-dg7lJARc-w/s640/timthumb.jpg",
	       'tipo' => $this->input->post('tipo'),
	       'fecha' => $this->input->post('fecha'),
	       'juego' => $this->input->post('juego')
	    			);
	    			if($this->input->post('img')!= "")
	    			{
	    				$data['img']= $this->input->post('img');
	    			}
						$this->get_db->inserta('eventos',$data);
						$this->listar();
					}
				}
 }
 
 
	public function inscribir($numero)
	{
	if($numero && $this->evento->noInscrito($this->session->userdata('user'),$numero)) {
		$data = array(
	       'numero' => $numero,
	       'usuario' => $this->session->userdata('user'),
	       'fecha' => date("Y/m/d")
	    	);
		$this->get_db->inserta('inscripciones',$data);
		}
		$this->ver();
	}
	
	public function cancelar($numero)
	{
		$this->evento->cancela($this->session->userdata('user'),$numero);
		$this->ver();
	}
		
	public function ver()
	{
		$data['eventos'] = $this->evento->misEventos($this->session->userdata('user'));
		$this->vista('usuarios/inscripciones',$data);	
	}		
	
	public function getMisEventos()
	{
		$eventos = false;
		if($this->session->userdata('user'))
		{
		$eventos = $this->evento->misEventos($this->session->userdata('user'));
		}
		echo json_encode($eventos);
	}		
		
	public function vista($vista,$data=false) 
	{
		$this->load->view('header',$data);
		$this->load->view($vista);
		$this->load->view('footer');
	}
}
