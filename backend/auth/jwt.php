<?php
require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function gerarJWT($userId, $email) {
  $payload = [
    "iss" => "cabinmate",
    "sub" => $userId,
    "email" => $email,
    "iat" => time(),
    "exp" => time() + (60 * 60 * 24)
  ];

  return JWT::encode($payload, "SUA_CHAVE_SECRETA", "HS256");
}
