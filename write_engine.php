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

$sql_review_cnt="SELECT MAX(review_id) FROM review";
$res_num=mysql_query($sql_review_cnt);
$rs_num=mysql_fetch_array($res_num);
$review_id=$rs_num['MAX(review_id)']+1;
$today=getdate();
$year2=$today['year'];
$month=$today['mon'];
$day=$today['mday'];
$date="$year2" . "." . "$month" . "." . "$day";

$sql_insert="insert into review values('$session_userid', $review_id, '$_GET[review]','$_GET[score]', '$date', '$_GET[courseid]', '$_GET[sectionid]', '$_GET[semester]', '$_GET[year]')";

$res_insert=mysql_query($sql_insert);

$link="course_info.php?courseid={$_GET['courseid']}&sectionid={$_GET['sectionid']}&semester={$_GET['semester']}&year={$_GET['year']}";
echo"<script>location.replace('", $link, "');</script>";

?>