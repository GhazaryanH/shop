<?php
session_start();
session_unset($_SESSION['ad_log'], $_SESSION['id']);
header('location: index.php');