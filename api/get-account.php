<?php
include "../service/AccountService.php";

session_start();

if (!isset($_SESSION["email"])) {
    echo "Vous n'êtes pas connecté!";
    http_response_code(403);
} else {

    $AccountService = new AccountService();
    try {
        echo json_encode($AccountService->getAccounts());
        http_response_code(200);
    } catch (Exception $exception) {
        http_response_code(400);
        echo $exception->getMessage();
    }
}