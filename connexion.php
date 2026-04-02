<?php

declare(strict_types=1);

include_once __DIR__ . '/app.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_or_fail($_POST['csrf_token'] ?? null);

    $login = trim((string) ($_POST['login'] ?? ''));
    $password = (string) ($_POST['pswd'] ?? '');

    if ($login === '' || $password === '') {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        $stmt = $db->prepare('SELECT id_utilisateur, login, password FROM utilisateur WHERE login = :login LIMIT 1');
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($password, (string) $utilisateur['password'])) {
            session_regenerate_id(true);
            $_SESSION['id_utilisateur'] = (string) $utilisateur['id_utilisateur'];
            header('Location: index.php');
            exit;
        }

        $error = 'Login ou mot de passe incorrect.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Champ's Omy</title>
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <?php include_once __DIR__ . '/header.inc.php'; ?>
    <main class="page-shell">
        <section class="panel" style="padding:2rem; max-width:640px; margin:1rem auto;">
            <p class="eyebrow">Compte</p>
            <h1 style="margin:0 0 1rem;">Connexion</h1>
            <?php if ($error !== ''): ?>
                <p style="color:#8b1e1e; margin:0 0 1rem;"><?php echo e($error); ?></p>
            <?php endif; ?>
            <form action="connexion.php" method="post" style="display:grid; gap:1rem;">
                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                <div>
                    <label for="login">Login</label><br>
                    <input type="text" id="login" name="login" required maxlength="100" style="width:100%; padding:.65rem; margin-top:.3rem;">
                </div>
                <div>
                    <label for="pswd">Mot de passe</label><br>
                    <input type="password" id="pswd" name="pswd" required style="width:100%; padding:.65rem; margin-top:.3rem;">
                </div>
                <button type="submit" style="padding:.75rem 1rem; width:fit-content;">Se connecter</button>
            </form>
        </section>
    </main>
</body>
</html>
