<?php
session_start();
$id = $_POST['id'];
$_SESSION['order'] = array_diff($_SESSION['order'], [$id]);
if($id != 0 && count($_SESSION['order']) != 0){
    $_SESSION['total'] = $_SESSION['total'] - $_SESSION['price'][$id];
    echo $_SESSION['total'];
}else {
    unset($_SESSION['price'], $_SESSION['count'], $_SESSION['total'], $_SESSION['show'], $_SESSION['order']);
    echo 'all';
}