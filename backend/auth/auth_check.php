<?php

require __DIR__ . '/../auth/auth_check.php';
require __DIR__ . '/../config/database.php';


$config = require __DIR__ . '/../config/jwt.php';

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
  http_response_code(401);
  echo json_encode(["error" => "Token não informado"]);
  exit;
}

$token = str_replace('Bearer ', '', $headers['Authorization']);

$parts = explode('.', $token);

if (count($parts) !== 3) {
  http_response_code(401);
  echo json_encode(["error" => "Token inválido"]);
  exit;
}

list($header, $payload, $signature) = $parts;

$validSignature = base64_encode(
  hash_hmac(
    'sha256',
    "$header.$payload",
    $config['secret'],
    true
  )
);

if ($signature !== $validSignature) {
  http_response_code(401);
  echo json_encode(["error" => "Assinatura inválida"]);
  exit;
}

$data = json_decode(base64_decode($payload), true);

if ($data['exp'] < time()) {
  http_response_code(401);
  echo json_encode(["error" => "Token expirado"]);
  exit;
}

// Usuário autenticado
$userId = $data['sub'];
