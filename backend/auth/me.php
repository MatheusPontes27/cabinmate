<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/cors.php';
require __DIR__ . '/../middleware/auth.php';

$payload = authUser();

$stmt = $pdo->prepare(
  "SELECT id, nome, email, avatar FROM users WHERE id = ?"
);
$stmt->execute([$payload->id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);
