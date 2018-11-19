<?php
include "../service/AccountService.php";
$transfert = json_decode(file_get_contents('php://input'), true);

$compte = $transfert["compte"];
$nom = $transfert["nom"];
$email = $transfert["email"];
$question = $transfert["question"];
$password = $transfert["password"];
$montant = $transfert["montant"];
$tel = $transfert["tel"];


if(!($montant > 0)) {
    echo json_encode(array('status'  => 'FAILURE'));
} else {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://api.interax.ca/interax.json");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        'compte' => $compte,
        'nom' => $nom,
        'email' => $email,
        'question' => $question,
        'password' => $password,
        'montant' => $montant,
        'tel' => $tel,
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $patato = json_decode(curl_exec($curl))->Reponse;
    curl_close($curl);
    $AccountService = new AccountService();
    if ($AccountService->applyTransaction($compte, -$montant)) {
        $AccountService->registerTransaction($compte, $montant, $patato->id);
        http_response_code(200);

    } else {
        http_response_code(400);
    }
}