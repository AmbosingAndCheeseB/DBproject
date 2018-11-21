<?php	
	include "dbconfig.php";
	session_start();
	//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($_POST["userid"] == "" || $_POST["userpw"] == ""){
		echo '<script> alert("아이디와 패스워드를 입력하세요"); history.back(); </script>';
	}else{

	//password변수에 POST로 받아온 값을 저장하고 sql문으로 POST로 받아온 아이디값을 찾습니다.
	$password = $_POST['userpw'];
	$sql = 'select * from user where user_id = "'.$_POST['userid'].'" ';
	$result = $db->query($sql);
	$member = $result->fetch_array();
	$hash_pw = $member['password']; //$hash_pw에 POST로 받아온 아이디열의 비밀번호를 저장합니다. 

	if($password == $hash_pw) //만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운후 main.php파일로 넘어갑니다.
	{
		$_SESSION['userid'] = $member["user_id"];
		$_SESSION['nickname'] = $member["Name"];
		$_SESSION['authority'] = $member["authority"]
		$_SESSION['is_login'] = true;
		
		echo "<script>alert('로그인되었습니다.'); location.href='main_in.php';</script>";
	}else{ // 비밀번호가 같지 않다면 알림창을 띄우고 전 페이지로 돌아갑니다
		echo "<script>alert('아이디 혹은 비밀번호가 일치하지 않습니다.'); history.back();</script>";
	}
}
?>