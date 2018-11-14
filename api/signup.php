<?php
include "../service/UserService.php";
$params = json_decode(file_get_contents('php://input'), true);

session_start();

$email = $params["email"];
$password = $params["password"];
$firstName = $params["firstName"];
$lastName = $params["lastName"];


if (isset($_SESSION["email"])) {
    echo "Vous êtes déjà connecté!";
    http_response_code(400);
} else {

    $userService = new UserService();
    try {
        $userService->signUp($firstName, $lastName,$email,$password);
        http_response_code(204);
        $_SESSION["email"] = $email;
    } catch (Exception $exception) {
        http_response_code(400);
        echo $exception->getMessage();
    }
}



