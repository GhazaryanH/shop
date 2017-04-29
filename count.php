<?php   require 'sql.php';
session_start();
$id = $_POST['id'];
$count = $_POST['count'];
$price = mysqli_fetch_array(mysqli_query($conn, "select * from products where id = '$id'"))['price'];
$new_price = $price * $count;
if(!isset($_SESSION['price'][$id])){
    $old_price = $price;
}else{
    $old_price = $_SESSION['price'][$id];
}
Class prc {}
$_SESSION['count'][$id] = $count;
$prc['total'] = $_SESSION['total'] = $_SESSION['total'] - $old_price + $new_price;
$prc['this'] = $_SESSION['price'][$id] = $new_price;
echo json_encode($prc);