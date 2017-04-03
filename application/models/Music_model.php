<?php
class Music_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('date');
    }
    public function get_music($limit = NULL,$offset = NULL)
	{
	    if ($limit === NULL)
	    {
	        $query = $this->db->get('music');
	        return $query->result_array();
	    }
	    $this->db->select('id, musicid, tittle, artist, name, time, status');
	    $this->db->order_by('id', 'DESC');
	    $query = $this->db->get('music',$limit,$offset);
	    return $query->result_array();
	}
    public function get_music_one($id = NULL)
	{
	    $this->db->select('id, musicid, tittle, artist, name, time, status');
	    $query = $this->db->get_where('music', array('id' => $id));
	    return $query->row_array();
	}
	public function get_num()
	{
	    $query = $this->db->count_all('music');
	    return $query;
	}
	public function get_history($date = NULL) {
	    if ($date == NULL) {
    		Date_default_timezone_set('PRC');
    		$datestring = '%Y-%m-%d';
    		$date = time();
    		$date = mdate($datestring, $date);
	    }
	    
	    $query = $this->db->get_where('history', array('date' => $date));
	    return $query->result_array();
	}
}
