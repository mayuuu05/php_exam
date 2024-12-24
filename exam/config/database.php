<?php

class Config
{

    private $localhost = "localhost";
    private $userName = "root";
    private $databaseName = "exam";
    private $password = "";
    private $connection;

    function __construct()
    {
        $this->connection = mysqli_connect($this->localhost, $this->userName, $this->password, $this->databaseName);
    }

    public function addCoustomer($name, $email, $phone)
    {
        $query = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', $phone)";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }


    public function fetchCustomer()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function addProduct($id, $product_name, $price)
    {
        $query = "INSERT INTO products (id, product_name, price) VALUES ('$id', '$product_name', $price)";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function updateProduct($id, $product_name, $price)
    {
        $query = "UPDATE products SET product_name='$product_name',price=$price WHERE $id=$id";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }



    public function addOrder($id, $order_date, $status)
    {
        $query = "INSERT INTO orders (id, order_date, status) VALUES ($id, $order_date, '$status')";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }



    public function deleteOrder($id)
    {
        $query = "DELETE FROM orders WHERE id=$id";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}