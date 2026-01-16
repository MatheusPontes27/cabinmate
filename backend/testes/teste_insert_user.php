<?php

require_once __DIR__ . '/../config/database.php';

// INSERT
$sql = "INSERT INTO users (nome, email, provider) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'Teste CabinMate',
    'teste@cabinmate.com',
    'local'
]);

echo "Usuário inserido com sucesso!<br>";

// SELECT
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
$user = $stmt->fetch();

echo '<pre>';
print_r($user);
