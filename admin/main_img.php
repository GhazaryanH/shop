<?php
require 'sql.php';
$pr_id = $_SESSION['id'];
$id =  $_POST['id'];
$query = mysqli_query($conn, "select * from imgs where id ='$id'");
$arr = mysqli_fetch_array($query);
if($arr['num'] == 1) {
    mysqli_query($conn, "update imgs set num = 0 where id = '$id'");
    echo 1;
}else{
    mysqli_query($conn, "update imgs set num = 0 where pr_id = '$pr_id'");
    mysqli_query($conn, "update imgs set num = 1 where id = '$id'");
    echo 2;
}