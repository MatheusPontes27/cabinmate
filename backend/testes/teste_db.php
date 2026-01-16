<?php

require_once __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->query("SELECT 1");
    echo "✅ Conexão com o banco OK!";
} catch (Exception $e) {
    echo "❌ Erro na conexão: " . $e->getMessage();
}
