<?php
include_once("session.php");
include_once("mysql.php");

$sql="SELECT * FROM sysuser WHERE account_id='$_POST[userid]'";
$res= mysql_query($sql,$dbconn);
if($res){
	$rs=mysql_fetch_array($res);
	if($rs['account_id']==$_POST['userid'] && $_POST['userid']!=""){
		if($rs['password']==$_POST['password']){
			$_SESSION['session_userid']=$rs['account_id'];
			echo"<script>location.replace('normal_search_window.php');</script>";
		}else{
			echo"<script>alert('비밀번호가 올바르지 않습니다.');location.replace('login.php');</script>";
		}
	}else{
		echo"<script>alert('아이디가 올바르지 않습니다.');location.replace('login.php');</script>";
	}
}else{
	echo"An error occurred.\n";
	exit;
}
?>