<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$currentPage = basename($scriptPath);
$isMissionPage = strpos($scriptPath, '/missions/') !== false;
$basePath = $isMissionPage ? '../' : '';
$isLoggedIn = isset($_SESSION['id_utilisateur']) && ctype_digit((string) $_SESSION['id_utilisateur']);

function nav_class(string $currentPage, string $targetPage): string
{
    return $currentPage === $targetPage ? ' class="active"' : '';
}
?>
<header class="site-header">
    <div class="site-header__inner">
        <a class="site-brand" href="<?= $basePath ?>index.php">
            <span>Champ's Omy</span>
            <small>Sensibilisation numérique</small>
        </a>

        <nav class="site-nav" aria-label="Navigation principale">
            <a href="<?= $basePath ?>index.php"<?= nav_class($currentPage, 'index.php') ?>>Accueil</a>
            <a href="<?= $basePath ?>collection.php"<?= nav_class($currentPage, 'collection.php') ?>>Collection</a>
            <a href="<?= $basePath ?>missions/mission1.php"<?= nav_class($currentPage, 'mission1.php') ?>>Mission 1</a>
            <a href="<?= $basePath ?>missions/mission2.php"<?= nav_class($currentPage, 'mission2.php') ?>>Mission 2</a>
            <a href="<?= $basePath ?>missions/mission3.php"<?= nav_class($currentPage, 'mission3.php') ?>>Mission 3</a>
            <?php if ($isLoggedIn): ?>
                <a href="<?= $basePath ?>deconnexion.php">Deconnexion</a>
            <?php else: ?>
                <a href="<?= $basePath ?>connexion.php"<?= nav_class($currentPage, 'connexion.php') ?>>Connexion</a>
                <a href="<?= $basePath ?>inscription.php"<?= nav_class($currentPage, 'inscription.php') ?>>Inscription</a>
            <?php endif; ?>
        </nav>
    </div>
</header>