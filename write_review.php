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
  	div.writereview{
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
                  $rs=mysql_fetch_array($res);
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
			</table>
		</div>
		<div class="writereview" id="writereview">
      <form action="write_engine.php" method="get" name="write_form" id="write_form" style="margin:0px;">
      <?php
        echo"<input type='hidden' name='courseid' value={$rs['course_id']} />";
        echo"<input type='hidden' name='sectionid' value={$rs['section_id']} />";
        echo"<input type='hidden' name='semester' value={$rs['semester']} />";
        echo"<input type='hidden' name='year' value={$rs['year']} />";
      ?>
      <ul style="list-style-type:none">
      <li>
        추천점수:
        <select name="score">
          <option value="5">5</option>
          <option value="4">4</option>
          <option value="3">3</option>
          <option value="2">2</option>
          <option value="1">1</option>
          <option value="0">0</option>
        </select>
        </li>
        <br>
        <li>
        <textarea name="review" rows="18" cols="90">소감을 작성해주세요</textarea>
        </li>
        <br>
        <li>
        <input type="submit" name="Submit" value="확인"></input>
        <button type="button" onclick="cancel()">취소</button>
        </li>
        </ul>
      </form>
    </div>
    <?php
      $link="course_info.php?courseid={$rs['course_id']}&sectionid={$rs['section_id']}&semester={$rs['semester']}&year={$rs['year']}";
      echo"<script>function cancel(){location.replace('", $link, "')};</script>";
    ?>
	</body>
</html>