<?php

require_once __DIR__ . '/../auth/jwt.php';

function authUser() {
  $headers = getallheaders();

  if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["error" => "Token não enviado"]);
    exit;
  }

  $token = str_replace('Bearer ', '', $headers['Authorization']);
  $payload = validarJWT($token);

  if (!$payload) {
    http_response_code(401);
    echo json_encode(["error" => "Token inválido"]);
    exit;
  }

  return $payload;
}