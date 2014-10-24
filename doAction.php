<?php 
header("content-type:text/html;charset=utf-8");
$act = $_REQUEST['act'];
$username = $_POST['username'];
$password = md5($_POST['password']);

/**
 * 数据库连接操作
 */
mysql_connect('localhost','root','');
mysql_select_db('demo');
mysql_set_charset('utf8');

/**
 * 根据表单提交的动作不同，分别处理不同的模块
 * $act String reg 处理注册模块
 * $act String login 处理登陆模块
 */

if ($act == "reg") {
	$sql = "insert user(username,password) values('{$username}', '{$password}')";
	$result = mysql_query($sql);
	if ($result) {
		echo "注册成功，3秒钟后跳转到登陆页面";
		echo "<meta http-equiv='refresh' content='3;url=login.html'/>"; //meta自动跳转
	}else{
		echo "注册失败，请重新注册";
		echo "<meta http-equiv='refresh' content='1;url=reg.html'/>"; 
	}
}elseif($act == "login"){
	$sql = "select username,password from user where username='{$username}' and password='{$password}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	if ($row) {
		echo "登陆成功，3秒钟后跳转到百度首页";
		echo "<meta http-equiv='refresh' content='3;url=http://www.baidu.com'/>";
	}else{
		echo "登陆失败，请重新登陆";
		echo "<meta http-equiv='refresh' content='1;url=login.html'/>";
	}
}
 ?>