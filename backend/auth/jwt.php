<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function gerarJWT($userId, $email) {
  $secret = "cabinmate_super_secret";

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
  $secret = "cabinmate_super_secret";

  try {
    return JWT::decode($token, new Key($secret, 'HS256'))->data;
  } catch (Exception $e) {
    return false;
  }
}
