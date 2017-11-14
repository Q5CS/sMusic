<?php
class AddMusicModel extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('Get_music');
        $this->load->helper('date');
        $this->load->helper('security');
        $this->load->library('ion_auth');
    }

	public function add_music()
	{
		$musicid = $this->input->post('musicid');
		$name = $this->input->post('name');
		$name = $this->security->xss_clean($name);
		$ip = $this->input->ip_address();
		//var_dump($musicid);
		Date_default_timezone_set('PRC');
		$datestring = '%Y-%m-%d %H:%i:%s';
		$time = time();
		$time = mdate($datestring, $time);

		$musicjson = $this->Get_music->get_music($musicid);
		$musicjson = json_decode($musicjson);
		//var_dump($musicjson);
		$tittle = $musicjson -> songs[0] -> name;
		$arnum = $musicjson -> songs[0] -> ar;
		$arnum = count($arnum);
		$artist = $musicjson -> songs[0] -> ar[0] -> name;
		for ($i=1;$i<$arnum;$i++) {
			$artist = $artist . '、';
			$artist = $artist . $musicjson -> songs[0] -> ar[$i] -> name;
		}

		if (!$this->ion_auth->logged_in()) {
			$returndata['status'] = -1;
			$returndata['msg'] = '请先登录！';
		} else if ($tittle == NULL) {
	    	$returndata['status'] = -1;
			$returndata['msg'] = '无法获取歌曲信息，请确认该歌曲是否存在！';
	    } else if (mb_strlen($name) > 20) {
	    	$returndata['status'] = -1;
			$returndata['msg'] = '点歌人信息太长！';
	    } else {
			$user = $this->ion_auth->user()->row()->username;
			$userid = $this->ion_auth->user()->row()->id;
			$data = array(
				'musicid' => $musicid,
				'user' => $user,
				'userid' => $userid,
				'name' => $name,
				'time' => $time,
				'tittle' => $tittle,
				'artist' => $artist,
				'status' => 0,
				'ip' => $ip
			);
			//var_dump($data);
			$this->db->insert('music', $data);

	    	$returndata['status'] = 1;
			$returndata['msg'] = '提交成功';
	    }

		return json_encode($returndata);
	}
}
