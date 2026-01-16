<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function gerarJWT($userId, $email) {
    $payload = [
        'iss' => 'cabinmate',
        'iat' => time(),
        'exp' => time() + 86400,
        'sub' => $userId,
        'email' => $email
    ];

    return JWT::encode($payload, JWT_SECRET, 'HS256');
}
