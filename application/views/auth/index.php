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

				<h2><?php echo lang('index_heading');?></h2>
				<p><?php echo lang('index_subheading');?></p>

				<div id="infoMessage"><?php echo $message;?></div>

				<table cellpadding=0 cellspacing=10 class="bordered highlight">
					<tr>
						<th><?php echo lang('index_fname_th');?></th>
						<th><?php echo lang('index_lname_th');?></th>
						<th><?php echo lang('index_email_th');?></th>
						<th><?php echo lang('index_groups_th');?></th>
						<th><?php echo lang('index_status_th');?></th>
						<th><?php echo lang('index_action_th');?></th>
					</tr>
					<?php foreach ($users as $user):?>
						<tr>
							<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
							<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
							<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td>
								<?php foreach ($user->groups as $group):?>
									<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
								<?php endforeach?>
							</td>
							<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
							<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
						</tr>
					<?php endforeach;?>
				</table>

				<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>

			</div>
	</body>
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
</html>