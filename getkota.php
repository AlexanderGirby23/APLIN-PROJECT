<?php
header('Content-Type: application/json');

$apiUrl = 'http://localhost:3000/provinsi';
$response = file_get_contents($apiUrl);
echo $response;
