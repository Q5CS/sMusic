<!DOCTYPE html>
<html>
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="renderer" content="webkit">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
    <?php
      if ($logged_in) {
        echo '<script> log_in = true; </script>';
      } else {
        echo '<script> log_in = false; </script>';
      }
    ?>
	</head>
	<body>
		<!-- header -->
         <nav>
            <div class="nav-wrapper">
              <a href="/" class="brand-logo"><?php echo $title; ?></a>
              <a data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="/">点歌列表</a></li>
                <li><a href="/music/history">历史歌单</a></li>
                <?php
                  if ($is_admin) {
                      echo '<li><a href="/admin">管理面板</a></li>';
                  }
                  if ($logged_in) {
                    echo '<li><a href="user">个人中心</a></li>';
                    echo '<li><a class="logout-btn">注销</a></li>';
                  } else {
                    echo '<li><a class="showlogin">登录</a></li>';
                  }
                ?>
              </ul>
              <ul class="side-nav" id="mobile-demo">
                <li><a href="/">点歌列表</a></li>
                <li><a href="/music/history">历史歌单</a></li>
                <?php
                  if ($is_admin) {
                      echo '<li><a href="/admin">管理面板</a></li>';
                  }
                  if ($logged_in) {
                    echo '<li><a href="user">个人中心</a></li>';
                    echo '<li><a class="logout-btn">注销</a></li>';
                  } else {
                    echo '<li><a class="showlogin">登录</a></li>';
                  }
                ?>
              </ul>
            </div>
          </nav>
		<!--header end-->
