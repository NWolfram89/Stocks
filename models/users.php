<?php

class User {
    
    private $name, $balance, $id;
    
    public function __construct($name, $balance, $id) {
        $this->set_name($name);
        $this->set_balance($balance);  
        $this->set_id($id);
    }
    
    public function set_name($name) {
        $this->name = $name;
    }
    
    public function set_balance($balance) {
        $this->balance = $balance;
    }
    
    public function set_id($id) {
    $this->id = $id;
    }

    public function get_name() {
        return $this->name;
    }
    
    public function get_balance() {
        return $this->balance;
    }    
    
    public function get_id() {
        return $this->id;
    }
}

function get_user($id){
    global $database;
    
    $query = 'SELECT name, balance, id FROM users WHERE id = :id';
    
    $statement = $database->prepare($query);
    
    $statement->bindValue(":id", $id);
    
    $statement->execute();
    
    $user = $statement->fetch();
    
    $statement->closeCursor();

    return new User($user['name'], $user['balance'], $user['id']);
}

function list_users() {
    global $database;
    
    $query = 'SELECT id, name, balance FROM users';
    
    $statement = $database->prepare($query);
    $statement->execute();
    
    $users = $statement->fetchAll();
    
    $statement->closeCursor();
    
    $users_array = array();
    
    foreach ($users as $user) {
        $users_array[] = new User($user['name'], $user['balance'], $user['id']);
    }
    
    return $users_array;
}

function insert_user($user) {
    global $database;
    
    $query = "INSERT INTO users (name, balance)
              VALUES (:name, :balance)";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $user->get_name());
    $statement->bindValue(":balance", $user->get_balance());
    $statement->execute();
    $statement->closeCursor();
}

function update_user($user) {
    global $database;
    
    $query = "UPDATE users
              SET name = :name, balance = :balance
              WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $user->get_name());
    $statement->bindValue(":balance", $user->get_balance());
    $statement->bindValue(":id", $user->get_id());
    $statement->execute();
    $statement->closeCursor();
}

function delete_user($user_id) {
    global $database;
    
    $query = "DELETE FROM users
              WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $user_id);
    $statement->execute();
    $statement->closeCursor();
}