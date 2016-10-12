<?php
require_once '../../lib/User.php';

//$_POST
//array(5) { ["productname"]=> string(7) "afdsfds"
//           ["description"]=> string(22) "sajfdkhdjf jdfkjsfjksd"
//           ["price"]=> string(2) "34"
//           ["spacial_price"]=> string(0) ""
//           ["categories"]=> string(3) "5,6" }
//$_FILES
//array(1) { ["file"]=> array(5) { ["name"]=> string(11) "ability.jpg"
//                                 ["type"]=> string(10) "image/jpeg"
//                                 ["tmp_name"]=> string(14) "/tmp/phpU0ks93"
//                                 ["error"]=> int(0)
//                                 ["size"]=> int(6604) } }

//var_dump($_POST);

if (isset($_FILES['file'])) {
    $max_file_size = 10485760;
    $img = User::newImage($_FILES['file']);
    if ($img->save()!==true) { var_dump($img->errors); }
}
//['productname', 'description', 'img', 'price', 'spacial_price', 'ctime', 'mtime'];
$product = User::newProduct(['productname'=>$_POST['productname'],
                             'description' => $_POST['description'],
                             'img'=>(isset($img) ? $img->id : null),
                             'price' => $_POST['price'],
                             'spacial_price' => (($_POST['spacial_price']!=='') ? $_POST['spacial_price'] : null)]);
if ($product->save()) {
    if (strlen($_POST['categories'])>0) {
        $categories = explode(",", $_POST['categories']);
        foreach ($categories as $category) {
            $categoryobj = User::getCategoryProducts($category);
            User::ProductToCategory($product, $categoryobj);
        }
    }
} else {
    if (isset($img)) {
        $img->delete();
    }
    echo "Product do not save";
}