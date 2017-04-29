<?php
session_start();
error_reporting(0);
if($_SESSION['ad_log'] == true){
    header('location: home.php');
}
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script src="../js/jquery.js"></script>
        <script src="../js/admin_log.js"></script>
    </head>
    <body>
        <div class="container" style="width: 400px; margin: 100px auto;">
            <h1>Administration</h1>
            <input class="form-control login" type="text" style="margin-top: 5px">
            <input class="form-control pass" type="password" style="margin-top: 5px">
            <input class="form-control btn-primary confirm" type="button" value="Confirm" style="margin-top: 5px">
            <div class="conf_alert alert alert-danger" style="margin-top: 5px; visibility: hidden;">Alert</div>
        </div>
    </body>
</html>
