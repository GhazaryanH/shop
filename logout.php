<?php
session_start();
unset($_SESSION['login']);
header('location:'.$_SERVER['HTTP_REFERER']);