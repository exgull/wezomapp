<?php
require_once '../../lib/User.php';

$category = User::getCategoryProducts($_POST["id"]);
$sql = "DELETE FROM products_to_category WHERE categoryid={$_POST["id"]}";
User::query($sql);
if($category->img!==null) {
    $img = User::getImage($category->img);
    $img->delete();
}
$category->delete();