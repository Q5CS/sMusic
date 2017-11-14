<?php
# just download the NeteaseMusicAPI.php into directory, require it with the correct path.
# in weapi, you should also put BigInteger.php into same directory, but don't require it.
require_once 'NeteaseMusicAPI.php';

class Get_music extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_music($musicid)
	{
		# Initialize
		$api = new NeteaseMusicAPI();
		# Get data
		//$result = $api->search('hello');
		// or $result = $api->mini()->search('hello');
		// $result = $api->artist('46487');
		 $result = $api->detail($musicid);
		// $result = $api->album('3377030');
		// $result = $api->playlist('124394335');
		// $result = $api->url('35847388'); # v2 only
		// $result = $api->lyric('35847388');
		// $result = $api->mv('501053');

		# return JSON, just use it
		$data=json_decode($result);
		header('Content-type: application/json; charset=UTF-8');
		return json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	}
}
