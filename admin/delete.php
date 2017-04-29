<?php require 'sql.php';
$section = $_POST['section'];
$ids = $_POST['ids'];
if($section != 'img'){
    if($section == 'ctg') {
        mysqli_query($conn, "delete from categories where id in ($ids)");
        $query = mysqli_query($conn, "select * from products where ctg_id in ($ids)");
        mysqli_query($conn, "delete from products where ctg_id in ($ids)");
    }else{
        $query = mysqli_query($conn, "select * from products where id in ($ids)");
        mysqli_query($conn, "delete from products where id in ($ids)");
    }
    $pr_arr = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($pr_arr, $row['id']);
    }
    $pr_ids = implode(',', $pr_arr);
    $query = mysqli_query($conn, "select * from imgs where pr_id in ($pr_ids)");
    mysqli_query($conn, "delete from imgs where pr_id in ($pr_ids)");
}else{
    $query = mysqli_query($conn, "select * from imgs where id in ($ids)");
    mysqli_query($conn, "delete from imgs where id in ($ids)");
}
while($row = mysqli_fetch_assoc($query)){
    unlink('../images/'.$row['pr_id'].'/'.$row['nam']);
    rmdir('../images/'.$row['pr_id']);
}