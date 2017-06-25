<?php
session_start();

if(!isset($_SESSION['session_userid'])){
	$session_userid="";
}else{
	$session_userid=$_SESSION['session_userid'];
}
?>