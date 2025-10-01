<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Compter les enregistrements
$pubs = $conn->query("SELECT COUNT(*) FROM pubs")->fetchColumn();
$temoignages = $conn->query("SELECT COUNT(*) FROM temoignages")->fetchColumn();
$galerie = $conn->query("SELECT COUNT(*) FROM galerie")->fetchColumn();
$messages = $conn->query("SELECT COUNT(*) FROM messages")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>📊 Tableau de bord</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>📊 Tableau de bord</h2>
        <div class="cards">
            <div class="card">Publicités: <?= $pubs ?></div>
            <div class="card">Témoignages: <?= $temoignages ?></div>
            <div class="card">Galerie: <?= $galerie ?></div>
            <div class="card">Messages: <?= $messages ?></div>
        </div>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>

