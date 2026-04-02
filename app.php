<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/connect.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function is_logged_in(): bool
{
    return isset($_SESSION['id_utilisateur']) && ctype_digit((string) $_SESSION['id_utilisateur']);
}

function require_login(string $redirectTo = 'connexion.php'): void
{
    if (!is_logged_in()) {
        header('Location: ' . $redirectTo);
        exit;
    }
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf_or_fail(?string $token): void
{
    if (!isset($_SESSION['csrf_token']) || !is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        exit('Requete invalide (CSRF).');
    }
}
