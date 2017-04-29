<?php   require 'sql.php';
session_start();
$log = $_POST['log'];
$pas = $_POST['pas'];
if($log == "" || $pas == ""){
    echo 2;
}else{
    $rows = mysqli_num_rows(mysqli_query($conn, "select * from users where log = '$log'"));
    if($rows > 0){
        echo 3;
    }else if(strlen($pas) < 8){
        echo 4;
    }else{
        mysqli_query($conn, "insert into users (log, pass, cash) values('$log', '$pas', 0)");
        echo 1;
        $_SESSION['login'] = $log;
    }
}