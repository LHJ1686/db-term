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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"></meta>
		<style>
  	div.menu{
  		float:left;
  		height:800px;
  		width:15%;
  		padding:5px;
  		background-color:#B0D0D6;

  	}
  	div.myreviewlist{
  		margin-left:17%;
  		height:800px;
  		width:70%;
  		padding:5px;
  		background-color:#E6FFFF;
  	}
  </style>
	</head>
	<body>
		<?php
			$sql_my="SELECT * FROM review NATURAL JOIN course WHERE account_id = '{$session_userid}'";
			$sql_my_cnt="SELECT COUNT(review_id) FROM review WHERE account_id='{$session_userid}'";

			$res_my=mysql_query($sql_my);
			$res_my_cnt=mysql_query($sql_my_cnt);

			$rs_my_cnt=mysql_fetch_array($res_my_cnt);

			
		?>
		<div class="menu" id="menu"><?php include_once('menu.php'); ?></div>
		<div class="myreviewlist" id="myreviewlist">
      <?php
        for($i=0; $i<$rs_my_cnt['COUNT(review_id)']; $i++){
          $rev_rs=mysql_fetch_array($res_my);

		      echo"<div style='border:1px dashed; background-color:white; margin-bottom:5px; padding:5px;'><strong>{$rev_rs['title']}</strong>";
          echo"<table><tr><td>글번호:</td><td>{$rev_rs['review_id']}</td></tr>";
          echo"<tr><td>작성일:</td><td>{$rev_rs['date']}</td></tr>";
          echo"<tr><td>점수:</td><td>{$rev_rs['score']}</td></tr>";
          echo"<tr><th colspan='2'>{$rev_rs['text']}</th></tr>";

          echo"<tr><td><form action='revise_review.php' method='get' name='revise' id='revise'>";
          echo"<input type='hidden' name='courseid' value={$rev_rs['course_id']} />";
          echo"<input type='hidden' name='sectionid' value={$rev_rs['section_id']} />";
          echo"<input type='hidden' name='semester' value={$rev_rs['semester']} />";
          echo"<input type='hidden' name='year' value={$rev_rs['year']} />";
          echo"<input type='hidden' name='reviewid' value={$rev_rs['review_id']} />";
          echo"<input type='submit' name='Submit' value='수정'></input></form></td>";

          echo"<td><form action='delete_engine.php' method='get' name='delete' id='delete'>";
          echo"<input type='hidden' name='reviewid' value={$rev_rs['review_id']} />";
          echo"<input type='submit' name='Submit' value='삭제'></input></form></td></tr>";

          echo"</table><br></div>";

        }

      ?>
    </div>
	</body>
</html>