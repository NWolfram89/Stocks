<?php

try {
    require_once 'models/database.php';
    require_once 'models/users.php';

    $action = filter_input(INPUT_POST, "action");
    $name = filter_input(INPUT_POST, "name");
    $balance = filter_input(INPUT_POST, "balance", FILTER_VALIDATE_FLOAT);
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($action == "insert") {
        if ($name != "" && $balance !== false) {
            $user = new User($name, $balance, null);
            insert_user($user);
            header("Location: users.php");
            exit();
        } else {
            $error_message = "Missing name or balance";
            include('views/error.php');
        }
    } else if ($action == "delete") {
        if ($id !== false) {
            delete_user($id);
            header("Location: users.php");
            exit();
        } else {
            $error_message = "Missing ID for delete";
            include('views/error.php');
        }
    }

    $users = list_users();
    include('views/users.php');

} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}
?>