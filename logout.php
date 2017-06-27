<?php
include_once("session.php");
$_SESSION['session_userid']="";

echo"<script>alert('logout success!');
location.replace('login.php')</script>";
?>