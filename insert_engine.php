<?php
include "mysql.php";

$sql="select * from sysuser where account_id='$_POST[userid]'";
$res=mysql_query($sql);
if($res){
	$rs=mysql_fetch_array($res);
	if($rs['account_id']==$_POST['userid'] && $_POST['userid']!=""){
		echo"<script>alert('Same ID already existed');history.go(-1);</script>";
		mysql_close();
		exit;
	}
}

$ins_sql="insert into sysuser (account_id,nickname,password) values('$_POST[userid]','$_POST[nickname]','$_POST[password]')";
mysql_query($ins_sql);
mysql_close();

echo"<script>alert('$_POST[userid] create success!');
location.replace('login.php')</script>";
?>