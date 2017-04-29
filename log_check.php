<?php   require 'sql.php';
session_start();
$log = $_POST['log'];
$pas = $_POST['pas'];
if($log == "" || $pas == ""){
    echo 2;
}else{
    $log_rows = mysqli_num_rows(mysqli_query($conn, "select * from users where log = '$log'"));
    $log_pas_rows = mysqli_num_rows(mysqli_query($conn, "select * from users where log = '$log' and pass = '$pas'"));
    if($log_rows == 0){
        echo 3;
    }else if($log_rows == 1 && $log_pas_rows == 0){
        echo 4;
    }else{
        echo 1;
        $_SESSION['login'] = $log;
    }
}