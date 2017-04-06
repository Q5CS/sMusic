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

                  <h2><?php echo lang('create_group_heading');?></h2>
                  <p><?php echo lang('create_group_subheading');?></p>

                  <div id="infoMessage"><?php echo $message;?></div>

                  <?php echo form_open("auth/create_group");?>

                        <p>
                              <?php echo lang('create_group_name_label', 'group_name');?> <br />
                              <?php echo form_input($group_name);?>
                        </p>

                        <p>
                              <?php echo lang('create_group_desc_label', 'description');?> <br />
                              <?php echo form_input($description);?>
                        </p>

                        <p><?php echo form_submit('submit', lang('create_group_submit_btn'));?></p>
                        <a href="/auth">返回列表</a>
                        
                  <?php echo form_close();?>

            </div>
	</body>
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
</html>