<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class get extends CI_Controller {

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
    }
	public function index()
	{
		$data['music'] = $this->music_model->get_music();
		echo json_encode($data);
	}
    public function view($limit = NULL,$offset = NULL)
    {
        $data['music_item'] = $this->music_model->get_music($limit,$offset);
        echo json_encode($data);
    }
    public function one($serverid = NULL)
    {
        $data['music_item'] = $this->music_model->get_music_one($serverid);
        echo json_encode($data);
    }
    public function totalNum()
    {
        $data['totalNum'] = $this->music_model->get_num();
        echo json_encode($data);
    }
    public function history($date = NULL) {
        $data['history'] = $this->music_model->get_history($date);
        echo json_encode($data);
    }
}
