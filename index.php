<?php   
include "code/dbconfig.php";
session_start();
?>

<!DOCTYPE html>
<head>
	<title>메인페이지</title>
	<link rel= "stylesheet" href="css/searchbox.css">
	<link rel= "stylesheet" href="css/login.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div id="login_box" class="wrapper">
	
	<?php
	
	if(!$_SESSION['is_login']){
		echo '	<html><body>
				<form method="post" action="code/login_ok.php" class="form-signin">
				
		 		<h2 class="form-signin-heading">Please login</h2>
                <input type="text" name="userid" class="form-control" placeholder="ID" required>
				
               	<input type="password" name="userpw" class="form-control" placeholder="Password" required>
				
				<label class="checkbox">
        		<a href="code/signup.php">회원가입 하시겠습니까?</a> </label>
				
				<button type="submit" id="btn" class="btn btn-lg btn-primary btn-block" >로그인</button>
				
				</form> </body></html>'; }
	
	else if($_SESSION['is_login']){
		
			echo '	<html><body> <table align="right" border="0" cellspacing="0" width="300">';
			echo $_SESSION['nickname'];
			echo '님 환영합니다!<br/>';
			
		if($_SESSION['authority']==77){
			echo '<a href="code/hospital_info.php">병원정보 수정</a>';
			if($_SESSION['userid']=='admin'){
				echo '<a href="code/user_manage.php"><br>관리자 페이지</a>';
			}
		}
		echo '<br>
		<a href="code/logout.php">로그아웃</a>
		</table> </body></html>';
	}
	
 ?>
</div>
		
<div id="searchbox" class="container">
	<form method="get" action="code/search_result.php" class = "Search">
	
      <select name="searchColumn" class="select">
        <option value="h_name" selected="selected">병원이름/진료과목</option>
        <option value="h_symptom">증상/내용</option>
      </select>
      <button id="sr" class="Search-label" for="Search-box"><i class="fa fa-search"></i></button>
      <input type="text" name="search" class="Search-box" autocomplete="off">
    </form>
</div>


<div id="gotoboard">						
			<form method="post" action="code/board.php">
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