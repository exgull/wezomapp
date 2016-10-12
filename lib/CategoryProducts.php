<?php

require_once 'ParentObject.php';

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 07.10.16
 * Time: 20:15
 */
class CategoryProducts extends ParentObject
{
    protected static $table_name = "category_products";
    static $data = ['categoryname', 'img', 'ctime', 'mtime'];
    public $id;
    public $categoryname;
    public $img = null; //string
    public $ctime;
    public $mtime;

    function __construct($category = []) {
        if (isset($category['id'])) {
            $this->id = $category['id'];
            for ($i=0; $i < count(self::$data); $i++) {
                $this->{self::$data[$i]} = $category[self::$data[$i]];
            }
        } elseif (isset($category['categoryname'])) {
            $this->categoryname = $category['categoryname'];
            $this->img = isset($category['img']) ? $category['img'] : null;
        } else { return false; }
    }

    public function save($array = []) {
        if (isset($this->id)) { // update()
            unset($array['ctime']);
            $array['mtime'] = strftime("%Y-%m-%d %H:%M:%S", time());
            $this->update($array);
        } else { //create()
            $this->mtime = $this->ctime = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($this->create()) {
                return true;
            } else { return false; }
        }
    }
}