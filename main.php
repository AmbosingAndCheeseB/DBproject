<?php   
include "dbconfig.php";
session_start();
?>

<!DOCTYPE html>
<head>
	<title>메인페이지</title>
</head>
<body>
	<div id="login_box">	
	
	<?php
	
	if(!$_SESSION['is_login']){
		echo '	<html><body> <form method="post" action="login_ok.php">
				<table align="right" border="0" cellspacing="0" width="300">
        			<tr>
            			<td width="130" colspan="1"> 
                		<input type="text" name="userid" class="inph">
            		</td>
            		<td rowspan="2" align="center" width="100" > 
                		<button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
        		<tr>
            		<td width="130" colspan="1"> 
               		<input type="password" name="userpw" class="inph">
            	</td>
        	</tr>
        	<tr>
           		<td colspan="3" align="center" class="mem"> 
              	<a href="signup.php">회원가입 하시겠습니까?</a>
           </td>
        </tr>
    </table>
	</form> </body></html>'; }
	
	else if($_SESSION['is_login']){
		
		if($_SESSION['authority']==77){
			echo '	<html><body> <table align="right" border="0" cellspacing="0" width="300">';
			echo $_SESSION['nickname'];
			echo '님 환영합니다!<br/>
				<a href="./user_manage.php">관리자 페이지</a>
				<br>
				<a href="./logout.php">로그아웃</a>
			</table> </body></html>';
		}
		else{
			echo '	<html><body> <table align="right" border="0" cellspacing="0" width="300">';
			echo $_SESSION['nickname'];
			echo '님 환영합니다!<br/>
				<a href="./logout.php">로그아웃</a>
			</table> </body></html>';}
		
	}
	
  ?>
  
</div>

	<div id="searchbox">						
			<form method="get" action="search_result.php">
				<table align="center" border="0" cellspacing="0" width="300">
        			<tr>
            			<td width="130" colspan="1">
						<select name="searchColumn">
							<option value="h_name" selected="selected">병원이름/진료과목</option>
							<option value="h_symptom">증상/내용</option>
						</select>
                		<input type="text" name="search" class="inph">
            		</td>
            		<td rowspan="2" align="center" width="100" >
                		<button type="submit" id="btn" >검색</button>
            		</td>
        		</tr>
    </table>
  </form>
</div>

<div id="gotoboard">						
			<form method="post" action="board.php">
				<table align="left" border="0" cellspacing="0" width="300">
        			<tr>
            		<td rowspan="2" align="center" width="100" >
                		<button type="submit" id="btn" >게시판으로</button>
            		</td>
        		</tr>
    </table>
  </form>
</div>

</body>
</html>