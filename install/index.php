<?php
if(is_file("../application/config/smusic.php")){
	echo("smusic.php 已存在！如需重新安装，请删除 application/config/smusic.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>安装 - sMusic</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.bootcss.com/materialize/0.98.0/css/materialize.min.css" rel="stylesheet">
    <style>
      .content {
        margin-left: auto;
        margin-right: auto;
        max-width: 500px;
      }
    </style>
  </head>
  <body>
    <div class="content">
      <form class="pure-form pure-form-stacked" action="install.php" method="post">
        <fieldset>
          <h2>安装sMusic</h2>
          <label>网站名称</label>
          <input type="text" name="projectname" class="form-control" placeholder="网站名称" required="" autofocus="">
          <label>网站地址（index.php 所在目录，务必填写协议）</label>
          <input type="text" name="url" class="form-control" placeholder="网站地址" required="" autofocus="" value="http://127.0.0.1/">
          <label>Mysql服务器地址</label>
          <input type="text" name="dbhost" class="form-control" placeholder="Mysql服务器地址" value="localhost">
          <label>Mysql用户名</label>
          <input type="text" name="dbuser" class="form-control" placeholder="Mysql用户名" required="" value="root">
          <label>Mysql密码</label>
          <input type="password" name="dbpasswd" class="form-control" placeholder="Mysql密码">
          <label>Mysql数据库名</label>
          <input type="text" name="dbname" class="form-control" placeholder="Mysql数据库名" required="">
          <button class="waves-effect waves-light btn" type="submit">开始安装</button>
        </fieldset>
      </form>
    </div>
</body>
</html>