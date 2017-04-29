<?php
session_start();
$log_pas = file_get_contents('admins');
$log = substr($log_pas, 0, 5);
$pas = substr($log_pas, 6);
$login = $_POST['login'];
$pass = $_POST['pass'];
if($login == "" || $pass == ""){
    echo 1;
}else if($login != $log && $pass != $pas){
    echo 2;
}else if($login == $log && $pass != $pas){
    echo 3;
}else{
    $_SESSION['ad_log'] = true;
    echo 4;
}