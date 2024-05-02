<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 06:29 PM
 */
include "DataBaseManager.php";
require_once("Session.php");

$username = $_POST["username"];
$password = $_POST["password"];

$database = DataBaseManager::getInstance();

// Utilizando sentencias preparadas para evitar la inyección SQL
$query = "SELECT * FROM usuario WHERE nombre = ? AND clave = ?";
$statement = $database->prepare($query);
$statement->bind_param("ss", $username, $password);
$statement->execute();
$result = $statement->get_result();

verifyLogin($result, $username);

function verifyLogin($result, $username) {
    $message = null;
    $session = new session();

    if ($result->num_rows > 0) {
        $user = array();
        $row = $result->fetch_assoc();
        $user['type'] = $row['tipo'];
        $user['id'] = $row['id'];

        $session->set("user", $username);
        $session->set("user_id", $row['id']); // Guarda el ID del usuario en la sesión
        $usersList[] = $user;

        echo json_encode($usersList);
    } else {
        echo json_encode($message);
    }
}
?>