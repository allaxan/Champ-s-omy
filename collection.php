<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection | Champ's Omy</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/collection.css">
</head>
<body class="collection-page">
    <?php include_once('header.inc.php'); ?>

    <main class="page-shell collection-main">
        <section class="hero panel">
            <p class="eyebrow">Récompenses</p>
            <h1>Collection de vos cartes-attaque</h1>
            <p>Retrouvez les missions déjà validées et suivez votre progression dans un format plus clair, plus élégant et plus lisible.</p>
        </section>

        <section class="collection-grid" aria-label="Cartes débloquées">
            <article class="collection-card collection-card--good">
                <span class="collection-card__badge">Débloqué</span>
                <h2>Rendre les sites accessibles</h2>
                <p>Une carte pour retenir les bons réflexes de lisibilité et d’accessibilité.</p>
            </article>

            <article class="collection-card collection-card--warm">
                <span class="collection-card__badge">Débloqué</span>
                <h2>Alléger les pages</h2>
                <p>Une carte centrée sur la performance et la sobriété numérique.</p>
            </article>

            <article class="collection-card collection-card--calm">
                <span class="collection-card__badge">Débloqué</span>
                <h2>Protéger les données</h2>
                <p>Une carte dédiée à la confidentialité et à la réduction des fuites d’information.</p>
            </article>
        </section>
    </main>
    <footer class="site-footer">
      <a href="mentions_legales.html">Mentions légales</a>
    </footer>
</body>
</html>