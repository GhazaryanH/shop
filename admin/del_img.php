<?php
require 'sql.php';
$id =  $_POST['id'];
$query = mysqli_query($conn, "select * from imgs where id = '$id'");
$arr = mysqli_fetch_array($query);
mysqli_query($conn, "delete from imgs where id = '$id'");
unlink('../images/'.$arr['pr_id'].'/'.$arr['nam']);