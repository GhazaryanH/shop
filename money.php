<?php   require 'sql.php';
session_start();
$val = $_POST['val'];
$log = $_SESSION['login'];
$money = mysqli_fetch_array(mysqli_query($conn, "select * from users where log = '$log'"))['cash'];
$money = $val + $money;
mysqli_query($conn, "update users set cash ='$money' where log = '$log'");
echo $money;