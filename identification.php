<?php

declare(strict_types=1);

include_once __DIR__ . '/app.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification | Champ's Omy</title>
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <?php include_once __DIR__ . '/header.inc.php'; ?>
    <main class="page-shell">
        <section class="panel" style="padding: 2rem; max-width: 640px; margin: 1rem auto;">
            <p class="eyebrow">Bienvenue</p>
            <h1 style="margin:0 0 1rem;">Choisissez une action</h1>
            <p style="margin:0 0 1.5rem;">Connectez-vous pour continuer les missions ou creez un compte en quelques secondes.</p>
            <div style="display:flex; gap: 12px; flex-wrap: wrap;">
                <a class="button-link" href="connexion.php" style="text-decoration:none; padding:0.8rem 1rem; border-radius: 10px; border:1px solid rgba(43,39,35,.2);">Connexion</a>
                <a class="button-link" href="inscription.php" style="text-decoration:none; padding:0.8rem 1rem; border-radius: 10px; border:1px solid rgba(43,39,35,.2);">Inscription</a>
            </div>
        </section>
    </main>
</body>
</html>
