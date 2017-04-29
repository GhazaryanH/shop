<?php
session_start();
if ($_GET['lang'] == 'ru'){
    $_SESSION['lang'] = 'ru';
} else if ($_GET['lang'] == 'en'){
    $_SESSION['lang'] = 'en';
}
header('location:'.$_SERVER['HTTP_REFERER']);