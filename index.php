<?php

require_once 'lib/User.php';
$categories = User::getCategoryProductsAll();
//$products = User::getProductAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wezom</title>
    <link rel="stylesheet" href="/wezom/public/src/css/bootstrap.min.css">
    <META HTTP-EQUIV="Content-language" CONTENT="ru-RU">
    <META name="ROBOTS" content="index, nofollow">
    <META NAME="description" CONTENT="Данный модуль по своей сути является стандартным каталогом товаров,
с древовидной структурой, за исключением того, что у одного товара может быть более одного родителя.">
    <META NAME="keywords" CONTENT="категории, продукты, акция">
    <META NAME="Document-state" CONTENT="Static">
    <META NAME="AUTHOR" CONTENT="M.Roudchouk">
    <meta name="revisit-after" content="1 days">
</head>
<body>
<?php
if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
    $array = explode("/", rtrim($uri, '/'));
    if (count($array) > 1 && $array[0] === 'wezom') {
        $char = $array[1][0];
        $id = +substr($array[1], 1);
        if ($char === 'c') {
            $productsByCategory = User::getProductAllByCategory($id);
            if (is_array($productsByCategory) && !empty($productsByCategory)) {
//                var_dump($productsByCategory);
                include_once 'public/view/productsByCategory.php';
            } else { echo '<h1>404 ;(</h1>'; }
        } elseif ($char === 'p') {
            $product = User::getProduct($id);
            if (is_object($product)) {
//                var_dump($product);
                //include html
                include_once 'public/view/productByID.php';
            } else { echo '<h1>404 ;(</h1>'; }
        }
    } else {
        echo '<h1>404 ;(</h1>';
    }
} else {
    include_once 'public/view/categoriesAll.php';
}
?>
</body>
<script src="/wezom/public/src/js/jquery-3.1.1.min.js"></script>
</html>