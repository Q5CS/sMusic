<?php

if(is_file("../application/config/smusic.php")){
	echo("smusic.php 已存在！如需重新安装，请删除 application/config/smusic.php");
	exit();
}
$projectname = $_POST['projectname'];
$url = $_POST['url'];
$dbhost = $_POST['dbhost'];
$dbuser = $_POST['dbuser'];
$dbpasswd = $_POST['dbpasswd'];
$dbname = $_POST['dbname'];
if($projectname == ''||$url == ''||$dbuser == ''||$dbname == ''){
	echo("表单信息不能为空，请重新填写");
	exit();
}
if($dbhost == ""){
   $dbhost = "localhost";
}

$_sql = file_get_contents('import.sql');
$_arr = explode(';', $_sql);
$_mysqli = new mysqli($dbhost,$dbuser,$dbpasswd);
if (mysqli_connect_errno()) {
    exit('连接数据库出错，请尝试手动导入 sql 文件，并将 install 目录下的 smusic.example.php 编辑后复制到 application/config 文件夹');
}
//执行sql语句
$_mysqli->query("CREATE DATABASE IF NOT EXISTS ".$dbname." DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
$_mysqli->query("USE ".$dbname);
foreach ($_arr as $_value) {
    $_mysqli->query($_value.';');
}
$_mysqli->close();
$_mysqli = null;

$writecontent='<?php
defined("BASEPATH") OR exit("No direct script access allowed");

$smusic_tittle = "'.$projectname.'";
$smusic_url = "'.$url.'";
$smusic_db_ip = "'.$dbhost.'";
$smusic_db_name = "'.$dbname.'";
$smusic_db_user = "'.$dbuser.'";
$smusic_db_password = "'.$dbpasswd.'";

?>';

$myfile = fopen("../application/config/smusic.php", "w") or die("配置文件不可写，请手动复制 install 目录下的 smusic.example.php 到 application/config 文件夹并编辑。");
fwrite($myfile, $writecontent);
fclose($myfile);

//写出配置文件

echo("安装成功！<br>默认账号：admin@admin.com<br>默认密码：password<br>请立即修改管理员密码！！！");