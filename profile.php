<?php require 'sql.php';
session_start();
$login = $_SESSION['login'];
$query = mysqli_fetch_array(mysqli_query($conn, "select * from users where log = '$login'"));
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery.js"></script>
        <script src="js/home.js"></script>
    </head>
    <body style="background: gainsboro">
        <div class="container" style="margin-top: 250px; width: 400px; border-radius: 10px; background: silver; padding-bottom: 15px;">
            <h3><?php echo $login; ?></h3>
            <p>Деньги - <span class="my_money"><?php echo $query['cash']; ?></span> $</p>
            <input type="number" class="form-control money">
            <input type="button" class="form-control btn-primary add_money"style="margin-top: 12px; margin-bottom: 12px;" value="Пополнить счет">
            <a href="index.php">< to homepage</a>
        </div>
    </body>
</html>
