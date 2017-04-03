<?php
class Admin_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('date');
    }
    public function set_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if (($status>1)||($status<-1)) {
			$returndata = array(
				'status' => -1
			);
			return json_encode($returndata);
		}

		$data = array(
		    'status'  => $status
		);
		$this->db->where('id', $id);
		$this->db->update('music', $data);
		$returndata = array(
			'status' => 1
		);
		return json_encode($returndata);
	}
    public function get_music($limit,$offset,$status,$order)
	{
	    if ($limit === NULL)
	    {
	        $query = $this->db->get('music');
	        return $query->result_array();
	    }
	    $this->db->order_by('id', $order);
	    if ($status == 'all')
	    {
	        $query = $this->db->get('music', $limit, $offset);
	    } else {
	        $query = $this->db->get_where('music', array('status' => $status), $limit, $offset);
	    }
	    return $query->result_array();
	}
    public function get_music_one($id = NULL)
	{
	    $query = $this->db->get_where('music', array('id' => $id));
	    return $query->row_array();
	}
    public function delete()
	{
		$id = $this->input->post('id');
		$data = array(
		    'id' => $id
		);
		$this->db->delete('music', $data);
		$returndata = array(
			'status' => 1
		);
		return json_encode($returndata);
	}
    private function sset_status($id,$status)
	{
		$data = array(
		    'status'  => $status
		);
		$this->db->where('id', $id);
		if($this->db->update('music', $data)) {
		    return true;
		} else {
		    return false;
		}
        
	}
    public function putout()
	{
		$id = $this->input->post('id');
		$query = $this->db->get_where('music', array('id' => $id))->row();
		
		Date_default_timezone_set('PRC');
		$datestring = '%Y-%m-%d';
		$time = time();
		$time = mdate($datestring, $time);
		
		$data = array(
            'date' => $time,
            'musicid' => $query->musicid,
            'tittle' => $query->tittle,
            'artist' => $query->artist
        );
        if ($this->db->insert('history', $data)) {
            if ($this->sset_status($query->id,1)) {
        		$returndata = array(
        			'status' => 1
        		);
            } else {
        		$returndata = array(
        			'status' => -1
        		);
            }
        } else {
    		$returndata = array(
    			'status' => -1
    		);
        }
        
		return json_encode($returndata);
	}
}
