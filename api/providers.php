<?php
include "../service/AccountService.php";
$params = json_decode(file_get_contents('php://input'), true);

$compte = $params["compte"];
$fournisseur = $params["fournisseur"];
$montant = $params["montant"];

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, "http://api.interax.ca/factures.json");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
    'compte' => $compte,
    'fournisseur' => $fournisseur,
    'montant' => $montant,
    'banque' => 'eccbank'
));
curl_exec ($curl);
curl_close ($curl);

if(!($montant > 0)) {
    echo json_encode(array('status'  => 'FAILURE'));
} else {
    $AccountService = new AccountService();
    if ($AccountService->applyTransaction($compte, $montant)) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
}