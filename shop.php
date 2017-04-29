<?php
session_start();
$section = $_POST['section'];
if($section == 'minimize'){
    $_SESSION['show'] = 'hide';
}else{
    if($_SESSION['show'] == 'hide'){
        $_SESSION['show'] = 'show';
    }else{
        $_SESSION['show'] = 'hide';
    }
}