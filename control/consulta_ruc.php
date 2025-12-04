<?php
$token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
$ruc = $_POST['ruc'] ?? '';

if (strlen($ruc) !== 11 || !is_numeric($ruc)) {
    header('Content-Type: application/json', true, 400);
    echo json_encode(['error' => 'RUC inválido']);
    exit;
}

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => [
        'Referer: https://apis.net.pe/consulta-ruc-api',
        'Authorization: Bearer ' . $token
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    $error = curl_error($curl);
    curl_close($curl);
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => 'cURL error', 'detail' => $error]);
    exit;
}

curl_close($curl);

header('Content-Type: application/json');
echo $response;
