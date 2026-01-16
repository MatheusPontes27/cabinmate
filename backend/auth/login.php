<?php
require __DIR__ . '/../config/cors.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/jwt.php';


header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data['email'] ?? '');
$senha = $data['senha'] ?? '';

if (!$email || !$senha) {
  http_response_code(400);
  echo json_encode(["error" => "Email e senha obrigatórios"]);
  exit;
}

$stmt = $pdo->prepare("
  SELECT id, nome, email, senha 
  FROM users 
  WHERE email = ? AND provider = 'local'
");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$user || !password_verify($senha, $user['senha'])) {
  http_response_code(401);
  echo json_encode(["error" => "Credenciais inválidas"]);
  exit;
}

$token = gerarJWT($user['id'], $user['email']);

echo json_encode([
  "success" => true,
  "token" => $token,
  "user" => [
    "id" => $user['id'],
    "nome" => $user['nome'],
    "email" => $user['email']
  ]
]);
