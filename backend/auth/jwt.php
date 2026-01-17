<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function gerarJWT($userId, $email) {
  $secret = "CABINMATE_2026_SUPER_SECRET_KEY_256_BITS_LONG";

  $payload = [
    "iss" => "cabinmate",
    "iat" => time(),
    "exp" => time() + 86400,
    "data" => [
      "id" => $userId,
      "email" => $email
    ]
  ];

  return JWT::encode($payload, $secret, 'HS256');
}

function validarJWT($token) {
  $secret = "CABINMATE_2026_SUPER_SECRET_KEY_256_BITS_LONG";

  try {
    return JWT::decode($token, new Key($secret, 'HS256'))->data;
  } catch (Exception $e) {
    return false;
  }
}
