<?php

declare(strict_types=1);

include_once __DIR__ . '/app.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
$sangOptions = $db->query('SELECT id_sang, groupe FROM sang ORDER BY groupe ASC')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_or_fail($_POST['csrf_token'] ?? null);

    $login = trim((string) ($_POST['login'] ?? ''));
    $mdp = (string) ($_POST['pswd'] ?? '');
    $puceau = isset($_POST['puceau']) ? (int) $_POST['puceau'] : null;
    $adresse = trim((string) ($_POST['adresse'] ?? ''));
    $adresse = $adresse === '' ? null : $adresse;
    $sang = isset($_POST['sang']) ? (int) $_POST['sang'] : 0;

    if ($login === '' || $mdp === '' || !in_array($puceau, [0, 1], true) || $sang <= 0) {
        $error = 'Veuillez remplir correctement tous les champs obligatoires.';
    } elseif (mb_strlen($login) > 100) {
        $error = 'Le login est trop long.';
    } else {
        $check = $db->prepare('SELECT login FROM utilisateur WHERE login = :login LIMIT 1');
        $check->bindValue(':login', $login, PDO::PARAM_STR);
        $check->execute();

        if ($check->fetch()) {
            $error = 'Ce login est deja pris.';
        } else {
            $hash = password_hash($mdp, PASSWORD_DEFAULT);

            $stmt = $db->prepare(
                'INSERT INTO utilisateur (login, password, puceau, adresse, fk_idsang)
                 VALUES (:login, :password, :puceau, :adresse, :sang)'
            );

            $stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':puceau', $puceau, PDO::PARAM_INT);
            $stmt->bindValue(':adresse', $adresse, $adresse === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':sang', $sang, PDO::PARAM_INT);
            $stmt->execute();

            session_regenerate_id(true);
            $_SESSION['id_utilisateur'] = (string) $db->lastInsertId();

            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Champ's Omy</title>
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <?php include_once __DIR__ . '/header.inc.php'; ?>
    <main class="page-shell">
        <section class="panel" style="padding:2rem; max-width:760px; margin:1rem auto;">
            <p class="eyebrow">Nouveau compte</p>
            <h1 style="margin:0 0 1rem;">Inscription</h1>
            <?php if ($error !== ''): ?>
                <p style="color:#8b1e1e; margin:0 0 1rem;"><?php echo e($error); ?></p>
            <?php endif; ?>
            <form action="inscription.php" method="post" style="display:grid; gap:1rem;">
                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                <div>
                    <label for="login">Login</label><br>
                    <input type="text" id="login" name="login" required maxlength="100" style="width:100%; padding:.65rem; margin-top:.3rem;">
                </div>
                <div>
                    <label for="pswd">Mot de passe</label><br>
                    <input type="password" id="pswd" name="pswd" required minlength="6" style="width:100%; padding:.65rem; margin-top:.3rem;">
                </div>
                <div>
                    <label for="sang">Groupe sanguin</label><br>
                    <select name="sang" id="sang" required style="width:100%; padding:.65rem; margin-top:.3rem;">
                        <option value="">Choisir...</option>
                        <?php foreach ($sangOptions as $row): ?>
                            <option value="<?php echo (int) $row['id_sang']; ?>"><?php echo e((string) $row['groupe']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="adresse">Adresse</label><br>
                    <input type="text" id="adresse" name="adresse" style="width:100%; padding:.65rem; margin-top:.3rem;">
                </div>
                <fieldset style="padding:1rem; border:1px solid rgba(43,39,35,.2); border-radius:10px;">
                    <legend>Es-tu puceau ?</legend>
                    <label><input type="radio" name="puceau" value="0" required> Non</label>
                    <label style="margin-left:1rem;"><input type="radio" name="puceau" value="1" required> Oui</label>
                </fieldset>
                <button type="submit" style="padding:.75rem 1rem; width:fit-content;">Creer mon compte</button>
            </form>
        </section>
    </main>
</body>
</html>
