

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champ's Omy</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="home-page">
    <?php include_once('header.inc.php'); ?>
    <main class="page-shell home-main">
        <section class="hero panel">
            <p class="eyebrow">Jeu de sensibilisation numérique</p>
            <h1>Un web plus lisible, plus léger, plus sûr.</h1>
            <p>Trois missions courtes pour comprendre pourquoi l’accessibilité, la sobriété et la protection des données changent vraiment la qualité d’un site.</p>
        </section>

        <section class="home-grid" aria-label="Missions disponibles">
            <a href="missions/mission1.php" class="mission-card mission-card--accessibility">
                <span>Mission 1</span>
                <h2>Rendre les sites accessibles</h2>
                <p>Améliore la lisibilité et l’expérience de lecture pour un maximum de personnes.</p>
            </a>

            <a href="missions/mission2.php" class="mission-card mission-card--performance">
                <span>Mission 2</span>
                <h2>Alléger les pages</h2>
                <p>Réduis le poids des contenus pour rendre les pages plus rapides et plus sobres.</p>
            </a>

            <a href="missions/mission3.php" class="mission-card mission-card--privacy">
                <span>Mission 3</span>
                <h2>Protéger les données</h2>
                <p>Repère les informations sensibles et limite ce qui fuit inutilement.</p>
            </a>
        </section>
    </main>
    <footer class="site-footer">
      <a href="mentions_legales.html">Mentions légales</a>
    </footer>
</body>
</html>