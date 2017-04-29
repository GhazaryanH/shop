<?php include 'header.php';
if(!is_numeric($_GET['id'])){
    header('location: ../../error');
}else{
    $ctg_id = $_GET['id'];
    $query = mysqli_query($conn, "select * from categories where id = '$ctg_id'");
    $num = mysqli_num_rows($query);
    if($num != 1){
        header('location: ../../error');
    }
}
function filtre($data, $con){
    $data = stripcslashes($data);
    $data = mysqli_real_escape_string($con, $data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['add'])){
    $name_en = filtre($_POST['name_en'], $conn);
    $name_ru = filtre($_POST['name_ru'], $conn);
    $price = filtre($_POST['price'], $conn);
    $sale = filtre($_POST['sale'], $conn);
    $count = filtre($_POST['count'], $conn);
    $desc_en = filtre($_POST['desc_en'], $conn);
    $desc_ru = filtre($_POST['desc_ru'], $conn);
    if($name_en != "" || $name_ru != "" || $price != "" || $sale != "" || $count != "" || $desc_en != "" || $desc_ru != ""){
        mysqli_query($conn, "insert into products (ctg_id, name_en, name_ru, desc_en, desc_ru, price, price_sale, cnt, slider) values ('$ctg_id', '$name_en', '$name_ru', '$desc_en', '$desc_ru', '$price', '$sale', '$count', 0)");
    }
}
$query = mysqli_query($conn, "select * from products where ctg_id ='$ctg_id'");
?>

<div class="container table-bordered" style="padding-top: 10px;">
    <div><a href="home.php">< Back to Home</a></div>
    <?php
        function desc($desc){
            if(strlen($desc) < 100){
                return $desc;
            }else{
                return (substr($desc, 0, 100)).' . . .';
            }
        }
        function slider($numb){
            if($numb == 0){
                return 'btn-primary';
            } else {
                return 'btn-danger';
            }
        }
        while($row = mysqli_fetch_assoc($query)){
            echo "<div class='row' style='margin: 10px 0; border: 1px solid black; padding-bottom: 10px;'><div class='col-lg-5'><h3>".$row['name_en']."</h3><p>".desc($row['desc_en'])."</p></div><div class='col-lg-5'><h3>".$row['name_ru']."</h3><p>".desc($row['desc_ru'])."</p></div><div class='col-lg-2' style='margin-top: 20px;'><input class='cbox' data-index='".$row['id']."' style='cursor: pointer;' type='checkbox' value=''><p>Price - ".$row['price']." $</p><p>Sale price - ".$sale = $row['price'] - ($row['price'] * $row['price_sale'] / 100)." $</p><p>Count - ".$row['cnt']."</p></div><div class='col-lg-10'></div><div class='col-lg-1'><a href='edit.php?id=".$row['id']."'><button class='form-control btn-primary'>Edit</button></a></div><div class='col-lg-1'><button data-index='".$row['id']."' class='form-control ".slider($row['slider'])." add_slide'>Slider</button></div></div>";
        }
    ?>
    <div><button data-section='prd' class="del form-control btn-danger" style="display: none;">Delete</button></div>
    <form action="" method="post">
        <div class="row" style="border-top: 1px solid #ddd;">
            <div class="col-lg-12"><h3>Add new products</h3></div>
            <div class="col-lg-3"><input name="name_en" class="form-control" type="text" placeholder="Name(EN)"></div>
            <div class="col-lg-3"><input name="name_ru" class="form-control" type="text" placeholder="Name(RU)"></div>
            <div class="col-lg-2"><input name="price" class="form-control" type="number" placeholder="Price $"></div>
            <div class="col-lg-2"><select name="sale" class="sale_sel form-control"><option value="">Sale percent</option></select></div>
            <div class="col-lg-2"><input name="count" class="form-control" type="number" placeholder="Count"></div>
            <div class="col-lg-6" style="margin-top: 10px;"><textarea name="desc_en" class="form-control" placeholder="Description(en)"></textarea></div>
            <div class="col-lg-6" style="margin-top: 10px;"><textarea name="desc_ru" class="form-control" placeholder="Description(RU)"></textarea></div>
            <div class="col-lg-12" style="margin-top: 10px;"><input name="add" type="submit" class="form-control btn-success" value="Add"></div>
        </div>
    </form>
</div>






<?php include 'footer.php' ?>
