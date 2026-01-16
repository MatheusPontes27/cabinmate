<?php

$host = "localhost";
$db   = "cabinmate";
$user = "root";
$pass = "";

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 👈 evita array duplicado
    PDO::ATTR_EMULATE_PREPARES   => false,            // 👈 mais seguro
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro na conexão com o banco"]);
    exit;
}

