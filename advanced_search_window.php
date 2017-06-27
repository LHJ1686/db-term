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
  	div.advanced-search{
  		margin-left:17%;
  		height:150px;
  		width:70%;
  		padding:5px;
  		background-color:#B0D0D6;
  	}
  	div.search-result{
  		margin-left:17%;
  		margin-top:10px;
  		height:620px;
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
	<div class="advanced-search" id="advanced-search" align="center">
		<form action="advanced_search_window.php" method="get" name="advanced-search-form" id="advanced-search-form">
      <table>
        <tr>
          <td>강의명</td>
          <td><input name="coursetitle" id="coursetitle" type="text" size="20" style="border:3px #333333 solid;width:200px; height:30px;"></td>
          <td>교수명</td>
          <td><input name="profname" id="profname" type="text" size="20" style="border:3px #333333 solid;width:200px; height:30px;"></td>
        </tr>
        <tr>
          <td>학수번호</td>
          <td><input name="courseid" id="courseid" type="text" size="20" style="border:3px #333333 solid;width:200px; height:30px;"></td>
          <td>년도</td>
          <td>
            <select name="year">
              <option value="-">-</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
              <option value="2014">2014</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>학기</td>
          <td>
            <select name="semester">
              <option value="-">-</option>
              <option value="01">01</option>
              <option value="02">02</option>
            </select>
          </td>
          <th colspan='2'>
            <input type="submit" name="Submit" style="height:3em; width:7em;" value="검색"></input> 
          </th>
        </tr>
      </table>
    </form>
	</div>
	<div class="search-result" id="search-result">
		<?php
    if(isset($_GET['coursetitle'])){
    if($_GET['coursetitle']!="" || $_GET['profname']!="" || $_GET['courseid']!="" || $_GET['year']!="-" || $_GET['semester']!="-"){
      $sql_sec="SELECT title, course_id, year, semester, section_id FROM instructor natural join teaches natural join section natural join course WHERE";
      $sql_cnt="SELECT COUNT(title) FROM instructor natural join teaches natural join section natural join course WHERE";
      $isfirst = 0;

      if($_GET['coursetitle']!=""){
        if($isfirst == 1){$sql_sec .= " AND"; $sql_cnt .= " AND";}
        $isfirst = 1;
        $sql_sec .= " title LIKE '%$_GET[coursetitle]%'";
        $sql_cnt .= " title LIKE '%$_GET[coursetitle]%'";
      }

      if($_GET['profname']!=""){
        if($isfirst == 1){$sql_sec .= " AND"; $sql_cnt .= " AND";}
        $isfirst = 1;
        $sql_sec .= " name LIKE '%$_GET[profname]%'";
        $sql_cnt .= " name LIKE '%$_GET[profname]%'";
      }

      if($_GET['courseid']!=""){
        if($isfirst == 1){$sql_sec .= " AND"; $sql_cnt .= " AND";}
        $isfirst = 1;
        $sql_sec .= " course_id='$_GET[courseid]'";
        $sql_cnt .= " course_id='$_GET[courseid]'";
      }

      if($_GET['year']!="-"){
        if($isfirst == 1){$sql_sec .= " AND"; $sql_cnt .= " AND";}
        $isfirst = 1;
        $sql_sec .= " year='$_GET[year]'";
        $sql_cnt .= " year='$_GET[year]'";
      }

      if($_GET['semester']!="-"){
        if($isfirst == 1){$sql_sec .= " AND"; $sql_cnt .= " AND";}
        $isfirst = 1;
        $sql_sec .= " semester='$_GET[semester]'";
        $sql_cnt .= " semester='$_GET[semester]'";
      }

      $res=mysql_query($sql_sec);
      $num=mysql_query($sql_cnt);
      $num=mysql_fetch_array($num);
    }
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
    if(isset($_GET['coursetitle'])){
    if($_GET['coursetitle']!="" || $_GET['profname']!="" || $_GET['courseid']!="" || $_GET['year']!="-" || $_GET['semester']!="-"){
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
    }
    ?>
  </table>
	</div>
</body>