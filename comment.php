<?php

	$sql = 'select * from comment where c_num=depth and board_num=' . $bNo;

	$result = $db->query($sql);

?>

<div id="commentView">

	<form action="comment_update.php" method="post">

		<input type="hidden" name="board_num" value="<?php echo $bNo?>">

	<?php

		while($row = $result->fetch_assoc()) {

	?>

	<ul class="oneDepth">

		<li>
			<div id="c_<?php echo $row['c_num']?>" class="commentSet">

						<div class="commentInfo">

							<div class="commentId">작성자: <span class="user_id"><?php echo $row['user_id']?></span></div>

							<div class="commentBtn">

								<a href="#" class="comt write">댓글</a>

								<a href="#" class="comt modify">수정</a>

								<a href="#" class="comt delete">삭제</a>

							</div>

						</div>

					<div class="commentContent"><?php echo $row['c_content']?></div>

				</div>

			<div>

				<span>작성자: <?php echo $row['user_id']?></span>

				<p><?php echo $row['c_content']?></p>

			</div>

			<?php

				$sql2 = 'select * from comment where c_num!=depth and depth=' . $row['c_num'];

				$result2 = $db->query($sql2);

			

				while($row2 = $result2->fetch_assoc()) {

			?>

			<ul class="twoDepth">

				<li>
				
					<div id="c_<?php echo $row2['c_num']?>" class="commentSet">

							<div class="commentInfo">

								<div class="commentId">작성자:  <span class="coId"><?php echo $row2['user_id']?></span></div>

								<div class="commentBtn">

									<a href="#" class="comt modify">수정</a>

									<a href="#" class="comt delete">삭제</a>

								</div>

							</div>

							<div class="commentContent"><?php echo $row2['c_content'] ?></div>

						</div>	

					<div>

						<span>작성자: <?php echo $row2['user_id']?></span>

						<p><?php echo $row2['c_content'] ?></p>

					</div>

				</li>

			</ul>

			<?php

				}

			?>

		</li>

	</ul>

	<?php } ?>
	
	</form>

</div>


<form action="comment_update.php" method="post">

	<input type="hidden" name="board_num" value="<?php echo $bNo?>">

	<table>

		<tbody>

			<tr>

				<th scope="row"><label for="user_id">아이디</label></th>

				<td><input type="text" name="user_id" id="user_id"></td>

			</tr>

			<tr>

				<th scope="row">

			<label for="c_password">비밀번호</label></th>

				<td><input type="password" name="c_password" id="c_password"></td>

			</tr>

			<tr>

				<th scope="row"><label for="c_content">내용</label></th>

				<td><textarea name="c_content" id="c_content"></textarea></td>

			</tr>

		</tbody>

	</table>

	<div class="btnSet">

		<input type="submit" value="코멘트 작성">

	</div>

</form>

<script>

	$(document).ready(function () {

		var action = '';



		$('#commentView').delegate('.comt', 'click', function () {

			//현재 위치에서 가장 가까운 commentSet 클래스를 변수에 넣는다.

			var thisParent = $(this).parents('.commentSet');



			//현재 작성 내용을 변수에 넣고, active 클래스 추가.

			var commentSet = thisParent.html();

			thisParent.addClass('active');

			

			//취소 버튼

			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';

				

			//버튼 삭제 & 추가

			$('.comt').hide();

			$(this).parents('.commentBtn').append(commentBtn);

			

			

			//commentInfo의 ID를 가져온다.

			var c_num = thisParent.attr('id');

			

			//전체 길이에서 3("co_")를 뺀 나머지가 co_no

			c_num = c_num.substr(3, c_num.length);

			

			//변수 초기화

			var comment = '';

			var user_id = '';

			var c_Content = '';

			

			if($(this).hasClass('write')) {

				//댓글 쓰기

				action = 'w';

				//ID 영역 출력

				user_id = '<input type="text" name="user_id" id="user_id">';

			

			} else if($(this).hasClass('modify')) {

				//댓글 수정

				action = 'u';				

				

				user_id = thisParent.find('.user_id').text();

				var c_content = thisParent.find('.commentContent').text();

				

			} else if($(this).hasClass('delete')) {

				//댓글 삭제	

				action = 'd';

			}

			

				comment += '<div class="writeComment">';

				comment += '	<input type="hidden" name="w" value="' + action + '">';

				comment += '	<input type="hidden" name="c_num" value="' + c_num + '">';

				comment += '	<table>';

				comment += '		<tbody>';

				if(action !== 'd') {

					comment += '			<tr>';

					comment += '				<th scope="row"><label for="user_id">아이디</label></th>';

					comment += '				<td>' + user_id + '</td>';

					comment += '			</tr>';

				}

				comment += '			<tr>';

				comment += '				<th scope="row">';

				comment += '			<label for="c_password">비밀번호</label></th>';

				comment += '				<td><input type="password" name="c_password" id="c_password"></td>';

				comment += '			</tr>';				

				if(action !== 'd') {

					comment += '			<tr>';

					comment += '				<th scope="row"><label for="c_content">내용</label></th>';

					comment += '				<td><textarea name="c_content" id="c_content">' + c_content + '</textarea></td>';

					comment += '			</tr>';

				}

				comment += '		</tbody>';

				comment += '	</table>';

				comment += '	<div class="btnSet">';

				comment += '		<input type="submit" value="확인">';

				comment += '	</div>';

				comment += '</div>';

			

				thisParent.after(comment);

			return false;

		});

		

		$('#commentView').delegate(".cancel", "click", function () {

				$('.writeComment').remove();

				$('.commentSet.active').removeClass('active');

				$('.addComt').remove();

				$('.comt').show();

			return false;

		});

	});

</script>