<?php
include_once("session.php");

if($session_userid!=""){
  echo"<script>location.replace('normal_search_window.php');</script>";
  die;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"></meta>
  <title>login</title>
</head>
<body>
  <form action="login_engine.php" method="post" name="login_form" id="login_form"
        style="margin:0px;" onSubmit="return checkForm(this.form);">
    <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td width="195" align="right" bgcolor="#BDBDBD">
          &nbsp; &nbsp;
          <font>■</font>
          &nbsp;아이디
        </td>
        <td width="282" bgcolor="#E8E8E8">
          <input name="userid" id="userid"
                 type="text" size="20"
                 style="border:1px #333333 solid;
                 width:100px; height:20px;">
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#BDBDBD">
          &nbsp;&nbsp;<font>■</font>
          &nbsp;비밀번호
        </td>
        <td bgcolor="#E8E8E8">
          <input name="password" id="password"
                 type="password" size="20"
                 style="border:1px #333333 solid;
                 width:100px;height:20px;"
        </td>
      </tr>
    </table>
    <br>
      <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0"
             bgcolor="#BDBDBD" style="border:0px #333333 solid;border-bottom-width:3px">
        <tr>
          <td align="center">
            <input type="submit" name="Submit" value="로그인"></input>
          </td>
        </tr>
        
      </table>
    
    
  </form>

  <script>
    function checkForm(theForm){
      if(theForm.userid.value==""){
        alert("아이디를 입력하십시오.");
        theForm.userid.focus();
        return false;
      }else{
        return true;
      }
    }
  </script>
  
</body>
</html>