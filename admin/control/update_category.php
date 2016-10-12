<?php
require_once '../../lib/User.php';

$category = User::getCategoryProducts($_POST['id']);
$img = false;
if (isset($_FILES['file'])) {
    $max_file_size = 10485760;
    $img = User::newImage($_FILES['file']);
    if(is_object($img)) {
        if ($img->save()) {
            if ($category->img!==null) {
                $oldimg = User::getImage($category->img);
                $oldimg->delete();
            }
        } else {
            var_dump($img->errors);
            $img->id = $category->img;
        }
    }
}

if ($category->save(['categoryname'=>$_POST['categoryname'],
    'img'=>($img ? $img->id : null)])) {
} else {
//    if ($img) {
//        $img->delete();
//    }
    echo "Product do not save";
}