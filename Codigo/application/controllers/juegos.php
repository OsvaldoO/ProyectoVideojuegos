<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juegos extends CI_Controller {

	 public function __construct()
    {
    parent:: __construct();
    $this->load->model('get_db');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('my_validation');
    }
    
	public function index()
	{
  	$this->vista('juegos/categoria');	
	}
	
	public function listar($genero=false) 
		{
			if(!$genero)
		 			$this->vista('juegos/categoria');
		 	else 
		 	{
		 		$this->load->model('get_db');
				$data['juegos']= $this->get_db->getRegistros('juegos','genero',$genero);
		 		$this->vista('juegos/listar',$data);
		 		}	
		}
		
		
	public function nuevo(){
					$data = array();
					$error =false;
			if(!isset($_POST['nombre']))
        {
							$this->vista('juegos/nuevo'); //si no recibimos datos por post, cargamos la vista del formulario
        }
        else
        {
        //definimos las reglas de validación
        $this->form_validation->set_rules('nombre','Nombre','min_lenght[3]|alpha_dash|required|max_lenght[200]');
        if(!$this->my_validation->valid_url($this->input->post('imagen')) || !$this->my_validation->validaUrl($this->input->post('imagen')))
        {
       				$data['message'] = "Url de la imagen no valida";
       				$error = true;
       	}
       	 if($this->form_validation->run() == FALSE || $error)   //si no supera las reglas de validación se recarga la vista del formulario
	      {
	     		$this->vista('juegos/nuevo',$data);
	      }
	      else 
	      {
			 			$data = array(
	       'nombre' => $this->input->post('nombre'),
	       'genero' => $this->input->post('genero'),
	       	'imagen' => "http://entechnet.com/wp-content/uploads/2013/04/xbox-logo.jpg"
	    			);
	    			if($this->input->post('imagen')!= "")
	    			{
	    				$data['imagen']= $this->input->post('imagen');
	    			}
						$this->get_db->inserta('juegos',$data);
						$this->listar($data['genero']);
					}
				}
 }
 
		
	public function vista($vista,$data=false) 
	{
		if($this->session->userdata('user'))
		{
		 $data['nick'] = $this->session->userdata['user'];
    $data['nombre'] = $this->session->userdata['nombre'];
    $data['email'] = $this->session->userdata['email'];
    $data['puntos'] = $this->session->userdata['puntos'];
    $data['rol'] = $this->session->userdata['rol'];
    $data['credito'] = $this->session->userdata['credito'];
    $data['avatar'] = $this->session->userdata['avatar'];											
		}
		$this->load->view('header',$data);
		$this->load->view($vista);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
