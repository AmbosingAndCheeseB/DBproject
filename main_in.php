<?php   
include "dbconfig.php";
session_start();
if(!$_SESSION['is_login']){
	echo "<script>location.href='main_out.php';</script>";
}
?>
<!DOCTYPE html>
<head>
	<title>로그인 후 메인페이지</title>
</head>
<body>
	<div id="logout_box">							
		<table align="right" border="0" cellspacing="0" width="300">
			<?php echo $_SESSION['nickname'];?>님<br/>
			<a href="./logout.php">로그아웃</a>
    </table>
  </form>
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