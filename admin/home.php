<?php include 'header.php';
function filtre($data, $con){
    $data = stripcslashes($data);
    $data = mysqli_real_escape_string($con, $data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['add'])){
    if($_POST['name_en'] != "" && $_POST['name_ru'] != "") {
        $eng = filtre($_POST['name_en'], $conn);
        $rus = filtre($_POST['name_ru'], $conn);
        $exist = mysqli_num_rows(mysqli_query($conn, "select * from categories where name_en = '$eng' or name_ru = '$rus'"));
        if($exist == 0) {
            mysqli_query($conn, "insert into categories (name_en, name_ru) values ('$eng', '$rus')");
        }
    }
}
if(isset($_POST['edit'])){
    $eng = filtre($_POST['eng_ed'], $conn);
    $rus = filtre($_POST['rus_ed'], $conn);
    $id = $_POST['hid'];
    $exist = mysqli_num_rows(mysqli_query($conn, "select * from categories where id != '$id' and (name_en in ('$eng', '$rus') or name_ru in ('$eng', '$rus'))"));
    if($exist < 1) {
        mysqli_query($conn, "update categories set name_en = '$eng', name_ru = '$rus' where id ='$id'");
    }
}
$ctg = mysqli_query($conn, "select * from categories");
?>


<div class="container">
    <h3>Add category</h3>
    <div class="row" style="border-bottom: 1px solid gray; padding-bottom: 30px;">
        <form action="" method="post">
            <div class="col-lg-4">
                <input name="name_en" class="form-control" type="text" placeholder="English">
            </div>
            <div class="col-lg-4">
                <input name="name_ru" class="form-control" type="text" placeholder="Русский">
            </div>
            <div class="col-lg-4">
                <input name="add" class="form-control btn-primary" type="submit" value="Add">
            </div>
        </form>
    </div>
    <table class="table table-bordered" style="margin-top: 30px;">
        <thead>
        <tr>
            <th>Num</th>
            <th>English</th>
            <th>Русский</th>
            <th>Edit</th>
            <th>Check</th>
        </tr>
        </thead>
        <?php
            $i = 1;
            while($row = mysqli_fetch_assoc($ctg)){
                echo "<tr><td>".$i."</td><td class='eng'><a href='products.php?id=".$row['id']."'>".$row['name_en']."</a></td><td class='name_ru'>".$row['name_ru']."</td><td><button data-index='".$row['id']."' type='button' class='edit_but btn btn-info btn-lg edit_but form-control' data-toggle='modal' data-target='#myModal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td><td><input class='cbox' data-index='".$row['id']."' style='cursor: pointer;' type='checkbox' value=''></td></tr>";
                $i++;
            }
        ?>
    </table>
    <div><button data-section='ctg' class="del form-control btn-danger" style="display: none;">Delete</button></div>
</div>



<?php include 'footer.php' ?>