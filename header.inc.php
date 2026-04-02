<?php
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$isMissionPage = substr($scriptPath, -strlen('/missions/mission1.php')) === '/missions/mission1.php'
    || substr($scriptPath, -strlen('/missions/mission2.php')) === '/missions/mission2.php'
    || substr($scriptPath, -strlen('/missions/mission3.php')) === '/missions/mission3.php';
$basePath = $isMissionPage ? '../' : '';
$currentPage = basename($scriptPath);

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
        </nav>
    </div>
</header>