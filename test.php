<?
$num1 = 1;
$num2 = 5;

echo "나는 성연몬이다아앙!!!!! 나는 응가쟁이다!! <br><br>";
echo "num1 = $num1<br>";
echo "num2 = $num2<br><br>";

function sum($n1, $n2)
{
	return $n1 + $n2;
}

$sum = sum($num1, $num2);

echo "num1 + num2 = $sum<br>";




$db_server = '210.117.181.21';
$db_account = 's201655082';
$db_password = 'database1!';
$db_database = 's201655082';

$connect = mysqli_connect($db_server, $db_account, $db_password);

if($connect)
{
	echo "mysql 서버와 연결되었습니다.<br>";
	echo "<hr>";
}
else
{
	echo "<hr>";
	echo "mysql 접속 실패";
}

$db = mysqli_select_db($connect, $db_database);

if($db)
{
	echo "데이터베이스 선택 성공";
	echo "<hr>";
}
else
{
	echo "<hr>";
	echo "데이터베이스 선택 실패";
}

mysqli_close($connect);
?>
