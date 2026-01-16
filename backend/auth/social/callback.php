<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/jwt.php';
require_once __DIR__ . '/../helpers/jwt_helper.php';


use Hybridauth\Hybridauth;

try {
    $hybridauth = new Hybridauth($hybridauthConfig);

    // Recupera o provider que veio pela URL
    if (!isset($_GET['provider'])) {
        throw new Exception('Provider não informado.');
    }

    $provider = strtolower($_GET['provider']);

    // Primeira letra maiúscula (Google, Facebook, Linkedin)
    $providerName = ucfirst($provider);

    $adapter = $hybridauth->authenticate($providerName);
    $profile = $adapter->getUserProfile();

    // Dados do usuário
    $providerId = $profile->identifier;
    $nome       = $profile->displayName;
    $email      = $profile->email;
    $foto       = $profile->photoURL;

    // DEBUG TEMPORÁRIO
    /*
    echo '<pre>';
    var_dump($provider, $profile);
    exit;
    */

    // Aqui entra:
    // - Verificar se usuário existe
    // - Criar usuário se não existir
    // - Criar sessão

    echo "Login com {$providerName} realizado com sucesso!";

    $sql = "INSERT INTO users (nome, email, provider, provider_id, avatar)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nome,
        $email,
        $provider,
        $providerId,
        $avatar
    ]);

    $userId = $pdo->lastInsertId();

} catch (Exception $e) {
    echo "Erro no login social: " . $e->getMessage();

    // Se for erro de duplicidade
    if ($e->getCode() == 23000) {

        $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        $userId = $user['id'];

    } else {
        throw $e;
    }
}
