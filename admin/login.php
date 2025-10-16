<?php
session_start();
require('../config.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin["password"])) {
            $_SESSION["admin_id"] = $admin["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "⚠️ Identifiants invalides. Veuillez réessayer.";
        }
    } else {
        $error = "❌ Erreur de connexion à la base de données.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - Sénégal Phyto Admin</title>
<link rel="stylesheet" href="style.css">
<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* === LOGIN PAGE UNIFORME & ALIGN LOGO === */
.login-page {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: linear-gradient(135deg, #006400, #2E8B57);
    padding: 20px;
}

.login-box {
    background: #fff;
    padding: 40px 35px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    width: 380px;
    text-align: center;
    animation: fadeIn 0.45s ease;
}

/* LOGO + TITLE ALIGNMENT FIX */
.logo-section {
    display: flex;
    align-items: center;      /* centre verticalement icône + texte */
    justify-content: center;
    gap: 10px;
    margin-bottom: 18px;
}

/* L'icône */
.logo-section .logo-icon {
    font-size: 26px;          /* réglable selon goût */
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #f39c12;
    vertical-align: middle;   /* safeguard */
}

/* Le texte titre, parfaitement aligné */
.logo-section .logo-title {
    margin: 0;
    font-size: 18px;
    color: #006400;
    font-weight: 700;
    line-height: 1;           /* important pour l'alignement */
    display: inline-block;
    vertical-align: middle;
}

/* input / button styles */
.login-box h2 {
    display:none; /* on utilise logo-section comme titre */
}

.login-box input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    transition: 0.2s;
    font-size: 14px;
}

.login-box input:focus {
    border-color: #006400;
    box-shadow: 0 0 6px rgba(0,100,0,0.12);
    outline: none;
}

.login-box button {
    width: 100%;
    background: #006400;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    margin-top: 10px;
    transition: background 0.2s ease;
}

.login-box button:hover {
    background: #2E8B57;
}

.error {
    background: #fff0f0;
    color: #b30000;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 12px;
    font-size: 14px;
    border-left: 4px solid #b30000;
}

footer {
    position: absolute;
    bottom: 14px;
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 14px;
}

/* petite animation */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-8px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>
</head>
<body class="login-page">

    <form method="post" class="login-box" autocomplete="off">
        <div class="logo-section" aria-hidden="false">
            <div class="logo-icon"><i class="fa-solid fa-leaf"></i></div>
            <div class="logo-title">Sénégal Phyto - Admin</div>
        </div>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Nom d'utilisateur" required autofocus>
        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit">
            <i class="fa-solid fa-right-to-bracket" style="margin-right:8px"></i> Se connecter
        </button>
    </form>

    <footer>&copy; <?= date("Y") ?> - Sénégal Phyto</footer>
</body>
</html>
