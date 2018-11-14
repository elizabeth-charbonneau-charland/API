<?php

function getDatabaseConnection() {
    $servername = "localhost";
    $username = "username";
    $password = "password";

// Create connection, donne acces a la base de donnée
    $connection = new mysqli($servername, $username, $password);
// Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $connection->select_db("eccbank");
    return $connection;
}