<?php

class DBConnect
{
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dataabase = 'suamaytinhvnn';
    private $charset = 'utf8';

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dataabase);
            $this->set_charset($this->charset);
        } catch (\Exception $e) {
            throw new Exception("Kết nối không thành công");
        }
    }

    public function set_charset($charset)
    {
        try {
            $this->conn->set_charset($charset);
        } catch (\Exception $e) {
            throw new Exception("Kết nối không thành công");
        }
    }

    public function select_db($dbName)
    {
        try {
            $this->conn->select_db($dbName);
        } catch (\Exception $e) {
            throw new Exception("Không tìm thấy CSDL này");
        }
    }

    public function execute_query($strQuery)
    {
        return $this->conn->query($strQuery);
    }

    public function execute_real_query($strQuery)
    {
        return $this->conn->real_query($strQuery);
    }

    public function fetch_array(mysqli_result $result)
    {
        return $result->fetch_array();
    }

    public function num_rows(mysqli_result $result)
    {
        return $result->num_rows;
    }

    public function affected_rows($result)
    {
        return $result->affected_rows;
    }
}
