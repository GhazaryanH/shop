<?php require 'sql.php';
session_start();
$id = $_POST['id'];
$first = 'no';
if(!isset($_SESSION['order'])){
    $_SESSION['order'] = [];
    $first = 'yes';
    $_SESSION['show'] = 'show';
}
if(!in_array($id, $_SESSION['order'])) {
    $_SESSION['count'][$id] = 1;
    array_push($_SESSION['order'], $id);
    $query = mysqli_fetch_array(mysqli_query($conn, "select products.id as id, products.name_en as name, products.price as price, products.cnt as count, imgs.nam as source from products inner join imgs on products.id = imgs.pr_id where num = 1 and pr_id = '$id'"));
    $_SESSION['price'][$id] = $query['price'];
    if(!isset($_SESSION['total'])){
        $query['total'] = $query['price'];
        $_SESSION['total'] = $query['price'];
    }else{
        $query['total'] = $_SESSION['total'] + $query['price'];
        $_SESSION['total'] = $_SESSION['total'] + $query['price'];
    }
    $query['first'] = $first;
    echo json_encode($query);
}else{
    echo 1;
}
