$('#register-btn').click(function() {
	email = $('#register-email').val();
	pw = $('#register-password').val();
	un = $('#register-username').val();
	cpw = $('#register-confirm-password').val();

	if($('#email').hasClass('invalid')||$.trim(email)=='') {
		Materialize.toast('请输入正确的邮箱！', 4000);
	} else if (pw != cpw) {
	    Materialize.toast('两次输入的密码不一致！', 4000);
	} else if(pw.length<8||pw.length>20){
	    Materialize.toast('密码必须在8-20位之间！', 4000);
    } else {
		$('#register-btn').addClass('disabled');
		$('#register-btn').html('请稍候');
		$.post("api/user/register",{ email:email,pw:pw,un:un },function(json){
			$('#register-btn').removeClass('disabled');
			$('#register-btn').html('注册');
			status = json.status;
			msg = json.msg;
			if (status == '1') {
				//Materialize.toast(msg, 4000);
				alert(msg);
				window.location.href = '/';
			} else {
				Materialize.toast(msg, 4000);
			}
		}, 'json');
	}
});