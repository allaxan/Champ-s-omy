<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission 1 | Accessibilite</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/mission1.css">
    <script src="../js/mission1.js" defer></script>
</head>
<body>
    <?php include_once __DIR__ . '/../header.inc.php'; ?>
    <main class="page-shell">
        <div class="container panel">
        <h1>Une petite sensibilisation à la dyslexie ?</h1>

        <p id="instructions">
            <strong>🎯 Objectif :</strong> Essayez de lire le texte ci-dessous avec des erreurs typographiques et de le
            corriger.
            Cet exercice vous permet de comprendre les difficultés rencontrées par les personnes dyslexiques lors de la
            lecture.
        </p>

        <div id="explanation">
            <strong>💡 Le saviez-vous ?</strong> Les personnes dyslexiques peuvent avoir du mal à distinguer certaines
            lettres ou leur orientation comme 'b' et 'd' ou encore le 'p' et le 'q'.
            Elles peuvent aussi percevoir les lettres inversées ou manquantes. Ces difficultés sont souvent liées à la manière dont le cerveau
            traite les informations visuelles et linguistiques.
        </div>

        <h2>Texte à corriger :</h2>
        <div id="typo-text" class="typo-text"></div>

        <input type="text" id="user-correction" placeholder="Recopiez le texte corrigé ici">
        <button id="validate-btn">Valider ma réponse</button>
        <button id="skip-btn">Passer</button>

        <div id="feedback"></div>
        <div id="score">Score : 0/0</div>

        <div class="resources">
            <h3>📚 Quelque ressources sur l'accessibilité typographique :</h3>
            <ul>
                <li><a href="https://opendyslexic.org/" target="_blank">OpenDyslexic</a> - Police spécialement conçue
                    pour améliorer la lisibilité</li>
                <li><a href="https://www.ux-republic.com/typographie-et-accessibilite-acte-1-comment-bien-choisir-sa-police-decriture/"
                        target="_blank">UX Republic - Typographie et accessibilité</a> - Guide pour choisir une bonne
                    police d'écriture</li>
            </ul>
        </div>
                </div>
        </main>
        <footer class="site-footer">
            <a href="../mentions_legales.html">Mentions legales</a>
        </footer>
</body>
</html>