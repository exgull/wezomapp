<?php
require_once '../../lib/User.php';

if (isset($_FILES['file'])) {
    $max_file_size = 10485760;
    $img = User::newImage($_FILES['file']);
    if ($img->save()!==true) { var_dump($img->errors); }
}
//['categoryname', 'img', 'ctime', 'mtime'];
$category = User::newCategoryProducts(['categoryname'=>$_POST['categoryname'],
    'img'=>(isset($img) ? $img->id : null)]);
if ($category->save() !== true) {
    if (isset($img)) {
        $img->delete();
    }
    echo "Category do not save";
}