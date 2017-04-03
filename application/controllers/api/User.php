<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('User_model');
		$this->load->library('gravatar');
    }
	public function index()
	{
	}
	public function loggin() {
		echo json_encode($this->User_model->loggin());
	}
	public function logout() {
		echo json_encode($this->User_model->logout());
	}
	public function register() {
		echo json_encode($this->User_model->register());
	}
	public function info() {
		echo json_encode($this->User_model->userinfo());
	}
	public function cpw() {
	    echo json_encode($this->User_model->change_password());
	}
	public function gravatar($email) {
		echo $this->gravatar->get($email);
	}
}
