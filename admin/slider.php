<?php require 'sql.php';
$id = $_POST['id'];
$slider = mysqli_fetch_array(mysqli_query($conn, "select * from products where id = '$id'"))['slider'];
if ($slider == 0){
    mysqli_query($conn, "update products set slider = 1 where id = '$id'");
} else {
    mysqli_query($conn, "update products set slider = 0 where id = '$id'");
}
