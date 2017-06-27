<?php
include_once("session.php");
include_once("mysql.php");

$sql="SELECT * FROM sysuser WHERE account_id='$session_userid'";
$res=mysql_query($sql);
if($res){
	$rs=mysql_fetch_array($res);
}

if($session_userid=="" || $rs['account_id']==""){
	$session_userid="";
	echo"<script>location.replace('login.php');</script>";
	die;
}


$sql_rev="SELECT * FROM review WHERE review_id={$_GET['reviewid']}";
$res_rev=mysql_query($sql_rev);
$rs_rev=mysql_fetch_array($res_rev);

if($session_userid==$rs_rev['account_id']){
	$sql_del="DELETE FROM review WHERE review_id={$_GET['reviewid']}";
	$rev_del=mysql_query($sql_del);
	echo"<script>location.replace('manage_review.php');</script>";

}else{
	echo"<script>location.replace('login.php');</script>";
}

?>