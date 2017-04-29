<?php   require 'sql.php';
session_start();
if(!isset($_SESSION['order']) || !isset($_SESSION['login'])){
    header('location: index.php');
}
$query_buy = mysqli_query($conn, "select products.id as id, products.name_en as name, products.price as price, products.cnt as count, imgs.nam as source from products inner join imgs on products.id = imgs.pr_id where num = 1 and pr_id in (".implode(',', $_SESSION['order']).")");
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery.js"></script>
        <script src="js/home.js"></script>
    </head>
    <body>
        <div class="container panel panel-default" style="padding: 15px;">
            <div class="panel-heading">
                <h1>Your order</h1>
            </div>
            <div class="panel-body">
                <?php
                    while ($row = mysqli_fetch_array($query_buy)){
                        $cnt = $_SESSION['count'][$row['id']];
                        $_SESSION['price'][$row['id']] = $row['price'] * $cnt;
                        echo "<div class='row'><img style='width: 100%;' src='images/" . $row['id'] . '/' . $row['source'] . "'><div class='col-lg-3'><h3>" . $row['name'] . "</h2></div><div class='col-lg-3'><h3>" . $row['price'] . " $ - Price</h2></div><div class='col-lg-3'><h3><select class='counts' data-index='".$row['id']."'><option value='".$cnt."'>".$cnt."</option>";
                        for ($i = 1; $i < $row['count']; $i++) {
                            echo "<option value='".$i."'>" . $i . "</option>";
                        }
                        echo "</select><span> - Count</span></h3></div><div class='col-lg-3'><h3><span class='this_total'>".$_SESSION['price'][$row['id']]."</span> $ - Total sum</h3></div></div>";
                    }
                ?>
            </div>
            <div class="panel-footer"><h2>Total sum - <span class="all_total"><?php echo $_SESSION['total']; ?></span> $</h2></div>
            <button class="form-control btn-success last_buy">Buy</button>
        </div>
    </body>
</html>
