<?php
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	session_destroy();
	echo "<script>alert('로그아웃 하였습니다.'); location.href='../index.php';</script>";
?>