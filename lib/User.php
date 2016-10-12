<?php

require_once 'ParentObject.php';
require_once 'CategoryProducts.php';
require_once 'Product.php';
require_once 'Image.php';

class User extends ParentObject
{
    protected static $table_name = "users";
    static $data = ['username', 'password', 'email'];
    public $id;
    public $username;
    public $email;
    public $password;
//    public $admin = flase;

    function __construct($user = []) {
        if (isset($user['id'])) {
            $this->id      = $user['id'];
            for ($i=0; $i < count(self::$data); $i++) {
                $this->{self::$data[$i]} = $user[self::$data[$i]];
            }
        } elseif (isset($user['username'])&&isset($user['password'])) {
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->email    = isset($user['email']) ? $user['email'] : '';
        } else {
            return false;
        }
    }

    ###Image
    static function newImage($image) { //file
        return new Image($image);
    }
    static function getImageAll() {
        return Image::get();
    }
    static function getImage($id) {
        return Image::getById($id);
    }


    ### CategoryProducts
    static function newCategoryProducts($array=[]) {
        return new CategoryProducts($array);
    }
    static function getCategoryProductsAll() {
        return CategoryProducts::get();
    }
    static function getCategoryProducts($id) {
        return CategoryProducts::getById($id);
    }
    static function getCategoryAllByProduct($product) {
        if (isset($product)) {
            if (is_int($product)) {
                $sql = "SELECT * FROM products_to_category WHERE productid = '{$product}'";
            }elseif (is_object($product)&&isset($product->id)) {
                $sql = "SELECT * FROM products_to_category WHERE productid = '{$product->id}'";
            } else { return false; }
            $result = ParentObject::query($sql);
            $objs = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $obj = self::getCategoryProducts($row['categoryid']);
                array_push($objs, $obj);
            }
            return $objs;
        }
    }


    ### Product
    static function newProduct($array=[]) {
        return new Product($array);
    }
    static function getProductAll() {
        return Product::get();
    }
    static function getProduct($id) {
        return Product::getById($id);
    }
    static function ProductToCategory($product, $category) {
        if (isset($category)&&is_object($category)&&isset($category->id)
           &&isset($product)&&is_object($product)&&isset($product->id)) {
            $sql = "INSERT INTO products_to_category (productid, categoryid) VALUES";
            $sql .= " ('".$product->id."','".$category->id."')";
            if (ParentObject::query($sql)) {
                return true;
            } else { return false; }
        }
    }
    static function getProductAllByCategory($category) { //повторение
        if (isset($category)) {
            if (is_int($category)) {
                $sql = "SELECT * FROM products_to_category WHERE categoryid = '{$category}'";
            }elseif (is_object($category)&&isset($category->id)) {
                $sql = "SELECT * FROM products_to_category WHERE categoryid = '{$category->id}'";
            } else { return false; }
            $result = ParentObject::query($sql);
            $objs = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $obj = self::getProduct($row['productid']);
                array_push($objs, $obj);
            }
            return $objs;
        }
    }


    ### Image
    static function replaceImg($filename, $width = 250, $height = 250) {
        return Image::replaceImg($filename, $width, $height);
//        echo '<img src='.User::replaceImg('001.jpg').'>'; // img250x250
//        echo '<img src='.User::replaceImg('001.jpg', 110, 110).'>'; // img110x110
//        echo '<img src='.User::replaceImg('001.jpg', 450, 450).'>'; // img450x450
    }


    ### Auth
    public function login() {
        if($this->id){
            $_SESSION['user_id'] = $this->id;
            return true;
        } else { return false; }
    }
    static public function logout() {
        unset($_SESSION['user_id']);
    }
    static public function auth($user=null) {
        if (isset($_SESSION['user_id'])) {
            if (isset($user->id)) {
                if ($user->id === $_SESSION['user_id']) {
                    return true;
                } else { return false; }
            } else { return self::get('id', $_SESSION['user_id'], true); }
        } else { return false; }
    }
}

session_start();