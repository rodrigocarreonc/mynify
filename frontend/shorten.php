<?php
$data = json_decode(file_get_contents('php://input'), true);
$url = $data['url'];

$apiUrl = 'https://myni.rodrigocarreon.com/api/short';
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode(['url' => $url]),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($apiUrl, false, $context);
if ($result === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al acortar el enlace']);
    exit;
}

echo $result;
?>