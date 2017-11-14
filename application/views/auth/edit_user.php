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

                <h2><?php echo lang('edit_user_heading');?></h2>
                <p><?php echo lang('edit_user_subheading');?></p>
                <div id="infoMessage"><?php echo $message;?></div>

                <?php echo form_open(uri_string());?>
                    <p>
                            <?php echo lang('edit_user_username_label', 'username');?> <br />
                            <?php echo form_input($username);?>
                    </p>
                    <p>
                            <?php echo lang('edit_user_email_label', 'email');?> <br />
                            <?php echo form_input($email);?>
                    </p>
                    <p>
                            <?php echo lang('edit_user_password_label', 'password');?> <br />
                            <?php echo form_input($password);?>
                    </p>

                    <p>
                            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                            <?php echo form_input($password_confirm);?>
                    </p>

                    <?php if ($this->ion_auth->is_admin()): ?>

                        <h3><?php echo lang('edit_user_groups_heading');?></h3>
                        <?php foreach ($groups as $group):?>
                            <!--<label class="checkbox">-->
                            <?php
                                $gID=$group['id'];
                                $checked = null;
                                $item = null;
                                foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked= ' checked="checked"';
                                    break;
                                    }
                                }
                            ?>
                            <p>
                                <input type="checkbox" name="groups[]" class="filled-in" value="<?php echo $group['id'];?>" id="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                <label for="<?php echo $group['id'];?>"><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></label>
                            </p>
                            
                            <!--</label>-->
                        <?php endforeach?>

                    <?php endif ?>

                    <?php echo form_hidden('id', $user->id);?>
                    <?php echo form_hidden($csrf); ?>

                    <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>
                    <a href="/auth">返回列表</a>

                <?php echo form_close();?>

			</div>
	</body>
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
</html>