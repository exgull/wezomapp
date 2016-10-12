<?php
require_once '../../lib/User.php';

$product = User::getProduct($_POST["id"]);
$sql = "DELETE FROM products_to_category WHERE productid={$_POST["id"]}";
User::query($sql);
if($product->img!==null) {
    $img = User::getImage($product->img);
    $img->delete();
}
$product->delete();