<?php
$host = 'localhost';
$usr = 'root';
$pwd = '0351';
$db = mysql_connect($host,$usr,$pwd) or die("서버 접속 에러");

mysql_select_db("term",$db);
?>