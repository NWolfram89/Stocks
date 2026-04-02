<?php

class Stock {
    
    private $symbol, $name, $price;
    
    public function __construct($symbol, $name, $price) {
        $this->set_symbol($symbol);
        $this->set_name($name);
        $this->set_price($price);  
    }
    
    public function set_symbol($symbol) {
        $this->symbol = $symbol;
    }
    
    public function set_name($name) {
        $this->name = $name;
    }
    
    public function set_price($price) {
        $this->price = $price;
    }
    
    public function get_symbol() {
        return $this->symbol;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function get_price() {
        return $this->price;
    }
}

function get_stock($symbol) {
    global $database;
    
    $query = 'SELECT symbol, name, price FROM stocks WHERE symbol = :symbol';
    
    $statement = $database->prepare($query);
    
    $statement->bindValue(":symbol", $symbol);
    
    $statement->execute();
    
    $stock = $statement->fetch();
    
    $statement->closeCursor();
    
    return new Stock($stock['symbol'], $stock['name'], $stock['price']);
}

function list_stocks() {
    global $database;
    
    $query = 'SELECT symbol, name, price FROM stocks';
    
    $statement = $database->prepare($query);
    
    $statement->execute();
    
    $stocks = $statement->fetchAll();
    
    $statement->closeCursor();
    
    $stocks_array = array();
    
    foreach ($stocks as $stock) {
        $stocks_array[] = new Stock($stock['symbol'], 
                $stock['name'], $stock['price']);
    }
    
    return $stocks_array;
}

function insert_stock($stock) {
    global $database;

    $query = "INSERT INTO stocks (symbol, name, price) "
            . "VALUES (:symbol, :name, :price)";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->bindValue(":name", $stock->get_name());
    $statement->bindValue(":price", $stock->get_price());
    
    $statement->execute();
    
    $statement->closeCursor();
}
function update_stock($stock) {
    global $database;
    
    $query = "UPDATE stocks "
            . "SET name = :name, "
            . "price = :price "
            . "WHERE symbol = :symbol";
    
     $statement = $database->prepare($query);
     $statement->bindValue(":symbol", $stock->get_symbol());
     $statement->bindValue(":name", $stock->get_name());
     $statement->bindValue(":price", $stock->get_price());
     
     $statement->execute();
     
     $statement->closeCursor();
}
function delete_stock($stock) {
    global $database;
    
    $query = "DELETE FROM stocks "
            . "WHERE symbol = :symbol";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $stock->get_symbol());
    
    $statement->execute();
    
    $statement->closeCursor();
}
