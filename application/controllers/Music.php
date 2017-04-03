<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends CI_Controller {

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
        $this->load->library('ion_auth');
        $this->load->helper('url_helper');
    }
	public function index()
	{
		$data['logged_in'] = $this->ion_auth->logged_in();
        $data['is_admin'] = $this->ion_auth->is_admin();
		$smusic_tittle = $this->config->item('site_name');
		$data['title'] = $smusic_tittle;
		$data['add_css'] = array('index.css');
		$data['add_js'] = array('APlayer.min.js','index.js');

		$this->load->helper('url');
		$this->load->view('header',$data);
		$this->load->view('index',$data);
		$this->load->view('footer',$data);
	}
    public function view($slug = NULL)
    {
        $data['music_item'] = $this->music_model->get_music($slug);
    }
    public function history() {
		$data['logged_in'] = $this->ion_auth->logged_in();
        $data['is_admin'] = $this->ion_auth->is_admin();
		$smusic_tittle = $this->config->item('site_name');
		$data['title'] = '历史歌单 - '.$smusic_tittle;
		$data['add_css'] = array('history.css','share.min.css');
		$data['add_js'] = array('APlayer.min.js','jquery.share.min.js','history.js');

		$this->load->helper('url');
		$this->load->view('header',$data);
		$this->load->view('history',$data);
		$this->load->view('footer',$data);
    }
}
