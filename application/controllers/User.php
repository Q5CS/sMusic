<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->helper('url_helper');
		$this->load->model('User_model');
    }
	public function index()
	{
	    if ($this->ion_auth->logged_in()) {
			$smusic_tittle = $this->config->item('site_name');
    		$data['title'] = '个人中心 - '.$smusic_tittle;
    		$data['add_css'] = array('user/userpanel.css');
    		$data['add_js'] = array('user/userpanel.js');
    		$data['logged_in'] = $this->ion_auth->logged_in();
    		$data['is_admin'] = $this->ion_auth->is_admin();
    
    		$this->load->helper('url');
    		$this->load->view('header',$data);
    		$this->load->view('user/userpanel',$data);
    		$this->load->view('footer',$data);
	    } else {
	        redirect($config['base_url']);
	    }
	}
	public function register()
	{
	    if (!$this->ion_auth->logged_in()) {
			$smusic_tittle = $this->config->item('site_name');
    		$data['title'] = '注册 - '.$smusic_tittle;
    		$data['add_css'] = array('user/register.css');
    		$data['add_js'] = array('user/register.js');
    		$data['logged_in'] = $this->ion_auth->logged_in();
            $data['is_admin'] = $this->ion_auth->is_admin();
            
    		$this->load->helper('url');
    		$this->load->view('header',$data);
    		$this->load->view('user/register',$data);
    		$this->load->view('footer',$data);
	    } else {
	        redirect($config['base_url']);
	    }
	}
}
