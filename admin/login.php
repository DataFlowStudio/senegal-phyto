<?php
session_start(); // Démarre la session
require('../config.php');

$error = ''; // Variable pour stocker le message d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Vérifier que la connexion PDO existe
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin["password"])) {
            // Identifiants corrects
            $_SESSION["admin_id"] = $admin["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            // Identifiants incorrects
            $error = "Identifiants invalides";
        }
    } else {
        $error = "Erreur de connexion à la base de données";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion Admin</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <form method="post" class="login-form">
        <h2>🔑 Connexion</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
