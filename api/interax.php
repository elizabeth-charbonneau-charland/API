<?php
include "../service/AccountService.php";
$params = json_decode(file_get_contents('php://input'), true);

$compte = $params["compte"];
$transit = $params["transit"];
$montant = $params["montant"];


header('content-type: application/json');

if(!($montant > 0)) {
    echo json_encode(array('status'  => 'FAILURE'));
} else {
    $AccountService = new AccountService();
    if ($AccountService->applyTransaction($compte, $montant)) {
        http_response_code(200);
        echo json_encode(array('status'  => 'OK'));
    } else {
        http_response_code(400);
        echo json_encode(array('status'  => 'FAILURE'));
    }
}






