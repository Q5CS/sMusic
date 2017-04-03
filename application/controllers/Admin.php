<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('music_model');
        $this->load->model('Admin_model');
        $this->load->library('ion_auth');
        $this->load->helper('url_helper');
    }
	public function index()
	{
	    if ($this->ion_auth->is_admin()) {
    		$data['music'] = $this->music_model->get_music();
			$smusic_tittle = $this->config->item('site_name');
    		$data['title'] = '管理面板 - '.$smusic_tittle;
    		$data['add_css'] = array('index.css','admin/index.css');
    		$data['add_js'] = array('APlayer.min.js','admin/index.js');
    
    		$this->load->helper('url');
    		$this->load->view('admin/header',$data);
    		$this->load->view('admin/index',$data);
    		$this->load->view('admin/footer',$data);
	    } else {
	        redirect($config['base_url']);
	    }
	}
	public function player()
	{
	    if ($this->ion_auth->is_admin()) {
    		$data['music'] = $this->music_model->get_music();
			$smusic_tittle = $this->config->item('site_name');
    		$data['title'] = '自动播放 - '.$smusic_tittle;
    		$data['add_css'] = array('admin/player.css');
    		$data['add_js'] = array('APlayer.min.js','admin/player.js');
    
    		$this->load->helper('url');
    		$this->load->view('admin/header',$data);
    		$this->load->view('admin/player',$data);
    		$this->load->view('admin/footer',$data);
	    } else {
	        redirect($config['base_url']);
	    }
	}
    public function view($limit = NULL,$offset = NULL,$status = 'all',$order = 'DESC')
    {
        if ($this->ion_auth->is_admin()) {
            $data['music_item'] = $this->Admin_model->get_music($limit,$offset,$status,$order);
            echo json_encode($data);
        }
    }
    public function getone($serverid = NULL)
    {
        if ($this->ion_auth->is_admin()) {
            $data['music_item'] = $this->Admin_model->get_music_one($serverid);
            echo json_encode($data);
        }
    }
    public function update_status()
    {
        if ($this->ion_auth->is_admin()) {
    		$data = $this->Admin_model->set_status();
    		$this->output->set_output($data);
        }
    }
    public function delete()
    {
        if ($this->ion_auth->is_admin()) {
    		$data = $this->Admin_model->delete();
    		$this->output->set_output($data);
        }
    }
    public function putout() {
        if ($this->ion_auth->is_admin()) {
    		$data = $this->Admin_model->putout();
    		$this->output->set_output($data);
        }
    }
}
