<?php
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