<?php require 'sql.php';
session_start();
error_reporting(0);
mysqli_set_charset($conn, "utf8");
$query_ctg = mysqli_query($conn, "select * from categories");
$ctg_count = $query_ctg->num_rows;
$ctg = $query_ctg->fetch_all();
$query_prd = mysqli_query($conn, "select * from products");
$prd_count = $query_prd->num_rows;
$prd = $query_prd->fetch_all();
$query_img = mysqli_query($conn, "select * from imgs");
$img_count = $query_img->num_rows;
$img = $query_img->fetch_all();
function desc($desc){
    if(strlen($desc) < 30){
        return $desc;
    }else{
        return (substr($desc, 0, 30)).' . . .';
    }
}
if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = 'en';
}
$lang = $_SESSION['lang'];
Class languages {};
if($lang == 'en'){
    $languages->homepage = 'Home page';
    $languages->language = 'Language';
    $languages->categories = 'Categories';
    $languages->sign = 'Sign up';
    $languages->login = 'Log in';
    $languages->logout = 'Log out';
    $languages->profile = 'Profile';
    $languages->english = 'English';
    $languages->russian = 'Russian';
}else if($lang == 'ru'){
    $languages->homepage = 'Главная страница';
    $languages->language = 'Язык';
    $languages->categories = 'Категории';
    $languages->sign = 'Зарегистрироваться';
    $languages->login = 'Авторизоваться';
    $languages->logout = 'Выйти';
    $languages->profile = 'Профиль';
    $languages->english = 'Английский';
    $languages->russian = 'Русский';
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .carousel-inner > .item > img,
            .carousel-inner > .item > a > img {
                width: 70%;
                margin: auto;
            }
        </style>
        <link rel="stylesheet" href="libs/css/font-awesome.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/home.css">
        <script src="js/jquery.js"></script>
        <script src="js/home.js"></script>
    </head>
    <body>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="http://localhost/site_1/"><?php echo $languages->homepage; ?></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><?php echo $languages->language; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href='languages.php?lang=en'><?php echo $languages->english; ?></a></li>
                                <li><a href='languages.php?lang=ru'><?php echo $languages->russian; ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><?php echo $languages->categories; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                    $query_categories = mysqli_query($conn, "select * from categories");
                                    while ($row = mysqli_fetch_assoc($query_categories)){
                                        echo "<li><a href='categories.php?id=".$row['id']."'>".$row['name_'.$lang]."</a></li>";
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            Class login {};
                            if(isset($_SESSION['login'])){
                                $login->text_1 = $languages->profile;
                                $login->text_2 = $languages->logout;
                                $login->url_1 = 'profile.php';
                                $login->url_2 = 'logout.php';
                                $login->icon_2 = 'out';
                            }else{
                                $login->text_1 = $languages->sign;
                                $login->text_2 = $languages->login;
                                $login->url_1 = 'reg.php';
                                $login->url_2 = 'log.php';
                                $login->icon_2 = 'in';
                            }
                        ?>
                        <li><a href="<?php echo $login->url_1; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $login->text_1; ?></a></li>
                        <li><a href="<?php echo $login->url_2; ?>"><i class="fa fa-sign-<?php echo $login->icon_2; ?>" aria-hidden="true"></i> <?php echo $login->text_2; ?></a></li>
                        <li style="cursor: pointer;" class="shops" data-section="toggle"><a><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="caret"></span></a></li>
                    </ul>
                </div>
            </nav>
            <div class="order_cont">
                <?php
                    if(isset($_SESSION['order'])) {
                    $query_buy = mysqli_query($conn, "select products.id as id, products.name_en as name, products.price as price, products.cnt as count, imgs.nam as source from products inner join imgs on products.id = imgs.pr_id where num = 1 and pr_id in (".implode(',', $_SESSION['order']).")");
                ?>
                <div class="orders panel panel-default all_shops" <?php if($_SESSION['show'] == 'hide'){
                    echo "style='display: none;'";
                } ?>>
                    <div class="panel-heading">
                        <span>Your order</span>
                        <i class="fa fa-times removing" data-index="0" aria-hidden="true"></i>
                        <i class="fa fa-minus shops" data-section="minimize" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                    <?php
                        while ($row = mysqli_fetch_array($query_buy)) {
                            $cnt = $_SESSION['count'][$row['id']];
                            $_SESSION['price'][$row['id']] = $row['price'] * $cnt;
                            echo "<div class='panel-body' style='border-top: 1px solid silver;'><div class='row'><div class='col-lg-5'><p>" . $row['name'] . "</p><img class='order_img' src='images/" . $row['id'] . '/' . $row['source'] . "'></div><div class='col-lg-7'><p>" . $row['price'] . " $ - Price</p><select class='counts' data-index='".$row['id']."'><option value='".$cnt."'>".$cnt."</option>";
                            for ($i = 1; $i < $row['count']; $i++) {
                                echo "<option value='".$i."'>" . $i . "</option>";
                            }
                            echo "</select><span> - Count</span><p style='margin-bottom: 0;'><span class='this_total'>".$_SESSION['price'][$row['id']]."</span> $ - Total sum</p><button data-index='".$row['id']."' class='btn-danger removing'>Remove</button></div></div></div>";
                        }
                    ?>
                    </div>
                    <div class="panel-footer">Total sum - <span class="all_total"><?php echo $_SESSION['total']; ?></span> $</div>
                    <button class="form-control btn-success buy">Buy</button>
                </div>
                <?php } ?>
            </div>
