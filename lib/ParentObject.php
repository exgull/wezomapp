<?php

require_once 'DataBase.php';

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 07.10.16
 * Time: 20:34
 */
class ParentObject
{
    public function save($array = []) {
        return isset($this->id) ? $this->update($array) : $this->create();
    }

    protected function create() {
        $sql = "INSERT INTO ".static::$table_name." (";
        $sql .= implode(", ", static::$data).") VALUES (";
        for ($i=0; $i < count(static::$data); $i++) {
            if ($this->{static::$data[$i]} === null) {
                $sql .= "null, ";
            } else {
                $sql .= "'".$this->{static::$data[$i]}."', ";
            }
        }
        $sql = substr($sql, 0, count($sql)-3).")";
        if (static::query($sql)) {
            $this->id = static::insertId();
            return true;
        } else { return false; }
    }
    protected function update($update = []) {
        $sql  = "UPDATE ".static::$table_name." SET ";
        for ($i=0; $i < count(static::$data); $i++) {
            isset($update[static::$data[$i]]) ? $this->{static::$data[$i]} = $update[static::$data[$i]] : false;
            $sql .= static::$data[$i].(($this->{static::$data[$i]}===null)? "=null" :"='".$this->{static::$data[$i]}."'").", ";
        }
        $sql = substr($sql, 0, count($sql)-3);
        $sql .= " WHERE id=".$this->id;
        return static::query($sql) ? true : false;
    }
    public function delete() {
        $sql  = "DELETE FROM ".static::$table_name;
        $sql .= " WHERE id=".$this->id;
        $sql .= " LIMIT 1";
        return static::query($sql) ? true : false;
    }
    static public function query($sql="") {
        global $connect;
        if (isset($connect) && $result = $connect->query($sql)) {
            return $result;
        } else { return false; }
    }
    static public function insertId()
    {
        global $connect;
        return isset($connect) ? $connect->insertId() : false;
    }
    static public function getById($id) {
        return static::get('id', $id, true);
    }
    static public function get($field=null, $value='', $limit = false, $andfield=null, $andvalue='') {
        $sql  = "SELECT * FROM ".static::$table_name." ";
        if ($field && ($field=='id' || in_array($field, static::$data))) {
            $sql .= "WHERE {$field} = '{$value}'";
        }
        if ($andfield && $andfield!==$field && ($andfield=='id' || in_array($andfield, static::$data))) {
            $sql .= " AND {$andfield} = '{$andvalue}'";
        }
        if ($limit) {
            $sql .= " LIMIT 1";
            $response = static::query($sql);
            if (is_object($response) && $response->num_rows > 0) {
                $obj = mysqli_fetch_array($response, MYSQLI_ASSOC);
                return new static($obj);
            } else {
                return false;
            }
        } else {
            $result = static::query($sql);
            $objs = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $obj = new static($row);
                array_push($objs, $obj);
            }
            return $objs;
        }
    }
}