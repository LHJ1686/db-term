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
  	div.courseinfo{
  		margin-left:17%;
  		height:150px;
  		width:70%;
  		padding:5px;
  		background-color:#B0D0D6;
  	}
  	div.reviewlist{
  		margin-left:17%;
  		margin-top:10px;
  		height:620px;
  		width:70%;
  		padding:5px;
  		background-color:#E6FFFF;
  	}
  </style>
	</head>
	<body>
		<?php
			$sql_sec="SELECT * FROM instructor NATURAL JOIN teaches NATURAL JOIN section NATURAL JOIN course WHERE course_id='$_GET[courseid]' AND section_id='$_GET[sectionid]' AND semester='$_GET[semester]' AND year='$_GET[year]'";
      $sql_cnt="SELECT COUNT(title) FROM instructor NATURAL JOIN teaches NATURAL JOIN section NATURAL JOIN course WHERE course_id='$_GET[courseid]' AND section_id='$_GET[sectionid]' AND semester='$_GET[semester]' AND year='$_GET[year]'";

      $res=mysql_query($sql_sec);
      $res_cnt=mysql_query($sql_cnt);

      $rs=mysql_fetch_array($res);
      $num=mysql_fetch_array($res_cnt);

      $sql_rev="SELECT * FROM review WHERE course_id='$_GET[courseid]' AND section_id='$_GET[sectionid]' AND semester='$_GET[semester]' AND year='$_GET[year]'";
      $sql_rev_cnt = "SELECT COUNT(review_id) FROM review WHERE course_id='$_GET[courseid]' AND section_id='$_GET[sectionid]' AND semester='$_GET[semester]' AND year='$_GET[year]'";
      $sql_rev_avg = "SELECT AVG(score) FROM review WHERE course_id='$_GET[courseid]' AND section_id='$_GET[sectionid]' AND semester='$_GET[semester]' AND year='$_GET[year]'";

      $res_rev=mysql_query($sql_rev);
      $res_rev_cnt=mysql_query($sql_rev_cnt);
      $res_rev_avg=mysql_query($sql_rev_avg);

      $rev_num=mysql_fetch_array($res_rev_cnt);
      $rev_avg=mysql_fetch_array($res_rev_avg);

			
		?>
		<div class="menu" id="menu"><?php include_once('menu.php'); ?></div>
		<div class="courseinfo" id="courseinfo">
			<table width="800" border="0" align="center" cellpadding="5" cellspacing="1">
				<tr>
					<td>과목명:</td>
					<td><?php echo$rs['title'] ?></td>
          <td>교수명:</td>
          <td>
            <?php 
              for($i=0; $i<$num['COUNT(title)']; $i++){
                echo$rs['name']," ";
                if($i != $num['COUNT(title)'] - 1){
                  $rs=pg_fetch_array($res);
                }
              }
            ?>
          </td>
          <td>학수번호:</td>
          <td><?php echo$rs['course_id']; ?></td>
				</tr>
        <tr>
          <td>년도:</td>
          <td><?php echo$rs['year']; ?></td>
          <td>학기:</td>
          <td><?php echo$rs['semester']; ?></td>
          <td>학점:</td>
          <td><?php echo$rs['credits']; ?></td>
        </tr>
        <tr>
          <td>강의소감평균점수:</td>
          <td><?php $sc=round($rev_avg['AVG(score)'], 2); echo$sc ?></td>
          <th colspan='4'>
            <form action="write_review.php?courseid=<?php echo$rs['course_id']; ?>&sectionid=<?php echo$rs['section_id']; ?>&semester=<?php echo$rs['semester']; ?>&year=<?php echo$rs['year']; ?>" method="post" name="write_form" id="write_form" style="margin:0px;">
             <input type="submit" name="Submit" style="height:3em; width:10em;" value="수강소감작성하기"></input>
            </form>
          </th>
        </tr>
			</table>
		</div>
		<div class="reviewlist" id="reviewlist">
      <?php
        for($i=0; $i<$rev_num['COUNT(review_id)']; $i++){
          $rev_rs=mysql_fetch_array($res_rev);

          echo"<div style='border:1px dashed; margin-bottom:5px; padding:5px; background-color:white;'><table><tr><td>작성자:</td><td>{$rev_rs['account_id']}</td></tr>";
          echo"<tr><td>글번호:</td><td>{$rev_rs['review_id']}</td></tr>";
          echo"<tr><td>작성일:</td><td>{$rev_rs['date']}</td></tr>";
          echo"<tr><td>점수:</td><td>{$rev_rs['score']}</td></tr>";
          echo"<tr><th colspan='2'>{$rev_rs['text']}</th></tr>";

          echo"</table><br></div>";

        }

      ?>
    </div>
	</body>
</html>