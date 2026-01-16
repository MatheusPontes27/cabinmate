<?php
require __DIR__ . '/../config/cors.php';
require __DIR__ . '/../config/database.php';


header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$nome  = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$senha = $data['senha'] ?? '';

if (!$nome || !$email || !$senha) {
  http_response_code(400);
  echo json_encode(["error" => "Dados incompletos"]);
  exit;
}

// Verifica se já existe
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
  http_response_code(409);
  echo json_encode(["error" => "Email já cadastrado"]);
  exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
  INSERT INTO users (nome, email, senha, provider)
  VALUES (?, ?, ?, 'local')
");

$stmt->execute([$nome, $email, $hash]);

echo json_encode(["success" => true]);
