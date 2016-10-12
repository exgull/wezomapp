<?php
require_once '../../lib/User.php';

$product = User::getProduct($_POST['id']);
$img = false;
if (isset($_FILES['file'])) {
    $max_file_size = 10485760;
    $img = User::newImage($_FILES['file']);
    if(is_object($img)) {
        if ($img->save()) {
            if ($product->img!==null) {
                $oldimg = User::getImage($product->img);
                $oldimg->delete();
            }
        } else {
            var_dump($img->errors);
            $img->id = $product->img;
        }
    }
}

if ($product->save(['productname'=>$_POST['productname'],
                    'description' => $_POST['description'],
                    'img'=>($img ? $img->id : null),
                    'price' => $_POST['price'],
                    'spacial_price' => (($_POST['spacial_price']!=='') ? $_POST['spacial_price'] : null)])) {
    $sql = "DELETE FROM products_to_category WHERE productid=".$_POST['id'];
    User::query($sql);
    if (strlen($_POST['categories'])>0) {
        $categories = explode(",", $_POST['categories']);
        foreach ($categories as $category) {
            $categoryobj = User::getCategoryProducts($category);
            User::ProductToCategory($product, $categoryobj);
        }
    }
} else {
//    if ($img) {
//        $img->delete();
//    }
    echo "Product do not save";
}