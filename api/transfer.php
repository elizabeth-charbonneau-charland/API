<?php
$transfert = file_get_contents('php://input');

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, "http://api.interax.ca/interax.json");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $transfert);
curl_exec ($curl);
curl_close ($curl);