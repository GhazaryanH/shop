<?php require 'sql.php';
session_start();
$log = $_SESSION['login'];
$total = $_SESSION['total'];
$money = mysqli_fetch_array(mysqli_query($conn, "select * from users where log = '$log'"))['cash'];
if($money < $total){
    echo 'money';
}else{
    $money = $money - $total;
    mysqli_query($conn, "update users set cash ='$money' where log = '$log'");
    unset($_SESSION['price'], $_SESSION['count'], $_SESSION['total'], $_SESSION['show'], $_SESSION['order']);
    echo $money;
}
