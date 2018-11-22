<?php
	require_once('./dbconfig.php');

	session_start();


	if(($_SESSION['userid'] != 'admin' || $_SESSION['authority'] != 77))
	{
		?>
		<script>
			alert('이 페이지에 대한 권한이 없습니다.');
			history.back();
		</script>

<?php
    }
	   
	$sql = 'select * from user where user_id != "admin"';
	
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
			
			
			
			
			<tbody>
			<?php
			
						
						
								while($row = $result->fetch_assoc()){

									?>
									<html>

									
									<html>

											<body> 
												<tr>
													<td class = 'userid'><?php echo $row['user_id']; ?></td>
													<td class = 'name'> <?php echo $row['Name']; ?></td>
													<td class = 'gender'> <?php echo $row['Gender']; ?> </td>
													<td class = 'autho'> <?php 
																				if($row['authority']== 77)
																				{
																					echo "관리자 권한";
																				}
																				else
																				{
																					echo "사용자 권한";
																				}
																					
																					?> </td>
													<td class = 'autho_updown'>
													<form name = "auto_update1" method ="post" action = "autho_up.php?user_id=<?php echo $row['user_id'];?>">
														<button type="submit" id="btn1" >관리자 권한</button>
													</form>
													<form name = "auto_update2" method ="post" action = "autho_down.php?user_id=<?php echo $row['user_id'];?>">
														<button type="submit" id="btn2" >사용자 권한</button>
													</form>
												
													
													</td>
												</tr>
											</body>

										</html>
						<?php

										
						

								};
							
			?>
				</tbody>

		</table>
			
	</article>

</body>

</html>
			