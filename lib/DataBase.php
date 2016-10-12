<?php

require_once 'config.php';

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 07.10.16
 * Time: 20:19
 */
class DataBase
{
    private $connection;
    private $last_query;

    function __construct() {
        $this->open_connection();
    }

    private function open_connection()
    {
        $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_error) {
            die('Ошибка подключения (' . $this->connection->connect_errno . ') '
                . $this->connection->connect_error);
        }
    }

    public function close_connection()
    {
        if (isset($this->connection)) {
            $this->connection->close();
            unset($this->connection);
        }
    }

    public function query($sql)
    {
        if ($result = $this->connection->query($sql)) {
            $this->last_query = $sql;
            return $result;
        }
    }

    public function insertId() {
        return mysqli_insert_id($this->connection);
    }
}

$connect = new DataBase;