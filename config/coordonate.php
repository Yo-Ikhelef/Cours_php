<?php

$curlCoordonate = curl_init('http://api.openweathermap.org/geo/1.0/direct?q=Lyon&limit=5&appid=66cc13b9e587f56eaf809b68949f1da3');
curl_setopt_array($curlCoordonate, [
    CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 1,
    ]);
$data1 = curl_exec($curlCoordonate);

if ($data1 === false){
    var_dump(curl_error($curlCoordonate));
} else {
    if (curl_getinfo($curlCoordonate, CURLINFO_HTTP_CODE) === 200) {
        $data1 = json_decode($data1, true);
//        echo '<pre>';
//        echo '</pre>';
        $lat = $data1[0]['lat'];
        $lon = $data1[0]['lon'];

    }
}


curl_close($curlCoordonate);