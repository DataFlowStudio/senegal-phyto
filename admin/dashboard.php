<?php
session_start();
require('../config.php');

// Vérifier la session admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

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
<title>📊 Tableau de bord - Sénégal Phyto</title>
<link rel="stylesheet" href="style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* === Spécifique au Dashboard === */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px 20px;
        text-align: center;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    }

    .dashboard-card i {
        font-size: 38px;
        margin-bottom: 10px;
    }

    .dashboard-card h3 {
        margin-top: 10px;
        font-size: 18px;
        color: #006400;
        font-weight: 600;
    }

    .dashboard-card p {
        font-size: 26px;
        font-weight: bold;
        color: #333;
        margin-top: 5px;
    }

    /* Couleurs des cartes */
    .card-pubs i { color: #f39c12; }
    .card-temoignages i { color: #2E8B57; }
    .card-galerie i { color: #3498db; }
    .card-messages i { color: #c0392b; }

    main h2 {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #006400;
    }
</style>
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="container">
    <?php include "includes/sidebar.php"; ?>

    <main>
        <h2><i class="fa-solid fa-chart-line"></i> Tableau de bord</h2>

        <div class="dashboard-cards">
            <div class="dashboard-card card-pubs">
                <i class="fa-solid fa-bullhorn"></i>
                <h3>Publicités</h3>
                <p><?= $pubs ?></p>
            </div>

            <div class="dashboard-card card-temoignages">
                <i class="fa-solid fa-comments"></i>
                <h3>Témoignages</h3>
                <p><?= $temoignages ?></p>
            </div>

            <div class="dashboard-card card-galerie">
                <i class="fa-solid fa-image"></i>
                <h3>Galerie</h3>
                <p><?= $galerie ?></p>
            </div>

            <div class="dashboard-card card-messages">
                <i class="fa-solid fa-envelope"></i>
                <h3>Messages</h3>
                <p><?= $messages ?></p>
            </div>
        </div>
    </main>
</div>
<br>
<?php include "includes/footer.php"; ?>

</body>
</html>
