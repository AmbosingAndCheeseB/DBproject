<?php
	include "dbconfig.php";

	$id = $_POST['userid'];
	$pw = $_POST['userpw'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];

	if($id == "" | $pw == "" | $name == "" | $sex == ""){
		echo '<script> alert("모든 항목을 입력하세요."); history.back(); </script>';
	}
	else{
		$sql = 'select * from user where user_id="'.$id.'"';
		$result = $db->query($sql);
		if($member = $result->fetch_array()){
			echo "<script>alert('이미 존재하는 아이디입니다.'); history.back(); </script>";
			}
		else{
			$sql = 'insert into user (user_id, password, Name, Gender, authority) values("' . $id . '", "' . $pw . '", "' . $name . '", "' . $sex . '",1)';
			$result = $db->query($sql);
			echo "<script>alert('회원가입이 완료되었습니다.');</script>";
			echo "<meta http-equiv='refresh' content='0 url=/termprj/s201615383/main_out.php'>";
		}
	}
?>