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

/**
 * 1️⃣ Verifica se o email já existe
 */
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$existe = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existe) {
  http_response_code(409);
  echo json_encode(["error" => "Email já cadastrado"]);
  exit;
}

/**
 * 2️⃣ Cria o usuário
 */
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
  INSERT INTO users (nome, email, senha, provider)
  VALUES (?, ?, ?, 'local')
");
$stmt->execute([$nome, $email, $senhaHash]);

echo json_encode(["success" => true]);
