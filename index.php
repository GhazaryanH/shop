<?php include 'header.php';
error_reporting(0);
?>
<div class="container">
    <br>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
                $query = mysqli_query($conn, "select * from products where slider = 1");
                $query_imgs = mysqli_query($conn, "select * from imgs where num = 1");
                $imgs_count = $query_imgs->num_rows;
                $imgs_all = $query_imgs->fetch_all();
                $active = 'active';
                while($row = mysqli_fetch_array($query)){
                    echo "<div class='item ".$active."' style='height: 555px;'><img src='images/".$row['id'].'/';
                    $active = '';
                    for ($i = 0; $i < $imgs_count; $i++){
                        if($row['id'] == $imgs_all[$i][1]){
                            echo $imgs_all[$i][2];
                        }
                    }
                    echo "' style='height: 100%;'><div class='carousel-caption'><h3>".$row['name_'.$lang]."</h3><p>".desc($row['desc_'.$lang])."</p><a href='products.php?id=".$row['id']."'><button class='btn-primary'>View</button></a></div></div>";
                }
                ?>
        </div>

        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>

<?php
$page = false;
$rows = 6;
if($ctg_count >= $rows){
    $page = true;
    $balance = $ctg_count % $rows;
    if ($balance == 0){
        $pages = $ctg_count / $rows;
    }else {
        $pages = ($ctg_count - $balance) / $rows + 1;
    }
};
$pr = 0;
if(!$_GET['id']){
    $i = 0;
}else {
    $i = $_GET['id'] * $rows - $rows;
}
for(; $i < $ctg_count; $i++){
    if ($lang == 'en'){
        $nn = 1;
    }else {
        $nn = 2;
    }
    echo "<div class='container well' style='margin-top: 20px;'><a style='text-decoration:none; color: black;' href='categories.php?id=".$ctg[$i][0]."'><h3>".$ctg[$i][$nn]."</h3></a><div class='row'>";
    $u = 0;
    for($o = $prd_count; $o >= 0; $o--) {
        if($prd[$o][1] == $ctg[$i][0]) {
            echo "<div class='col-lg-4'><a style='text-decoration:none; color: black;' href='products.php?id=".$prd[$o][0]."'>";
            $main_img = true;
            for($p = 0; $p < $img_count; $p++) {
                if ($img[$p][1] == $prd[$o][0] && $img[$p][3] == 1) {
                    echo "<img style='width: 100%; height: 222px;' src='images/" . $prd[$o][0] . '/' . $img[$p][2] . "'>";
                    break;
                }
                if ($p == $img_count - 1){
                    $main_img = false;
                }
            }
            if ($main_img == false) {
                $main_img = null;
                for($p = 0; $p < $img_count; $p++) {
                    if ($img[$p][1] == $prd[$o][0] && $img[$p][3] == 0) {
                        echo "<img style='width: 100%; height: 222px;' src='images/" . $prd[$o][0] . '/' . $img[$p][2] . "'>";
                        $main_img = true;
                        break;
                    }
                }
            }
            if ($main_img == null) {
                echo "<img style='width: 100%; height: 222px;' src='images/not_image.png'>";
            }
            if ($lang == 'en'){
                $nn = 2;
            }else {
                $nn = 3;
            }
            echo "<p>".$prd[$o][$nn]."</p></a></div>";
            $u++;
            if($u == 3){
                break;
            }
        }
    }
    echo "</div></div>";
    $pr++;
    if ($pr == $rows){
        break;
    }
}
if($page == true){
    echo "<div class='container'><ul class='pager'>";
    if ($_GET['id'] && $_GET['id'] != 1) {
        echo "<li><a href='index.php?id=".($_GET['id'] - 1)."'>Previous</a></li>";
    }
    for($i = 1; $i <= $pages; $i++){
        echo "<li><a ";
        $current = false;
        if ($i == $_GET['id']){
            echo "style='background: silver;'";
            $current = true;
        } else if (!$_GET['id'] && $i == 1){
            echo "style='background: silver;'";
            $current = true;
        }
        if ($current == false){
            echo "href='index.php?id=".$i."'";
        }
        echo ">".$i."</a></li>";
    }
    if (!$_GET['id']) {
        echo "<li><a href='index.php?id=2'>Next</a></li>";
    }else if ($_GET['id'] != $pages) {
        echo "<li><a href='index.php?id=".($_GET['id'] + 1)."'>Next</a></li>";
    }
    echo "</ul></div>";
}
?>







<?php include 'footer.php'; ?>

