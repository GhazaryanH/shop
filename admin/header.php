<?php
session_start();
if($_SESSION['ad_log'] != true){
    header('location: index.php');
}
$conn = mysqli_connect('localhost', 'root', '', 'site1');
mysqli_set_charset($conn, "utf8");
?>
<html>
    <head>
        <link rel="stylesheet" href="../libs/css/font-awesome.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/admin_home.css">
        <script src="../js/jquery.js"></script>
        <script src="../js/admin_home.js"></script>
    </head>
    <body>
        <div class="container" style="border-bottom: 1px solid gray;">
            <div style="display: inline-block;">
                <h2>Admin</h2>
            </div>
            <div style="float: right;">
                <a href="logout" class="right"><h2>Log Out</h2></a>
            </div>
        </div>
        <div class="modal" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close_modal close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="border-bottom: 1px solid gray; padding-bottom: 30px;">
                            <form action="" method="post">
                                <input name="hid" class="hid" type="hidden">
                                <div class="col-lg-4">
                                    <input name="eng_ed" class="eng_ed form-control" type="text" placeholder="English">
                                </div>
                                <div class="col-lg-4">
                                    <input name="rus_ed" class="rus_ed form-control" type="text" placeholder="Русский">
                                </div>
                                <div class="col-lg-4">
                                    <input name="edit" class="form-control btn-primary" type="submit" value="edit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close_modal btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
