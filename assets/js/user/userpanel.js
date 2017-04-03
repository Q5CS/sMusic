$(document).ready(function(){
  $('.modal').modal();
});
$('#show-cpw-modal-btn').click(function() {
  $('#cpw-modal').modal('open'); 
});
$.getJSON("api/user/info", function (json) {
    username = json.username;
    email = json.email;
    created_on = date('Y-m-d H:i:s',json.created_on);
    last_login = date('Y-m-d H:i:s',json.last_login);
    name = json.name;
    $.get('api/user/gravatar/'+email, function (src) {
        $('#user-avatar').attr('src',src)
    });
    $('#user-info-div').html(
      '<p>用户名：'+username+'</p>'+
      '<p>邮箱：'+email+'</p>'+
      '<p>注册时间：'+created_on+'</p>'+
      '<p>上次登录：'+last_login+'</p>'
    );
    if (name != '') {
      $('#user-info-div').append(
        '<p>绑定校园网账户：'+name+'</p>'
      );
      $('#schoolid-btn').addClass('disabled'); //Temp!!!
      $('#schoolid-btn').html('解绑校园网账户');
    }
});

$('#cpw-btn').click(function() {
	old_pw = $('#user-cpw-old-pw').val();
	new_pw = $('#user-cpw-new-pw').val();
	cpw = $('#user-cpw-confirm-pw').val();

    var reg=/^[A-Za-z0-9]+$/;

	if (new_pw != cpw) {
	    Materialize.toast('两次输入的密码不一致！', 4000);
	} else if(!reg.test(new_pw)||new_pw.length<8||new_pw.length>20){
	    Materialize.toast('密码必须为8-20位的数字和字母的组合！', 4000);
    } else {
		$('#cpw-btn').addClass('disabled');
		$('#cpw-btn').html('请稍候');
		$.post("api/user/cpw",{ old_pw:old_pw,new_pw:new_pw },function(json){
			$('#cpw-btn').removeClass('disabled');
			$('#cpw-btn').html('修改密码');
			status = json.status;
			msg = json.msg;
			if (status == '1') {
				Materialize.toast(msg, 4000);
				window.location.href = '/';
			} else {
				Materialize.toast(msg, 4000);
			}
		}, 'json');
	}
});