<?php include 'header.php';
error_reporting(0);
$id = $_GET['id'];
$_SESSION['id'] = $id;
function filtre($data, $con){
    $data = stripcslashes($data);
    $data = mysqli_real_escape_string($con, $data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['update'])){
    $name_en = filtre($_POST['name_en'], $conn);
    $name_ru = filtre($_POST['name_ru'], $conn);
    $desc_en = filtre($_POST['desc_en'], $conn);
    $desc_ru = filtre($_POST['desc_ru'], $conn);
    $price = filtre($_POST['price'], $conn);
    $sale = filtre($_POST['sale'], $conn);
    $count = filtre($_POST['count'], $conn);
    mysqli_query($conn, "update products set name_en = '$name_en', name_ru = '$name_ru', desc_en = '$desc_en', desc_ru = '$desc_ru', price = '$price', price_sale = '$sale', cnt = '$count' where id ='$id'");
}
$query = mysqli_query($conn, "select * from products where id = '$id'");
$arr = mysqli_fetch_array($query);
if(isset($_POST['img_add'])) {
    $img_in = true;
    $img_cnt = count($_FILES['img']['name']);
    $img_types = ['jpg','jpeg','png'];
    for ($i = 0; $i < $img_cnt; $i++) {
        $img_type = end(explode(".",$_FILES["img"]["name"][$i]));
        if(!in_array($img_type, $img_types)) {
            $img_in = false;
        }
    }
    if($img_in != false) {
        if (!is_dir('../images/' . $id)) {
            mkdir('../images/' . $id);
        }
        for ($i = 0; $i < $img_cnt; $i++) {
            move_uploaded_file($_FILES["img"]["tmp_name"][$i], '../images/' . $id . '/' . $_FILES["img"]["name"][$i]);
        }
        for ($i = 0; ; $i++) {
            $names .= "(". $id . ",'" . $_FILES['img']['name'][$i] . "',0)";
            if ($i + 1 == $img_cnt) {
                break;
            }
            $names .= ",";
        }
        mysqli_query($conn, 'insert into imgs (pr_id, nam, num) values '.$names);
    }
}
?>
<div class="container" style="padding-top: 10px;">
    <div><a href="products.php?id=<?php echo $arr['ctg_id']; ?>">< Back to products</a></div>
    <div class="row" style="border-top: 1px solid #ddd; margin-top: 10px;">
        <form action="" method="post">
            <div class="col-lg-12">
                <h5>Name(EN)</h5>
                <input name="name_en" class="form-control" type="text" value="<?php echo $arr['name_en']; ?>">
                <h5>Name(RU)</h5>
                <input name="name_ru" class="form-control" type="text" value="<?php echo $arr['name_ru']; ?>">
                <h5>Description(EN)</h5>
                <textarea name="desc_en" class="form-control"><?php echo $arr['desc_en']; ?></textarea>
                <h5>Description(RU)</h5>
                <textarea name="desc_ru" class="form-control"><?php echo $arr['desc_ru']; ?></textarea>
            </div>
            <div class="col-lg-4">
                <h5>Price $</h5>
                <input name="price" class="form-control" type="number" value="<?php echo $arr['price']; ?>">
            </div>
            <div class="col-lg-4">
                <h5>Sale percent</h5>
                <select name="sale" class="sale_sel form-control"><option value="<?php echo $arr['price_sale']; ?>"><?php echo $arr['price_sale']; ?>%</option></select>
            </div>
            <div class="col-lg-4">
                <h5>Count</h5>
                <input name="count" class="form-control" type="number" value="<?php echo $arr['cnt']; ?>">
            </div>
            <div class="col-lg-12" style="margin-top: 15px;">
                <input name="update" type="submit" class="form-control btn-success" value="Update">
            </div>
        </form>
    </div>
    <div class="row" style="border-top: 1px solid #ddd; margin-top: 10px; padding-top: 10px;">
        <div class="col-lg-6">
            <form action="" method="post" enctype="multipart/form-data">
                <label class="btn btn-primary form-control">
                    Choose img<input name="img[]" type="file" style="display: none;" multiple>
                </label>
            </div>
            <div class="col-lg-6">
                <button name="img_add" type="submit" class="btn btn-primary form-control">Add</button>
            </form>
        </div>
        <div class="col-lg-12" style="margin-top: 20px; margin-bottom: 60px;">
            <?php
                $query = mysqli_query($conn, "select * from imgs where pr_id = '$id'");
                while($row = mysqli_fetch_assoc($query)){
                    echo "<div class='col-lg-3'><i class='del_img fa fa-times' aria-hidden='true'></i><img class='photos' data-index='".$row['id']."' style='";
                    if($row['num'] != 1){
                        echo 'opacity: 0.75;';
                    }else{
                        echo 'opacity: 1; border: 2px solid red;';
                    }
                    echo "' src='../images/".$id.'/'.$row['nam']."'><div> __<input class='cbox' data-index='".$row['id']."' style='cursor: pointer;' type='checkbox' value=''>__</div></div>";
                }
            ?>
            <div><button data-section='img' class="del form-control btn-danger" style="display: none;">Delete</button></div>
        </div>
    </div>
</div>








<?php include 'footer.php' ?>
