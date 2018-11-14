<?php

include "../service/AccountService.php";
$params = json_decode(file_get_contents('php://input'), true);

session_start();

$type = $params["type"];
$name = $params["name"];
$amount = $params["amount"];


if (!isset($_SESSION["email"])) {
    echo "Vous n'êtes pas connecté!";
    http_response_code(403);
} else {

    $AccountService = new AccountService();
    try {
        $AccountService->createAccount($type, $name, $amount);
        http_response_code(204);
    } catch (Exception $exception) {
        http_response_code(400);
        echo $exception->getMessage();
    }
}