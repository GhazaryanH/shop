<?php require 'sql.php';
include 'header.php';
$id = $_GET['id'];
$query_prd = mysqli_query($conn, "select * from products where ctg_id ='$id'");
$prd_count = $query_prd->num_rows;
$prd = $query_prd->fetch_all();
?>

<?php
if ($lang == 'en'){
    $nn = 2;
    $mm = 4;
}else {
    $nn = 3;
    $mm = 5;
}
    for($i = 0; $i < $prd_count; $i++){
        echo "<div class='container well'><div class='row'><div class='col-lg-8'>";
        for($o = 0; $o < $img_count; $o++){
            if($img[$o][1] == $prd[$i][0] && $img[$o][3] == 1){
                echo "<img style='width: 100%;' src='images/".$prd[$i][0].'/'.$img[$o][2]."'>";
            }
        }
        echo "</div><div class='col-lg-4'><h3>".$prd[$i][$nn]."</h3><p>".desc($prd[$i][$mm])."</p><p>Price - ".$prd[$i][6]."$</p><p>Sale price - ".($prd[$i][6] - ($prd[$i][6] * $prd[$i][7] / 100))."$</p><p>Count - ".$prd[$i][8]."</p><div class='col-lg-6'><button data-index='".$prd[$i][0]."'class='btn-primary form-control add_buy'>Buy</button></div><div class='col-lg-6'><a href='products.php?id=".$prd[$i][0]."'><button class='btn-primary form-control'>Details</button></a></div></div></div></div>";
    }
?>















<?php include 'footer.php' ?>
