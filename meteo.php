<?php
require_once 'class/OpenWeather.php';

$weather = new OpenWeather('66cc13b9e587f56eaf809b68949f1da3');
$forecast = $weather->getForecast('Lyon,fr');

require 'elements/header.php'; ?>

<div class="container">
    <ul>
        <li><?=$forecast[0]['date']->format('d/m/Y')?> <?= $forecast[0]['description']?> <?= $forecast[0]['temp']?> °C</li>
    </ul>

</div>


<?php require 'elements/footer.php'; ?>
