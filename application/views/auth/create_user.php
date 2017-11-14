<!DOCTYPE html>
<html>
	<head>
      <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
      <meta name="renderer" content="webkit">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>用户管理</title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://cdn.bootcss.com/materialize/0.98.0/css/materialize.min.css" rel="stylesheet">
	</head>
	<body>
		<!-- header -->
		<nav>
			<div class="nav-wrapper">
				<a href="/admin" class="brand-logo">用户管理</a>
			</div>
		</nav>
		<!--header end-->
            <div class="container">

                  <h2><?php echo lang('create_user_heading');?></h2>
                  <p><?php echo lang('create_user_subheading');?></p>

                  <div id="infoMessage"><?php echo $message;?></div>

                  <?php echo form_open("auth/create_user");?>

                        <p>
                              <?php echo lang('create_user_username_label', 'username');?> <br />
                              <?php echo form_input($username);?>
                        </p>
                        
                        <?php
                        if($identity_column!=='email') {
                        echo '<p>';
                        echo lang('create_user_identity_label', 'identity');
                        echo '<br />';
                        echo form_error('identity');
                        echo form_input($identity);
                        echo '</p>';
                        }
                        ?>

                        <p>
                              <?php echo lang('create_user_email_label', 'email');?> <br />
                              <?php echo form_input($email);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_label', 'password');?> <br />
                              <?php echo form_input($password);?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                              <?php echo form_input($password_confirm);?>
                        </p>


                        <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>
                        <a href="/auth">返回列表</a>
                        
                  <?php echo form_close();?>
                  
            </div>
	</body>
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
</html>