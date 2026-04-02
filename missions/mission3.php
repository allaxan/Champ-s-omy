<?php

declare(strict_types=1);

include_once __DIR__ . '/../app.php';
require_login('../connexion.php');

$id = (int) $_SESSION['id_utilisateur'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_or_fail($_POST['csrf_token'] ?? null);

    if (isset($_POST['adresse'])) {
        $stmt = $db->prepare('UPDATE utilisateur SET adresse = NULL WHERE id_utilisateur = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if (isset($_POST['sang'])) {
        $stmt = $db->prepare('UPDATE utilisateur SET fk_idsang = NULL WHERE id_utilisateur = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if (isset($_POST['puceau'])) {
        $stmt = $db->prepare('UPDATE utilisateur SET puceau = 0 WHERE id_utilisateur = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    header('Location: mission3.php');
    exit;
}

$stmt = $db->prepare(
    'SELECT adresse, puceau, groupe
     FROM utilisateur
     LEFT JOIN sang ON utilisateur.fk_idsang = sang.id_sang
     WHERE utilisateur.id_utilisateur = :id'
);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$utilisateur = $stmt->fetch() ?: ['adresse' => null, 'puceau' => 0, 'groupe' => null];

$puceau = ((int) $utilisateur['puceau'] === 1) ? 'Oui' : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission 3 | Donnees</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/mission3.css">
    <script src="../js/mission3.js" defer></script>
</head>
<body>
    <?php include_once __DIR__ . '/../header.inc.php'; ?>
    <main class="page-shell">
        <section id="quiz-container" class="panel" style="max-width: 760px; margin: 1rem auto;">
            <h1 id="question">Mission 3: Proteger les donnees</h1>
            <div id="health-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div id="health" class="health-ok"></div>
            </div>
            <div id="answers"></div>
            <button id="see-explanation" hidden>Voir l'explication</button>
            <p id="explanation" hidden></p>
            <button id="next-btn" hidden>Question suivante</button>
        </section>

        <section class="panel" style="padding: 1.5rem; max-width: 760px; margin: 1rem auto;">
            <h2>Donnees personnelles visibles</h2>
            <p>Supprime les informations sensibles pour limiter les fuites de donnees.</p>
            <table style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr>
                        <th style="text-align:left; border-bottom:1px solid rgba(43,39,35,.2); padding:.6rem;">Champ</th>
                        <th style="text-align:left; border-bottom:1px solid rgba(43,39,35,.2); padding:.6rem;">Valeur</th>
                        <th style="text-align:left; border-bottom:1px solid rgba(43,39,35,.2); padding:.6rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:.6rem;">Adresse</td>
                        <td style="padding:.6rem;"><?php echo e($utilisateur['adresse'] ?? ''); ?></td>
                        <td style="padding:.6rem;">
                            <form method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" name="adresse">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:.6rem;">Groupe sanguin</td>
                        <td style="padding:.6rem;"><?php echo e($utilisateur['groupe'] ?? ''); ?></td>
                        <td style="padding:.6rem;">
                            <form method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" name="sang">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:.6rem;">Puceau</td>
                        <td style="padding:.6rem;"><?php echo e($puceau); ?></td>
                        <td style="padding:.6rem;">
                            <form method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                <button type="submit" name="puceau">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <div class="modal" id="result-modal" aria-hidden="true">
        <div class="modal-content">
            <p id="modal-text"></p>
            <button id="modal-btn" type="button">Fermer</button>
        </div>
    </div>
    <footer class="site-footer">
      <a href="../mentions_legales.html">Mentions legales</a>
    </footer>
</body>
</html>
