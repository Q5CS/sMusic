<?php
class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->library('ion_auth');
    }
	public function loggin() {
		$id = $this->input->post('id');
		$pw = $this->input->post('pw');
		$rm = $this->input->post('rm');
		if ($this->ion_auth->login($id, $pw, $rm)) {
			$data = array(
				'status' => '1',
				'msg' => '登录成功'
			);
		} else {
			$data = array(
				'status' => '-1',
				'msg' => '登录失败，请检查邮箱和密码是否正确！'
			);
		}
		return $data;
	}

	public function logout() {
		$this->ion_auth->logout();
		$data = array(
			'status' => '1',
			'msg' => '注销成功！'
		);
		return $data;
	}
	
	public function register() {
		$email = $this->input->post('email');
		$pw = $this->input->post('pw');
		$un = $this->input->post('un');
		$additional_data = array(); // Nothing
		$group = array('2'); // Sets user to group "member".
		if(strlen($pw)<8 || strlen($pw)>20){
    			$data = array(
				'status' => '-1',
				'msg' => '密码必须为8-20位的数字和字母的组合'
			);
        } else if ($this->ion_auth->username_check($un)) {
    			$data = array(
				'status' => '-1',
				'msg' => '用户名已存在，请更换用户名注册'
			);
        } else if ($this->ion_auth->email_check($email)) {
    			$data = array(
				'status' => '-1',
				'msg' => '邮箱地址已存在，请更换邮箱注册'
			);
        } else if ($this->ion_auth->register($un, $pw, $email, $additional_data, $group) != false) {
			$data = array(
				'status' => '1',
				'msg' => '注册成功'
			);
		} else {
			$data = array(
				'status' => '-1',
				'msg' => '注册失败，请检查注册信息是否正确！'
			);
		}
		return $data;
	}
	public function userinfo() {
		$user = $this->ion_auth->user()->row();
		$data = array(
			'username' => $user->username,
			'email' => $user->email,
			'created_on' => $user->created_on,
			'last_login' => $user->last_login,
			'name' => $user->name
		);
		return $data;
	}
	public function change_password() {
	    $old_pw = $this->input->post('old_pw');
	    $new_pw = $this->input->post('new_pw');
	    if ((strlen($new_pw)<8) || (strlen($new_pw)>20)) {
			$data = array(
				'status' => '-1',
				'msg' => '更改密码失败，密码必须为8-20位的数字和字母的组合'
			);
	    } else {
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $old_pw, $new_pw);
			if ($change)
			{
				//if the password was successfully changed
    			$data = array(
    				'status' => '1',
    				'msg' => '更改密码成功，请重新登录'
    			);
				$this->logout();
			}
			else
			{
    			$data = array(
    				'status' => '-1',
    				'msg' => '更改密码失败，请检查旧密码是否正确！'
    			);
			}
	    }
	    return $data;
	}
}
