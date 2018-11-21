<?php
	require_once('./dbconfig.php');
	
	if(!($_SESSION['userid'] == 'admin' && $_SESSION[] == 77))
	{
		?>
		<script>
			alert('이 페이지에 대한 권한이 없습니다.');
			history.back();
		</script>

<?php
    }
	   
	$sql = 'select * from user where authority = 1';
	
	$result = $db->query($sql);


?>


<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>유저 관리 페이지</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">

		<h3>아프니까 병원이다</h3>

		<table>

			<caption class="readHide"> 유저 관리 페이지</caption>

			<thead>

				<tr>
					<th scope="col" class="userid">ID</th>

					<th scope="col" class="name">이름</th>

					<th scope="col" class="gender">성별</th>
					
					<th scope="col" class="autho">권한</th>
					
					<th scope="col" class="autho_updown">권한 변경</th>

				</tr>

			</thead>
			<script>
				function admin(user_id){
					<?php
						$userid = "<script>document.write(user_id);</script>";
						echo "$userid";
						$sql1 = 'update user set autority = 77 where user_id = '.$userid;
						$result1 = $db -> query($sql1);
					?>
					alert("권한이 변경이 되었습니다.");
					location.reload();
				}
				
				function user(user_id){
					<?php
						$userid = "<script>document.write(user_id);</script>";
						echo "$userid";
						$sql1 = 'update user set autority = 1 where user_id = '.$userid;
						$result1 = $db -> query($sql1);
					?>
					alert("권한이 변경이 되었습니다.");
					location.reload();
				}
				
			
			</script>
			
			
			<tbody>
			<?php
			
						
						
								while($row = $result->fetch_assoc()){
									
									echo "<html>
											<body> 
												<tr>
													<td class = 'userid'>$row['user_id']</td>
													<td class = 'name'> $row['Name']</td>
													<td class = 'gender'>$row['Gender'] </td>
													<td class = 'autho'>$row['authority'] </td>
													<td class = 'autho_updown'> 
													<INPUT type = 'BUTTON' value = '관리자 권한' onclick = 'admin($row['user_id'])'>
													<INPUT type = 'BUTTON' value = '사용자 권한' onclick = 'user($row['user_id'])'>
													</td>
												</tr>
											</body>
										</html>";
						
								};
							
			?>
				</tbody>

		</table>
			
	</article>

</body>

</html>
			