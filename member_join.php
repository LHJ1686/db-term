<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"></meta>
    <title>회원 가입</title>
    <script>
    function checkForm(theForm){
      if(theForm.userid.value.length==0){
        alert("아이디를 입력하십시오.");
        theForm.userid.focus();
        return false;
      }
      else if(theForm.nickname.value.length==0){
        alert("닉네임을 입력하십시오.");
        theForm.password.focus();
        return false;
      }
      else if(theForm.password.value.length==0){
        alert("비밀번호를 입력하십시오.");
        theForm.password.focus();
        return false;
      }
      else if(theForm.password.value!=theForm.password2.value){
          alert("비밀번호는 같아야 합니다.");
          theForm.password2.focus();
          return false;
      }
      else{
        return true;
      }
    }
    </script>
    </head>
    
    <body>
        <p align=center><font size=15>회원 가입</font></p>
         
        <form name="member_form" action="./insert_engine.php" method="post" onSubmit="return checkForm(this)">
            <table border=1 width=700 align=center cellspacing=0 cellpadding="3">
                <tr>
                    <td width="696" colspan="2" bgcolor="blue">&nbsp;<font color="white">
                    <b>회원가입</b></font></td>
                </tr>
                <tr>
                    <td width="125"><p align="right">아이디 :</p></td>
                    <td width="569"><input type="text" name="userid" size="20"></td>
                </tr>
                <tr>
                    <td width="125"><p align="right">닉네임 :</p></td>
                    <td width="569"><input type="text" name="nickname" size="20"></td>
                </tr>
                <tr>
                    <td width="125"><p align="right">비밀번호 :</p></td>
                    <td width="569"><input type="password" name="password" size="20"></td>
                </tr>
                <tr>
                    <td width="125"><p align="right">비밀번호 확인</p></td>
                    <td width="569"><input type="password" name="password2" size="20"></td>
                </tr>
                <tr>
                    <td width="696" colspan="2"><p align="center">
                        <input type="submit" name="submit" value="가입">
                        <input type="button" name="cancel" class="ahnbutton" value="취소"
                            onMouseOver="goLite(this.form.name,this.name)"
                            onMouseOut="goDim(this.form.name,this.name)"
                            onClick="location.href='login.php'"></input>
                    </p></td>
                </tr>
            </table>
        </form>
    </body>
</html>