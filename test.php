<?
$num1 = 1;
$num2 = 5;

echo "���� �������̴پƾ�!!!!! ���� �������̴�!! <br><br>";
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
	echo "mysql ������ ����Ǿ����ϴ�.<br>";
	echo "<hr>";
}
else
{
	echo "<hr>";
	echo "mysql ���� ����";
}

$db = mysqli_select_db($connect, $db_database);

if($db)
{
	echo "�����ͺ��̽� ���� ����";
	echo "<hr>";
}
else
{
	echo "<hr>";
	echo "�����ͺ��̽� ���� ����";
}

mysqli_close($connect);
?>
