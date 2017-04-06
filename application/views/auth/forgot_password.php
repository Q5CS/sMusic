<!DOCTYPE html>
<html>
	<head>
      <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
      <meta name="renderer" content="webkit">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>找回密码</title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://cdn.bootcss.com/materialize/0.98.0/css/materialize.min.css" rel="stylesheet">
	</head>
	<body>
		<!-- header -->
         <nav>
            <div class="nav-wrapper">
              <a href="/" class="brand-logo">找回密码</a>
            </div>
          </nav>
		<!--header end-->
            <div class="container">
                  <h2><?php echo lang('forgot_password_heading');?></h2>
                  <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

                  <div id="infoMessage"><?php echo $message;?></div>

                  <?php echo form_open("auth/forgot_password");?>

                        <p>
                              <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                              <?php echo form_input($identity);?>
                        </p>

                        <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>

                  <?php echo form_close();?>
            </div>
	</body>
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
</html>