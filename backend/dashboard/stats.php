<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../auth/jwt.php';
require __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../middleware/auth.php';

echo json_encode([
  "success" => true,
  "usuario" => $usuario
]);

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
  http_response_code(401);
  exit;
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
$payload = validarJWT($token);

if (!$payload) {
  http_response_code(401);
  exit;
}

/*
  POR ENQUANTO DADOS MOCKADOS
  Depois isso vem do banco
*/

echo json_encode([
  "total_voos" => 128,
  "horas" => 1240,
  "proximo_voo" => "G3 1023",
  "dias_fora" => 18,
  "horas_mes" => [80,120,95,140,110,160],
  "rotas" => [
    "nacional" => 65,
    "internacional" => 35
  ],
  "companhias" => [
    "GOL" => 42,
    "LATAM" => 31,
    "AZUL" => 18
  ]
]);
