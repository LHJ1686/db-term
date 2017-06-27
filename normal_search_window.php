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
  	div.normal-search{
  		margin-left:17%;
  		height:60px;
  		width:70%;
  		padding:5px;
  		background-color:#B0D0D6;
  	}
  	div.searchres{
  		margin-left:17%;
  		margin-top:10px;
  		height:700px;
  		width:70%;
  		padding:5px;
  		background-color:#E6FFFF;
  	}
    .thickline{
      border-bottom: 2px solid black;
    }
    .bottomline{
      border-bottom: 1px solid black;
    }
  </style>
</head>
<body>
	<div class="menu" id="menu"><?php include_once('menu.php'); ?></div>
	<div class="normal-search" id="normal-search" align="center">
		<form action="normal_search_window.php" method="get" name="normal-search-form" id="normal-search-form">
      <input name="searchbox" id="searchbox" type="text" size="20" style="border:3px #333333 solid;width:200px; height:30px;">
      <input type="submit" name="Submit" style="height:3em; width:7em;" value="검색"></input> 
    </form>
	</div>
	<div class="searchres" id="searchres">
		<?php
  if(isset($_GET['searchbox'])){
    $sql_sec="SELECT * FROM section NATURAL JOIN course WHERE title LIKE '%{$_GET['searchbox']}%'";
    $sql_cnt="SELECT COUNT(title) FROM section NATURAL JOIN course WHERE title LIKE '%{$_GET['searchbox']}%'";

    $res=mysql_query($sql_sec);
    $num=mysql_query($sql_cnt);
    
    $num=mysql_fetch_array($num);
  }

  ?>
  <table width="700" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td class="thickline"><strong>열람</strong></td>
      <td class="thickline"><strong>과목명</strong></td>
      <td class="thickline"><strong>교수</strong></td>
      <td class="thickline"><strong>학수번호</strong></td>
      <td class="thickline"><strong>분반</strong></td>
      <td class="thickline"><strong>년도</strong></td>
      <td class="thickline"><strong>학기</strong></td>
    </tr>

    <?php
    if(isset($_GET['searchbox'])){
      for($i=0; $i<$num['COUNT(title)'] ;$i++){
        $rs=mysql_fetch_array($res);

        $sql_ins="SELECT * FROM teaches NATURAL JOIN instructor WHERE course_id='$rs[course_id]' AND section_id=$rs[section_id] AND semester=$rs[semester] AND year=$rs[year]";
        $sql_ins_cnt="SELECT COUNT(inst_id) FROM teaches NATURAL JOIN instructor WHERE course_id='$rs[course_id]' AND section_id=$rs[section_id] AND semester=$rs[semester] AND year=$rs[year]";

        $ins_res=mysql_query($sql_ins);
        $ins_num=mysql_query($sql_ins_cnt);

        $ri=mysql_fetch_array($ins_res);
        $ins_num=mysql_fetch_array($ins_num);

        if($ins_num['COUNT(inst_id)'] >= 2){
          $tmp_num = $ins_num['COUNT(inst_id)'] - 1;
          echo"<div><tr><td class='bottomline'><a href='course_info.php?courseid={$rs['course_id']}&sectionid={$rs['section_id']}&semester={$rs['semester']}&year={$rs['year']}'>■</a></td><td class='bottomline'>{$rs['title']}</td><td class='bottomline'>{$ri['name']} 외 {$tmp_num}명</td><td class='bottomline'>{$rs['course_id']}</td><td class='bottomline'>{$rs['section_id']}</td><td class='bottomline'>{$rs['year']}</td><td class='bottomline'>{$rs['semester']}</td></tr></div>";
        }else{
          echo"<div><tr><td class='bottomline'><a href='course_info.php?courseid={$rs['course_id']}&sectionid={$rs['section_id']}&semester={$rs['semester']}&year={$rs['year']}'>■</a></td><td class='bottomline'>{$rs['title']}</td><td class='bottomline'>{$ri['name']}</td><td class='bottomline'>{$rs['course_id']}</td><td class='bottomline'>{$rs['section_id']}</td><td class='bottomline'>{$rs['year']}</td><td class='bottomline'>{$rs['semester']}</td></tr></div>";
        }
      }
    }
    ?>
  </table>
	</div>
</body>