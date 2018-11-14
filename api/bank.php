<?php

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, "http://api.interax.ca/banques.json");
curl_exec ($curl);
curl_close ($curl);

