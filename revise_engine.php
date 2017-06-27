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

$sql_check="SELECT account_id FROM review WHERE review_id=$_GET[reviewid]";
$res_check=mysql_query($sql_check);
$rs_check=mysql_fetch_array($res_check);

if($session_userid==$rs_check['account_id']){
  $sql_update_text="UPDATE review SET text='$_GET[review]' WHERE review_id=$_GET[reviewid]";
  $res_update_text=mysql_query($sql_update_text);

  $sql_update_score="UPDATE review SET score='$_GET[score]' WHERE review_id=$_GET[reviewid]";
  $res_update_score=mysql_query($sql_update_score);

  echo"<script>location.replace('manage_review.php');</script>";
}else{
  echo"<script>location.replace('login.php');</script>";
}
?>