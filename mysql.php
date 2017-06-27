<?php

$host = getenv('IP');
$usr = getenv('C9_USER');
$pwd = "";
$database = "c9";

$dbconn = mysql_connect($host,$usr,$pwd) or die("서버 접속 에러");
mysql_select_db($database);
?>