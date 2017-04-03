<!DOCTYPE html>
<html>
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.bootcss.com/materialize/0.98.0/css/materialize.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <?php
      for ($i=1;$i<=count($add_css);$i++) {
        echo '<link href="assets/css/'. $add_css[$i-1] . '" rel="stylesheet">' . PHP_EOL;
      }
    ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	</head>
	<body>
		<!-- header -->
         <nav>
            <div class="nav-wrapper">
              <a href="/" class="brand-logo"><?php echo $title; ?></a>
              <a data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="/">返回首页</a></li>
                <li><a href="/admin">管理面板</a></li>
                <li><a href="/auth">用户管理</a></li>
                <li><a href="/admin/player">自动播放</a></li>
                <li><a class="logout-btn">注销</a></li>
              </ul>
              <ul class="side-nav" id="mobile-demo">
                <li><a href="/">返回首页</a></li>
                <li><a href="/admin">管理面板</a></li>
                <li><a href="/auth">用户管理</a></li>
                <li><a href="/admin/player">自动播放</a></li>
                <li><a class="logout-btn">注销</a></li>
              </ul>
            </div>
          </nav>
		<!--header end-->
