<?php
include "../service/UserService.php";
$params = json_decode(file_get_contents('php://input'), true);

session_start();

if (isset($_SESSION["email"])) {
    if (!isset($params["email"]) && !isset($params["password"])) {
        http_response_code(204);
    } else {
        echo "Vous êtes déjà connecté!";
        http_response_code(400);
    }

} else {
    $email = $params["email"];
    $password = $params["password"];

    $userService = new UserService();

    if ($userService->login($email, $password)) {
        http_response_code(204);
        $_SESSION["email"] = $email;
    } else {
        http_response_code(403);
    }
}
