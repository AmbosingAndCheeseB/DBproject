<?php   
include "dbconfig.php";
session_start();
?>

<!DOCTYPE html>
<head>
	<title>메인페이지</title>
	<link rel= "stylesheet" href="css/searchbox.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div id="login_box">	
	
	<?php
	
	if(!$_SESSION['is_login']){
		echo '	<html><body> <form method="post" action="login_ok.php">
				<table align="right" border="0" cellspacing="0" width="300">
        			<tr>
            			<td width="130" colspan="1"> 
                		<input type="text" name="userid" class="inph" required>
            		</td>
            		<td rowspan="2" align="center" width="100" > 
                		<button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
        		<tr>
            		<td width="130" colspan="1"> 
               		<input type="password" name="userpw" class="inph" required>
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
		
			echo '	<html><body> <table align="right" border="0" cellspacing="0" width="300">';
			echo $_SESSION['nickname'];
			echo '님 환영합니다!<br/>';
			
		if($_SESSION['authority']==77){
			echo '<a href="./hospital_info.php">병원정보 수정</a>';
			if($_SESSION['userid']=='admin'){
				echo '<a href="./user_manage.php"><br>관리자 페이지</a>';
			}
		}
		echo '<br>
		<a href="./logout.php">로그아웃</a>
		</table> </body></html>';
	}
	
 ?>
  
</div>

	<div id="searchbox" class="container">						
			<form method="get" action="search_result.php" class = "Search">
				<select name="searchColumn" class="select">
					<option value="h_name" selected="selected">병원이름/진료과목</option>
					<option value="h_symptom">증상/내용</option>
				</select>
                <input type="text" name="search" class="Search-box" autocomplete="off">
					<button id="sr" class="Search-label" for="Search-box"><i class="fa fa-search"></i></button>
  </form>
</div>

<div id="gotoboard">						
			<form method="post" action="board.php">
				<table align="left" border="0" cellspacing="0" width="300">
        			<tr>
            		<td rowspan="2" align="center" width="100" >
                		<button type="submit" id="btn" >게시판</button>
            		</td>
        		</tr>
    </table>
  </form>
</div>
	
		<div id="map" style="margin:200px auto; width:500px;height:400px;"></div>
	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f722b2f37d3075fced8b4fa988359be7"></script>
	<script>
		var container = document.getElementById('map');
		var options = {
			center: new daum.maps.LatLng(33.450701, 126.570667),
			level: 3
		};

		var map = new daum.maps.Map(container, options);
	</script>

</body>
</html>