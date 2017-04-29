<?php require 'sql.php';
include 'header.php';
$id = $_GET['id'];
$query_prd = mysqli_query($conn, "select * from products where id ='$id'");
$prd = $query_prd->fetch_array();
$query_img = mysqli_query($conn, "select * from imgs where pr_id = '$id' and num != 1");
$main_img = mysqli_fetch_array(mysqli_query($conn, "select * from imgs where pr_id = '$id' and num = 1"))['nam'];
?>

<div class="container" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-lg-12">
            <img src="images/<?php echo $id.'/'.$main_img; ?>" style="width: 100%;" >
            <h2><?php echo $prd['name_en']; ?></h2>
            <p><?php echo $prd['desc_en']; ?></p>
        </div>
        <div class="col-lg-4"><p>Price - <?php echo $prd['price']; ?> $</p></div>
        <div class="col-lg-4"><p>Sale price - <?php echo ($prd['price'] - ($prd['price'] * $prd['price_sale'] / 100)); ?> $</p></div>
        <div class="col-lg-4"><p>Count - <?php echo $prd['cnt']; ?></p></div>
        <button data-index='<?php echo $id; ?>' class="btn-primary form-control add_buy">Buy</button>
        <?php
            while($row = mysqli_fetch_assoc($query_img)){
                echo "<div style='margin-top: 10px;' class='col-lg-4'><img style='width: 100%; height: 230px;' src='images/".$id.'/'.$row['nam']."'></div>";
            }
        ?>
    </div>
</div>

















<?php include 'footer.php' ?>
