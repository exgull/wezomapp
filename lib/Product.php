<?php

require_once 'ParentObject.php';

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 07.10.16
 * Time: 20:14
 */
class Product extends ParentObject
{
    protected static $table_name = "products";
    static $data = ['productname', 'description', 'img', 'price', 'spacial_price', 'ctime', 'mtime'];
    public $id;
    public $productname;
    public $description;
    public $img = null; //string
    public $price;
    public $spacial_price; //nullable
    public $ctime;
    public $mtime;

    function __construct($product = []) {
        if (isset($product['id'])) {
            $this->id = $product['id'];
            for ($i=0; $i < count(self::$data); $i++) {
                $this->{self::$data[$i]} = $product[self::$data[$i]];
            }
        } elseif (isset($product['productname'])&&isset($product['description'])&&isset($product['price'])) {
            $this->productname = $product['productname'];
            $this->description = $product['description'];
            $this->price = $product['price'];
            $this->spacial_price = isset($product['spacial_price']) ? $product['spacial_price'] : null;
            $this->img = isset($product['img']) ? $product['img'] : null;
        } else { return false; }
    }

    public function save($array = []) {
        if (isset($this->id)) { // update()
            unset($array['ctime']);
            $array['mtime'] = strftime("%Y-%m-%d", time());
            return $this->update($array);
        } else { //create()
            $this->mtime = $this->ctime = strftime("%Y-%m-%d", time());
            if ($this->create()) {
                return true;
            } else { return false; }
        }
    }

}