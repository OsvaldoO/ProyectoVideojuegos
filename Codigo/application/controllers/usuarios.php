<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	 
	 public function __construct()
    {
    parent:: __construct();
    $this->load->model('usuario');
    $this->load->model('get_db');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('my_validation');
    $this->load->library('session');
    }
    
	public function index()
	{
		if($this->session->userdata('user'))
		{
			$this->vista('usuarios/index');
		}
		else 
		{
			$data['mensaje']= "SECCION NO INICIADA";
			$this->vista('error/mensaje',$data);
		}
	}
	
	public function registro() {
					$data = array();
					$error =false;
					if(!isset($_POST['nick']))
        {
        		$this->vista('usuarios/registrar'); //si no recibimos datos por post, cargamos la vista del formulario
        }
        else
        {
        //definimos las reglas de validación
        $this->form_validation->set_rules('nombre','Nombre','alpha|min_lenght[3]|max_lenght[50]');
        $this->form_validation->set_rules('nick','Nick','required|alpha_numeric|min_lenght[5]|max_lenght[20]');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('pass','Password','required');
        $this->form_validation->set_rules('repass','Re-Password','required');
        if(!$this->my_validation->valid_url($this->input->post('avatar')) || !$this->my_validation->validaUrl($this->input->post('avatar')))
        {
       				$data['message'] = "Url de Avatar no valida";
       				$error = true;
       	}
       	if( $this->input->post('pass') != $this->input->post('repass') )
        {
        		$data['message'] = "Los campos Password No coinciden";
        		$error = true;
        }
	      if($this->form_validation->run() == FALSE || $error)   //si no supera las reglas de validación se recarga la vista del formulario
	      {
	     		 $this->vista('usuarios/registrar',$data);
	      }
	      else{
	      	$data = array(
	       'nick' => $this->input->post('nick'),
	       'nombre' => $this->input->post('nombre'),
	       'email' => $this->input->post('email'),
	       'pass' => $this->input->post('pass'),
	       'avatar' => "http://www.gamers.vg/wp-content/uploads/2012/11/Xbox-360notext.jpg"
    			);
    		if($this->input->post('avatar')!= "")
    		{
    			$data['avatar']= $this->input->post('avatar');
    		}
			$this->get_db->inserta('usuarios',$data);
			$this->vista('index');
         }
        }
		}	
	
	
	
	public function cambiarPass()
	{
		$data = array();
		$error =false;
		if(!isset($_POST['pass']))
        {
        		$this->vista('usuarios/password'); //si no recibimos datos por post, cargamos la vista del formulario
        }
        else
        {
        $this->form_validation->set_rules('old','Password Actual','required');
        $this->form_validation->set_rules('pass','Password','required');
        $this->form_validation->set_rules('repass','Re-Password','required');
        if( $this->input->post('pass') != $this->input->post('repass') )
        {
        		$data['message'] = "Los campos del nuevo Password No coinciden";
        		$error = true;
        }
	      if($this->form_validation->run() == FALSE )   //si no supera las reglas de validación se recarga la vista del formulario
	      {
	     		 $error = true;
	      }
	      if(!$this->usuario->correctPass($this->session->userdata('user'),$this->input->post('old')))   //si no supera las reglas de validación se recarga la vista del formulario
	      {
        		$data['message'] = "El password Actual es Incorrecto";
        		$error = true;
	      }
	      if( $error)   //si no supera las reglas de validación se recarga la vista del formulario
	      {
	     		 $this->vista('usuarios/password',$data);
	      }
	      else 
	      {
	      		$pass = array(
	       			'pass' => $this->input->post('pass'));
	      		$this->usuario->cambiaPass($this->session->userdata('user'),$pass); 
	      		$this->session->set_userdata($pass);
	      		$this->vista('usuarios/exito',$data);
	      }
	   }
	}
		
	public function listar() {
		$data['usuarios'] = $this->usuario->listaTop();
		$this->vista('usuarios/listar',$data);
		}
		
		public function editar()
		{
		if(!isset($_POST['nick']))
        {
        		$this->vista('usuarios/editar'); //si no recibimos datos por post, cargamos la vista del formulario
        }
        else
        {
					$data = array(
	       	'nombre' => $this->input->post('nombre'),
	       	'email' => $this->input->post('email'),
	       	'pass' => $this->input->post('pass'),
	        'avatar' => $this->input->post('avatar'),
          );
         $this->session->set_userdata($data);
						$this->get_db->editar('nick',$this->input->post('nick'),"usuarios", $data);
					$this->vista('usuarios/index');    
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
    $data['pass'] = $this->session->userdata['pass'];											
		}
		$this->load->view('header',$data);
		$this->load->view($vista);
		$this->load->view('footer');
	}
	
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
