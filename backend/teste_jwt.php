<?php
require __DIR__ . '/auth/jwt.php';

echo gerarJWT(1, 'teste@teste.com');
