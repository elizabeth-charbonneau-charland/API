<?php
$transfert = json_decode(file_get_contents('php://input'), true);

$nom = $transfert["nom"];
$email = $transfert["email"];
$question = $transfert["question"];
$password = $transfert["password"];
$montant = $transfert["montant"];
$tel = $transfert["tel"];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://api.interax.ca/interax.json");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
    'nom' => $nom,
    'email' => $email,
    'question' => $question,
    'password' => $password,
    'montant' => $montant,
    'tel' => $tel,
));
curl_exec($curl);
curl_close($curl);